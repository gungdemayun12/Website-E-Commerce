<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use id;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class DashboardController extends Controller
{
    public function dashboard()
    {
        $totalPendapatan = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.status', 'selesai')
            ->sum('order_items.subtotal');

        $totalProduk = DB::table('products')->count();

        $totalPesanan = DB::table('orders')->count();

        $produkTerlaris = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->where('orders.status', 'selesai')
            ->select(
                'products.nama_produk',
                DB::raw('SUM(order_items.qty) as total_terjual')
            )
            ->groupBy('products.id', 'products.nama_produk')
            ->orderByDesc('total_terjual')
            ->first();

        $chart = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->select(
                DB::raw('MONTH(orders.created_at) as bulan'),
                DB::raw('SUM(order_items.subtotal) as total')
            )
            ->where('orders.status', 'selesai')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        return view('admin.dashboard', compact(
            'totalPendapatan',
            'totalProduk',
            'totalPesanan',
            'produkTerlaris',
            'chart'
        ));
    }

    public function index(Request $request)
    {
        $query = DB::table('products')
                    ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
                    ->select('products.*', 'categories.nama_kategori as category_name');

        if ($request->keyword) {
            $query->where('products.nama_produk', 'LIKE', '%'. $request->keyword. '%');
        }

        if ($request->category_id) {
            $query->where('products.category_id', $request->category_id);
        }

        if ($request->stok_filter) {
            if ($request->stok_filter == 'habis') {
                $query->where('products.stok', 0);
            } elseif ($request->stok_filter == 'menipis') {
                $query->where('products.stok', '>', 0)->where('products.stok', '<=', 5);
            } elseif ($request->stok_filter == 'tersedia') {
                $query->where('products.stok', '>', 5);
            }
        }

        if ($request->sort_by) {
            if ($request->sort_by == 'harga_terendah') {
                $query->orderBy('products.harga', 'asc');
            } elseif ($request->sort_by == 'harga_tertinggi') {
                $query->orderBy('products.harga', 'desc');
            } elseif ($request->sort_by == 'nama_az') {
                $query->orderBy('products.nama_produk', 'asc');
            } elseif ($request->sort_by == 'nama_za') {
                $query->orderBy('products.nama_produk', 'desc');
            } elseif ($request->sort_by == 'stok_terendah') {
                $query->orderBy('products.stok', 'asc');
            } elseif ($request->sort_by == 'stok_tertinggi') {
                $query->orderBy('products.stok', 'desc');
            } elseif ($request->sort_by == 'terbaru') {
                $query->orderBy('products.created_at', 'desc');
            } elseif ($request->sort_by == 'terlama') {
                $query->orderBy('products.created_at', 'asc');
            }
        } else {
            $query->orderBy('products.created_at', 'desc');
        }

        $product = $query->paginate(8)->withQueryString();

        $categories = DB::table('categories')
                        ->orderBy('nama_kategori', 'asc')
                        ->get();

        $total_produk = DB::table('products')->count();
        $total_stok = DB::table('products')->sum('stok');
        $stok_menipis = DB::table('products')->where('stok', '>', 0)->where('stok', '<=', 5)->count();
        $stok_habis = DB::table('products')->where('stok', 0)->count();

        return view('admin.index', compact('product', 'categories', 'total_produk', 'total_stok', 'stok_menipis', 'stok_habis'));
    }

    public function create()
    {
        $categories = DB::table('categories')->orderBy('nama_kategori', 'asc')->get();
        return view('admin.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
        ]);

        $namaGambar = null;
        if ($request->hasFile('gambar')) {
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/products';

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file = $request->file('gambar');
            $namaGambar = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->move($destinationPath, $namaGambar);
        }

        DB::table('products')->insert([
            'nama_produk' => $request->nama_produk,
            'category_id' => $request->category_id,
            'deskripsi' => $request->deskripsi,
            'deskripsi_lengkap' => $request->deskripsi_lengkap,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'gambar' => $namaGambar,
            'tabel_ukuran' => $request->tabel_ukuran,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('dashboard.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        $categories = DB::table('categories')->orderBy('nama_kategori', 'asc')->get();
        return view('admin.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
        ]);

        $product = DB::table('products')->where('id', $id)->first();
        $namaGambar = $product->gambar;

        if ($request->hasFile('gambar')) {
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/products';

            if ($product->gambar && file_exists($destinationPath . '/' . $product->gambar)) {
                unlink($destinationPath . '/' . $product->gambar);
            }

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file = $request->file('gambar');
            $namaGambar = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->move($destinationPath, $namaGambar);
        }

        DB::table('products')->where('id', $id)->update([
            'category_id' => $request->category_id,
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'deskripsi_lengkap' => $request->deskripsi_lengkap,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'gambar' => $namaGambar,
            'tabel_ukuran' => $request->tabel_ukuran,
            'updated_at' => now(),
        ]);

        return redirect()->route('dashboard.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroyProduk($id)
    {
        $product = DB::table('products')->where('id', $id)->first();

        if ($product->gambar && file_exists(public_path('images/' . $product->gambar))) {
            unlink(public_path('images/' . $product->gambar));
        }

        DB::table('products')->where('id', $id)->delete();

        return redirect()->route('dashboard.index')->with('success', 'Produk berhasil dihapus!');
    }

    public function pesanan(Request $request)
    {
        $query = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->select(
                'orders.id',
                'orders.nama_pemesan',
                'orders.no_hp',
                'orders.alamat',
                'orders.status',
                'orders.metode_pembayaran',
                'orders.bukti_transfer',
                'orders.catatan',
                'orders.created_at',
                'orders.updated_at',
                DB::raw('GROUP_CONCAT(CONCAT(products.nama_produk, " (", order_items.ukuran, ") x", order_items.qty) SEPARATOR ", ") as items'),
                DB::raw('SUM(order_items.qty) as total_qty'),
                DB::raw('SUM(order_items.subtotal) as total_harga')
            )
            ->whereIn('orders.status', ['pending', 'proses'])
            ->groupBy(
                'orders.id',
                'orders.nama_pemesan',
                'orders.no_hp',
                'orders.alamat',
                'orders.status',
                'orders.metode_pembayaran',
                'orders.bukti_transfer',
                'orders.catatan',
                'orders.created_at',
                'orders.updated_at'
            );

        if ($request->keyword) {
            $query->where('orders.nama_pemesan', 'LIKE', '%'. $request->keyword. '%');
        }

        if ($request->status_filter) {
            $query->where('orders.status', $request->status_filter);
        }

        if ($request->metode_filter) {
            $query->where('orders.metode_pembayaran', $request->metode_filter);
        }

        if ($request->date_filter) {
            if ($request->date_filter == 'hari_ini') {
                $query->whereDate('orders.created_at', Carbon::today());
            } elseif ($request->date_filter == 'minggu_ini') {
                $query->whereBetween('orders.created_at', [
                    Carbon::now()->startOfWeek(),
                    Carbon::now()->endOfWeek()
                ]);
            } elseif ($request->date_filter == 'bulan_ini') {
                $query->whereMonth('orders.created_at', Carbon::now()->month)
                      ->whereYear('orders.created_at', Carbon::now()->year);
            }
        }

        if ($request->sort_by) {
            if ($request->sort_by == 'total_tertinggi') {
                $query->orderByRaw('SUM(order_items.subtotal) DESC');
            } elseif ($request->sort_by == 'total_terendah') {
                $query->orderByRaw('SUM(order_items.subtotal) ASC');
            } elseif ($request->sort_by == 'nama_az') {
                $query->orderBy('orders.nama_pemesan', 'asc');
            } elseif ($request->sort_by == 'nama_za') {
                $query->orderBy('orders.nama_pemesan', 'desc');
            } elseif ($request->sort_by == 'terbaru') {
                $query->orderBy('orders.created_at', 'desc');
            } elseif ($request->sort_by == 'terlama') {
                $query->orderBy('orders.created_at', 'asc');
            }
        } else {
            $query->orderBy('orders.created_at', 'desc');
        }

        $orders = $query->paginate(10);

        $products = DB::table('products')
            ->orderBy('nama_produk', 'asc')
            ->get();

        $total_pesanan = DB::table('orders')
            ->whereIn('status', ['pending', 'proses'])
            ->count();

        $total_pendapatan = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->whereIn('orders.status', ['pending', 'proses'])
            ->sum('order_items.subtotal');

        $pesanan_proses = DB::table('orders')->where('status', 'proses')->count();
        $pesanan_pending = DB::table('orders')->where('status', 'pending')->count();

        $metode_pembayaran = DB::table('orders')
            ->select('metode_pembayaran')
            ->distinct()
            ->whereNotNull('metode_pembayaran')
            ->orderBy('metode_pembayaran', 'asc')
            ->get();

        return view('admin.pesanan', compact(
            'orders',
            'products',
            'total_pesanan',
            'total_pendapatan',
            'pesanan_proses',
            'pesanan_pending',
            'metode_pembayaran'
        ));
    }

    public function riwayatPesanan(Request $request)
    {
        $query = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->select(
                'orders.id',
                'orders.nama_pemesan',
                'orders.no_hp',
                'orders.alamat',
                'orders.status',
                'orders.metode_pembayaran',
                'orders.bukti_transfer',
                'orders.catatan',
                'orders.created_at',
                'orders.updated_at',
                DB::raw('GROUP_CONCAT(CONCAT(products.nama_produk, " (", order_items.ukuran, ") x", order_items.qty) SEPARATOR ", ") as items'),
                DB::raw('SUM(order_items.subtotal) as total_harga')
            )
            ->whereIn('orders.status', ['selesai', 'dibatalkan'])
            ->groupBy(
                'orders.id',
                'orders.nama_pemesan',
                'orders.no_hp',
                'orders.alamat',
                'orders.status',
                'orders.metode_pembayaran',
                'orders.bukti_transfer',
                'orders.catatan',
                'orders.created_at',
                'orders.updated_at'
            );

        if ($request->keyword) {
            $query->where(function($q) use ($request) {
                $q->where('orders.nama_pemesan', 'LIKE', '%'. $request->keyword. '%')
                  ->orWhere('products.nama_produk', 'LIKE', '%'. $request->keyword. '%');
            });
        }

        if ($request->status_filter) {
            $query->where('orders.status', $request->status_filter);
        }

        if ($request->metode_filter) {
            $query->where('orders.metode_pembayaran', $request->metode_filter);
        }

        if ($request->product_filter) {
            $query->where('order_items.product_id', $request->product_filter);
        }

        if ($request->tanggal_mulai && $request->tanggal_akhir) {
            $query->whereBetween('orders.created_at', [
                Carbon::parse($request->tanggal_mulai)->startOfDay(),
                Carbon::parse($request->tanggal_akhir)->endOfDay()
            ]);
        } elseif ($request->date_filter) {
            if ($request->date_filter == 'hari_ini') {
                $query->whereDate('orders.created_at', Carbon::today());
            } elseif ($request->date_filter == 'minggu_ini') {
                $query->whereBetween('orders.created_at', [
                    Carbon::now()->startOfWeek(),
                    Carbon::now()->endOfWeek()
                ]);
            } elseif ($request->date_filter == 'bulan_ini') {
                $query->whereMonth('orders.created_at', Carbon::now()->month)
                      ->whereYear('orders.created_at', Carbon::now()->year);
            } elseif ($request->date_filter == 'bulan_lalu') {
                $query->whereMonth('orders.created_at', Carbon::now()->subMonth()->month)
                      ->whereYear('orders.created_at', Carbon::now()->subMonth()->year);
            } elseif ($request->date_filter == '3_bulan') {
                $query->where('orders.created_at', '>=', Carbon::now()->subMonths(3));
            } elseif ($request->date_filter == '6_bulan') {
                $query->where('orders.created_at', '>=', Carbon::now()->subMonths(6));
            }
        }

        if ($request->sort_by) {
            if ($request->sort_by == 'total_tertinggi') {
                $query->orderByRaw('SUM(order_items.subtotal) DESC');
            } elseif ($request->sort_by == 'total_terendah') {
                $query->orderByRaw('SUM(order_items.subtotal) ASC');
            } elseif ($request->sort_by == 'nama_az') {
                $query->orderBy('orders.nama_pemesan', 'asc');
            } elseif ($request->sort_by == 'nama_za') {
                $query->orderBy('orders.nama_pemesan', 'desc');
            } elseif ($request->sort_by == 'terbaru') {
                $query->orderBy('orders.created_at', 'desc');
            } elseif ($request->sort_by == 'terlama') {
                $query->orderBy('orders.created_at', 'asc');
            }
        } else {
            $query->orderBy('orders.created_at', 'desc');
        }

        $orders = $query->paginate(15);

        $products = DB::table('products')
            ->orderBy('nama_produk', 'asc')
            ->get();

        $metode_pembayaran = DB::table('orders')
            ->select('metode_pembayaran')
            ->distinct()
            ->whereNotNull('metode_pembayaran')
            ->orderBy('metode_pembayaran', 'asc')
            ->get();

        $total_riwayat = DB::table('orders')
            ->whereIn('status', ['selesai', 'dibatalkan'])
            ->count();

        $total_selesai = DB::table('orders')
            ->where('status', 'selesai')
            ->count();

        $total_dibatalkan = DB::table('orders')
            ->where('status', 'dibatalkan')
            ->count();

        $total_pendapatan = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.status', 'selesai')
            ->sum('order_items.subtotal');

        $produk_terlaris = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->where('orders.status', 'selesai')
            ->select(
                'products.nama_produk',
                DB::raw('SUM(order_items.qty) as total_terjual'),
                DB::raw('SUM(order_items.subtotal) as total_pendapatan')
            )
            ->groupBy('products.id', 'products.nama_produk')
            ->orderByDesc('total_terjual')
            ->limit(5)
            ->get();

        $pendapatan_bulanan = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.status', 'selesai')
            ->where('orders.created_at', '>=', Carbon::now()->subMonths(6))
            ->select(
                DB::raw('DATE_FORMAT(orders.created_at, "%Y-%m") as bulan'),
                DB::raw('SUM(order_items.subtotal) as total')
            )
            ->groupBy('bulan')
            ->orderBy('bulan', 'asc')
            ->get();

        return view('admin.riwayat-pesanan', compact(
            'orders',
            'products',
            'metode_pembayaran',
            'total_riwayat',
            'total_selesai',
            'total_dibatalkan',
            'total_pendapatan',
            'produk_terlaris',
            'pendapatan_bulanan'
        ));
    }

    public function storePesanan(Request $request)
    {
        $validated = $request->validate([
            'nama_pemesan' => 'required|string|max:100',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'metode_pembayaran' => 'required|in:cod,transfer',
            'catatan' => 'nullable|string',
            'bukti_transfer' => 'nullable|required_if:metode_pembayaran,transfer|image|mimes:jpg,jpeg,png|max:2048',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.ukuran' => 'required|string|max:10',
            'items.*.qty' => 'required|integer|min:1',
        ]);

        $buktiTransferPath = null;
        if ($validated['metode_pembayaran'] === 'transfer' && $request->hasFile('bukti_transfer')) {
            $file = $request->file('bukti_transfer');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('images/transfer');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $filename);
            $buktiTransferPath = 'images/transfer/' . $filename;
        }

        DB::beginTransaction();
        try {
            $orderId = DB::table('orders')->insertGetId([
                'customer_id' => null,
                'nama_pemesan' => $validated['nama_pemesan'],
                'no_hp' => $validated['no_hp'],
                'alamat' => $validated['alamat'],
                'status' => 'pending',
                'metode_pembayaran' => $validated['metode_pembayaran'],
                'catatan' => $validated['catatan'] ?? null,
                'bukti_transfer' => $buktiTransferPath,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($validated['items'] as $item) {
                $product = DB::table('products')->where('id', $item['product_id'])->first();

                if (!$product) {
                    throw new \Exception('Produk tidak ditemukan!');
                }

                $subtotal = $product->harga * $item['qty'];

                DB::table('order_items')->insert([
                    'order_id' => $orderId,
                    'product_id' => $item['product_id'],
                    'ukuran' => $item['ukuran'],
                    'qty' => $item['qty'],
                    'harga' => $product->harga,
                    'subtotal' => $subtotal,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::commit();

            return redirect()
                ->route('dashboard.pesanan')
                ->with('success', 'Pesanan berhasil ditambahkan!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menambahkan pesanan: ' . $e->getMessage());
        }
    }

    public function editPesanan($id)
    {
        $order = DB::table('orders')->where('id', $id)->first();

        $items = DB::table('order_items')
            ->where('order_id', $id)
            ->get();

        return response()->json([
            'order' => $order,
            'items' => $items
        ]);
    }

    public function updatePesanan(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_pemesan' => 'required|string|max:100',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'metode_pembayaran' => 'required|string',
            'status' => 'required|in:pending,proses,selesai,dibatalkan',
            'catatan' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.ukuran' => 'required|string|max:50',
            'items.*.qty' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            DB::table('orders')->where('id', $id)->update([
                'nama_pemesan' => $validated['nama_pemesan'],
                'no_hp' => $validated['no_hp'],
                'alamat' => $validated['alamat'],
                'metode_pembayaran' => $validated['metode_pembayaran'],
                'status' => $validated['status'],
                'catatan' => $validated['catatan'] ?? null,
                'updated_at' => now(),
            ]);

            DB::table('order_items')->where('order_id', $id)->delete();

            foreach ($validated['items'] as $item) {
                $product = DB::table('products')->where('id', $item['product_id'])->first();

                if (!$product) {
                    throw new \Exception('Produk tidak ditemukan!');
                }

                $subtotal = $product->harga * $item['qty'];

                DB::table('order_items')->insert([
                    'order_id' => $id,
                    'product_id' => $item['product_id'],
                    'ukuran' => $item['ukuran'],
                    'qty' => $item['qty'],
                    'harga' => $product->harga,
                    'subtotal' => $subtotal,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::commit();

            return redirect()->route('dashboard.pesanan')->with('success', 'Pesanan berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('dashboard.pesanan')->with('error', 'Gagal memperbarui pesanan: ' . $e->getMessage());
        }
    }

    public function destroyPesanan($id)
    {
        DB::beginTransaction();
        try {
            DB::table('order_items')->where('order_id', $id)->delete();
            DB::table('orders')->where('id', $id)->delete();
            DB::commit();

            return redirect()->route('dashboard.pesanan')->with('success', 'Pesanan berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('dashboard.pesanan')->with('error', 'Gagal menghapus pesanan!');
        }
    }

    public function reviewIndex(Request $request)
    {
        $query = Review::with(['product', 'user', 'parent.user'])
            ->whereNull('parent_id');

        if ($request->filled('product_id')) {
            $query->where('product_id', $request->product_id);
        }

        if ($request->filled('rating_filter')) {
            if ($request->rating_filter == 'positive') {
                $query->where('rating', '>=', 4);
            } elseif ($request->rating_filter == 'neutral') {
                $query->where('rating', 3);
            } elseif ($request->rating_filter == 'negative') {
                $query->where('rating', '<=', 2);
            }
        }

        if ($request->filled('keyword')) {
            $query->where(function($q) use ($request) {
                $q->where('komentar', 'like', '%' . $request->keyword . '%')
                  ->orWhereHas('user', function($q) use ($request) {
                      $q->where('name', 'like', '%' . $request->keyword . '%');
                  });
            });
        }

        $sortBy = $request->get('sort_by', 'terbaru');
        switch ($sortBy) {
            case 'terlama':
                $query->oldest();
                break;
            case 'rating_tertinggi':
                $query->orderBy('rating', 'desc');
                break;
            case 'rating_terendah':
                $query->orderBy('rating', 'asc');
                break;
            case 'likes_terbanyak':
                $query->orderBy('likes', 'desc');
                break;
            case 'dislikes_terbanyak':
                $query->orderBy('dislikes', 'desc');
                break;
            default:
                $query->latest();
        }

        $reviews = $query->paginate(12)->withQueryString();

        $total_reviews = Review::whereNull('parent_id')->count();
        $positive_reviews = Review::whereNull('parent_id')->where('rating', '>=', 4)->count();
        $neutral_reviews = Review::whereNull('parent_id')->where('rating', 3)->count();
        $negative_reviews = Review::whereNull('parent_id')->where('rating', '<=', 2)->count();
        $avg_rating = Review::whereNull('parent_id')->avg('rating');

        $products = Product::orderBy('nama_produk')->get();

        return view('admin.reviews.index', compact(
            'reviews',
            'total_reviews',
            'positive_reviews',
            'neutral_reviews',
            'negative_reviews',
            'avg_rating',
            'products'
        ));
    }

    public function reviewReply(Request $request, $id)
    {
        $request->validate([
            'komentar' => 'required|string|max:1000',
        ]);

        try {
            $review = Review::findOrFail($id);

            Review::create([
                'product_id' => $review->product_id,
                'user_id' => auth()->guard('customer')->id(),
                'parent_id' => $review->id,
                'rating' => null,
                'komentar' => $request->komentar,
                'foto' => null,
                'likes' => 0,
                'dislikes' => 0,
            ]);

            return redirect()->back()->with('success', 'Balasan berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan balasan: ' . $e->getMessage());
        }
    }

    public function reviewDestroy($id)
    {
        try {
            $review = Review::findOrFail($id);

            Review::where('parent_id', $review->id)->delete();

            if ($review->foto) {
                Storage::delete('public/reviews/' . $review->foto);
            }

            $review->delete();

            return redirect()->back()->with('success', 'Review berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus review: ' . $e->getMessage());
        }
    }

    public function memberIndex(Request $request)
    {
        $query = DB::table('customers');

        if ($request->keyword) {
            $query->where('username', 'LIKE', '%' . $request->keyword . '%')
                  ->orWhere('email', 'LIKE', '%' . $request->keyword . '%')
                  ->orWhere('no_hp', 'LIKE', '%' . $request->keyword . '%');
        }

        if ($request->status_filter) {
            $query->where('status', $request->status_filter);
        }

        if ($request->type_filter) {
            $query->where('tipe_member', $request->type_filter);
        }

        if ($request->date_filter) {
            switch ($request->date_filter) {
                case 'hari_ini':
                    $query->whereDate('created_at', Carbon::today());
                    break;
                case 'minggu_ini':
                    $query->whereBetween('created_at', [
                        Carbon::now()->startOfWeek(),
                        Carbon::now()->endOfWeek()
                    ]);
                    break;
                case 'bulan_ini':
                    $query->whereMonth('created_at', Carbon::now()->month)
                          ->whereYear('created_at', Carbon::now()->year);
                    break;
            }
        }

        $sortBy = $request->sort_by ?? 'terbaru';

        switch ($sortBy) {
            case 'terbaru':
                $query->orderBy('created_at', 'DESC');
                break;
            case 'terlama':
                $query->orderBy('created_at', 'ASC');
                break;
            case 'nama_az':
                $query->orderBy('username', 'ASC');
                break;
            case 'nama_za':
                $query->orderBy('username', 'DESC');
                break;
            case 'aktif':
                $query->orderBy('last_login', 'DESC');
                break;
        }

        $members = $query->paginate(10);

        $total_members = DB::table('customers')->count();
        $active_members = DB::table('customers')->where('status', 'aktif')->count();
        $inactive_members = DB::table('customers')->where('status', 'inaktif')->count();
        $new_members = DB::table('customers')
                        ->whereDate('created_at', Carbon::today())
                        ->count();

        return view('admin.member_index', compact(
            'members',
            'total_members',
            'active_members',
            'inactive_members',
            'new_members'
        ));
    }

    public function memberStore(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:customers,username|min:3|max:20',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|min:6',
            'no_hp' => 'required|unique:customers,no_hp',
            'alamat' => 'required',
            'tipe_member' => 'required|in:regular,vip,premium'
        ], [
            'username.required' => 'Username harus diisi',
            'username.unique' => 'Username sudah terdaftar',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'no_hp.required' => 'Nomor HP harus diisi',
            'no_hp.unique' => 'Nomor HP sudah terdaftar',
            'alamat.required' => 'Alamat harus diisi'
        ]);

        try {
            DB::table('customers')->insert([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'tipe_member' => $request->tipe_member,
                'status' => 'aktif',
                'is_verified' => false,
                'last_login' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Member berhasil ditambahkan!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function memberEdit($id)
    {
        $member = DB::table('customers')->where('id', $id)->first();

        if (!$member) {
            return response()->json([
                'success' => false,
                'message' => 'Member tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $member
        ]);
    }

    public function memberUpdate(Request $request, $id)
    {
        $member = DB::table('customers')->where('id', $id)->first();

        if (!$member) {
            return response()->json([
                'success' => false,
                'message' => 'Member tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'username' => 'required|min:3|max:20|unique:customers,username,' . $id,
            'email' => 'required|email|unique:customers,email,' . $id,
            'no_hp' => 'required|unique:customers,no_hp,' . $id,
            'alamat' => 'required',
            'tipe_member' => 'required|in:regular,vip,premium',
            'status' => 'required|in:aktif,inaktif'
        ]);

        try {
            $updateData = [
                'username' => $request->username,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'tipe_member' => $request->tipe_member,
                'status' => $request->status,
                'updated_at' => now(),
            ];

            if ($request->filled('password')) {
                $updateData['password'] = Hash::make($request->password);
            }

            DB::table('customers')->where('id', $id)->update($updateData);

            return response()->json([
                'success' => true,
                'message' => 'Member berhasil diperbarui!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function memberDestroy($id)
    {
        try {
            DB::table('customers')->where('id', $id)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Member berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function memberVerify($id)
    {
        try {
            DB::table('customers')->where('id', $id)->update([
                'is_verified' => true,
                'updated_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Member berhasil diverifikasi!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function memberChangeType($id, $type)
    {
        try {
            DB::table('customers')->where('id', $id)->update([
                'tipe_member' => $type,
                'updated_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Tipe member berhasil diubah!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function adminIndex(Request $request)
    {
        $query = DB::table('admins');

        if ($request->filled('keyword')) {
            $query->where(function($q) use ($request) {
                $q->where('nama', 'LIKE', '%'. $request->keyword. '%')
                  ->orWhere('email', 'LIKE', '%'. $request->keyword. '%');
            });
        }

        if ($request->filled('role_filter')) {
            $query->where('role', $request->role_filter);
        }

        if ($request->filled('status_filter')) {
            $query->where('status', $request->status_filter);
        }

        switch ($request->sort_by) {
            case 'terlama':
                $query->orderBy('created_at', 'asc');
                break;
            case 'nama_az':
                $query->orderBy('nama', 'asc');
                break;
            case 'nama_za':
                $query->orderBy('nama', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $admins = $query->paginate(10)->withQueryString();

        $total_admins = DB::table('admins')->count();
        $active_admins = DB::table('admins')->where('status', 'aktif')->count();
        $super_admins = DB::table('admins')->where('role', 'super_admin')->count();
        $new_admins = DB::table('admins')
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->count();

        return view('admin.admin_index', compact(
            'admins',
            'total_admins',
            'active_admins',
            'super_admins',
            'new_admins'
        ));
    }

    public function adminCreate()
    {
        return view('admin.admin_create');
    }

    public function adminStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:8',
            'role' => 'required|in:super_admin,admin,moderator',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        try {
            DB::table('admins')->insert([
                'nama'       => $request->nama,
                'email'      => $request->email,
                'password'   => Hash::make($request->password),
                'role'       => $request->role,
                'status'     => $request->status,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Admin berhasil ditambahkan!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan admin: ' . $e->getMessage()
            ], 500);
        }
    }

    public function adminEdit($id)
    {
        $admin = DB::table('admins')->where('id', $id)->first();
        return view('admin.admin_edit', compact('admin'));
    }

    public function adminUpdate(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $id,
            'role' => 'required|in:super_admin,admin,moderator',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        try {
            $data = [
                'nama'       => $request->nama,
                'email'      => $request->email,
                'role'       => $request->role,
                'status'     => $request->status,
                'updated_at' => now(),
            ];

            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            DB::table('admins')->where('id', $id)->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Admin berhasil diperbarui!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui admin: ' . $e->getMessage()
            ], 500);
        }
    }

    public function adminDestroy($id)
    {
        try {
            DB::table('admins')->where('id', $id)->delete();
            return redirect()->route('dashboard.admin.index')->with('success', 'Admin berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.admin.index')->with('error', 'Gagal menghapus admin!');
        }
    }

    public function adminChangeStatus($id, $status)
    {
        try {
            DB::table('admins')->where('id', $id)->update([
                'status' => $status,
                'updated_at' => now()
            ]);

            $statusText = $status == 'aktif' ? 'diaktifkan' : 'dinonaktifkan';

            return response()->json([
                'success' => true,
                'message' => "Admin berhasil {$statusText}!"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengubah status admin'
            ], 500);
        }
    }

    public function adminResetPassword($id)
    {
        try {
            $newPassword = 'admin123';

            DB::table('admins')->where('id', $id)->update([
                'password' => Hash::make($newPassword),
                'updated_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Password berhasil direset!',
                'new_password' => $newPassword
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mereset password'
            ], 500);
        }
    }

    public function pendapatan(Request $request)
    {
        $query = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->where('orders.status', 'selesai')
            ->select(
                'products.id',
                'products.nama_produk',
                'order_items.harga as harga_satuan',
                DB::raw('SUM(order_items.qty) as jumlah'),
                DB::raw('SUM(order_items.subtotal) as total_harga')
            );

        if ($request->filled('search')) {
            $query->where('products.nama_produk', 'LIKE', '%' . $request->search . '%');
        }

        if ($request->filled('date_from')) {
            $query->whereDate('orders.created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('orders.created_at', '<=', $request->date_to);
        }

        $query->groupBy('products.id', 'products.nama_produk', 'order_items.harga');

        switch ($request->sort_by) {
            case 'lowest_revenue':
                $query->orderBy('total_harga', 'asc');
                break;
            case 'most_sold':
                $query->orderBy('jumlah', 'desc');
                break;
            case 'least_sold':
                $query->orderBy('jumlah', 'asc');
                break;
            default:
                $query->orderBy('total_harga', 'desc');
                break;
        }

        $pendapatan = $query->get();

        $totalPendapatan = $pendapatan->sum('total_harga');

        $totalTransaksi = DB::table('orders')
            ->where('status', 'selesai')
            ->when($request->filled('date_from'), function($q) use ($request) {
                $q->whereDate('created_at', '>=', $request->date_from);
            })
            ->when($request->filled('date_to'), function($q) use ($request) {
                $q->whereDate('created_at', '<=', $request->date_to);
            })
            ->count();

        $totalProdukTerjual = $pendapatan->sum('jumlah');
        $rataRataTransaksi = $totalTransaksi > 0 ? $totalPendapatan / $totalTransaksi : 0;

        $topProducts = $pendapatan->take(3)->map(function($item) {
            return (object)[
                'nama_produk' => $item->nama_produk,
                'total_terjual' => $item->jumlah,
                'total_pendapatan' => $item->total_harga
            ];
        });

        return view('admin.pendapatan', compact(
            'pendapatan',
            'totalPendapatan',
            'totalTransaksi',
            'totalProdukTerjual',
            'rataRataTransaksi',
            'topProducts'
        ));
    }

    public function exportPendapatanExcel()
    {
        $pendapatan = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->where('orders.status', 'selesai')
            ->select(
                'products.nama_produk',
                'order_items.qty as jumlah',
                'order_items.harga as harga_satuan',
                'order_items.subtotal as total_harga'
            )
            ->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Produk');
        $sheet->setCellValue('C1', 'Jumlah');
        $sheet->setCellValue('D1', 'Harga');
        $sheet->setCellValue('E1', 'Total');

        $row = 2;
        $no = 1;

        foreach ($pendapatan as $p) {
            $sheet->setCellValue('A'.$row, $no++);
            $sheet->setCellValue('B'.$row, $p->nama_produk);
            $sheet->setCellValue('C'.$row, $p->jumlah);
            $sheet->setCellValue('D'.$row, $p->harga_satuan);
            $sheet->setCellValue('E'.$row, $p->total_harga);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'laporan_pendapatan.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$fileName.'"');

        $writer->save('php://output');
        exit;
    }

    public function pendapatanChart(Request $request)
    {
        $baseQuery = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->where('orders.status', 'selesai');

        if ($request->filled('date_from')) {
            $baseQuery->whereDate('orders.created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $baseQuery->whereDate('orders.created_at', '<=', $request->date_to);
        }

        if ($request->filled('search')) {
            $baseQuery->where('products.nama_produk', 'like', '%' . $request->search . '%');
        }

        $chartData = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->where('orders.status', 'selesai');

        if ($request->filled('date_from')) {
            $chartData->whereDate('orders.created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $chartData->whereDate('orders.created_at', '<=', $request->date_to);
        }
        if ($request->filled('search')) {
            $chartData->where('products.nama_produk', 'like', '%' . $request->search . '%');
        }

        $chartData = $chartData
            ->select(
                DB::raw('DATE(orders.created_at) as tanggal'),
                DB::raw('SUM(order_items.subtotal) + 0 as total'),
                DB::raw('COUNT(DISTINCT orders.id) + 0 as jumlah_transaksi'),
                DB::raw('SUM(order_items.qty) + 0 as total_produk')
            )
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();

        $labels = $chartData->pluck('tanggal')->map(function($date) {
            return \Carbon\Carbon::parse($date)->format('d M');
        });
        $totals = $chartData->pluck('total');
        $transaksiPerHari = $chartData->pluck('jumlah_transaksi');
        $produkPerHari = $chartData->pluck('total_produk');

        $summaryQuery = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->where('orders.status', 'selesai');

        if ($request->filled('date_from')) {
            $summaryQuery->whereDate('orders.created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $summaryQuery->whereDate('orders.created_at', '<=', $request->date_to);
        }
        if ($request->filled('search')) {
            $summaryQuery->where('products.nama_produk', 'like', '%' . $request->search . '%');
        }

        $totalPendapatan = $summaryQuery->sum('order_items.subtotal');

        $transaksiQuery = DB::table('orders')->where('status', 'selesai');
        if ($request->filled('date_from')) {
            $transaksiQuery->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $transaksiQuery->whereDate('created_at', '<=', $request->date_to);
        }
        $totalTransaksi = $transaksiQuery->count();

        $produkQuery = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->where('orders.status', 'selesai');
        if ($request->filled('date_from')) {
            $produkQuery->whereDate('orders.created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $produkQuery->whereDate('orders.created_at', '<=', $request->date_to);
        }
        if ($request->filled('search')) {
            $produkQuery->where('products.nama_produk', 'like', '%' . $request->search . '%');
        }
        $totalProdukTerjual = $produkQuery->sum('order_items.qty');

        $rataRataTransaksi = $totalTransaksi > 0 ? $totalPendapatan / $totalTransaksi : 0;

        $topDaysQuery = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->where('orders.status', 'selesai');

        if ($request->filled('date_from')) {
            $topDaysQuery->whereDate('orders.created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $topDaysQuery->whereDate('orders.created_at', '<=', $request->date_to);
        }
        if ($request->filled('search')) {
            $topDaysQuery->where('products.nama_produk', 'like', '%' . $request->search . '%');
        }

        $topDays = $topDaysQuery
            ->select(
                DB::raw('DATE(orders.created_at) as tanggal'),
                DB::raw('SUM(order_items.subtotal) as total'),
                DB::raw('COUNT(DISTINCT orders.id) as transaksi'),
                DB::raw('SUM(order_items.qty) as produk_terjual')
            )
            ->groupBy('tanggal')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        $produkStatsQuery = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->where('orders.status', 'selesai');

        if ($request->filled('date_from')) {
            $produkStatsQuery->whereDate('orders.created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $produkStatsQuery->whereDate('orders.created_at', '<=', $request->date_to);
        }
        if ($request->filled('search')) {
            $produkStatsQuery->where('products.nama_produk', 'like', '%' . $request->search . '%');
        }

        $produkStatsQuery = $produkStatsQuery
            ->select(
                'products.nama_produk as nama_produk',
                DB::raw('SUM(order_items.qty) as total_terjual'),
                DB::raw('SUM(order_items.subtotal) as total_pendapatan'),
                DB::raw('COUNT(DISTINCT orders.id) as jumlah_transaksi')
            )
            ->groupBy('products.id', 'products.nama_produk');

        switch ($request->sort_by) {
            case 'lowest_revenue':
                $produkStatsQuery->orderBy('total_pendapatan', 'asc');
                break;
            case 'most_sold':
                $produkStatsQuery->orderBy('total_terjual', 'desc');
                break;
            case 'least_sold':
                $produkStatsQuery->orderBy('total_terjual', 'asc');
                break;
            default:
                $produkStatsQuery->orderBy('total_pendapatan', 'desc');
        }

        $produkStats = $produkStatsQuery->get();

        return view('admin.pendapatan.chart', compact(
            'labels',
            'totals',
            'transaksiPerHari',
            'produkPerHari',
            'totalPendapatan',
            'totalTransaksi',
            'totalProdukTerjual',
            'rataRataTransaksi',
            'topDays',
            'produkStats'
        ));
    }
}