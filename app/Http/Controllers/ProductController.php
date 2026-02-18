<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Category;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $query = Product::with('category')->withSum('orderItems as total_terjual', 'qty');

        if ($request->filled('keyword')) {
            $query->where('nama_produk', 'LIKE', '%' . $request->keyword . '%');
        }

        if ($request->filled('kategori')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('nama_kategori', $request->kategori);
            });
        }

        if ($request->filled('min_harga')) {
            $query->where('harga', '>=', $request->min_harga);
        }

        if ($request->filled('max_harga')) {
            $query->where('harga', '<=', $request->max_harga);
        }

        if ($request->filled('urutkan')) {
            switch ($request->urutkan) {
                case 'terlaris':
                    $query->orderByDesc('total_terjual');
                    break;
                case 'harga_rendah':
                    $query->orderBy('harga', 'asc');
                    break;
                case 'harga_tinggi':
                    $query->orderBy('harga', 'desc');
                    break;
                case 'terbaru':
                default:
                    $query->orderByDesc('id');
                    break;
            }
        } elseif ($request->tab === 'best-seller') {
            $query->orderByDesc('total_terjual');
        } else {
            $query->orderByDesc('id');
        }

        $products = $query->paginate(8)->withQueryString();
        $categories = Category::orderBy('nama_kategori', 'asc')->get();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'products_html' => view('partials.product-list', compact('products'))->render(),
                'pagination_html' => view('partials.pagination', compact('products'))->render(),
            ]);
        }

        return view('index', compact('products', 'categories'));
    }

    public function all(Request $request)
    {
        $query = Product::with('category')->withSum('orderItems as total_terjual', 'qty');

        if ($request->filled('keyword')) {
            $query->where('nama_produk', 'LIKE', '%' . $request->keyword . '%');
        }

        if ($request->filled('kategori')) {
            $categories = is_array($request->kategori) ? $request->kategori : [$request->kategori];
            $query->whereHas('category', function($q) use ($categories) {
                $q->whereIn('nama_kategori', $categories);
            });
        }

        if ($request->filled('min_harga')) {
            $query->where('harga', '>=', $request->min_harga);
        }
        
        if ($request->filled('max_harga')) {
            $query->where('harga', '<=', $request->max_harga);
        }

        switch ($request->urutkan) {
            case 'terlaris':
                $query->orderBy('total_terjual', 'desc');
                break;
            case 'harga_rendah':
                $query->orderBy('harga', 'asc');
                break;
            case 'harga_tinggi':
                $query->orderBy('harga', 'desc');
                break;
            default:
                $query->orderBy('id', 'desc');
                break;
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::orderBy('nama_kategori', 'asc')->get();

        return view('products.all', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = DB::table('products')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.nama_kategori')
            ->where('products.id', $id)
            ->first();

        if (!$product) abort(404);

        $reviews = DB::table('reviews')
            ->where('product_id', $id)
            ->whereNull('parent_id')
            ->orderBy('created_at', 'desc')
            ->get();

        $replies = DB::table('reviews')
            ->where('product_id', $id)
            ->whereNotNull('parent_id')
            ->get();

        $sizeChartData = $this->parseSizeChart($product);

        return view('products.show', compact('product', 'reviews', 'replies', 'sizeChartData'));
    }

  
    private function parseSizeChart($product)
    {
        $kategori = strtolower(trim($product->nama_kategori ?? 'lainnya'));
        
        $kategori = $this->normalizeCategory($kategori);
        
        $tabelUkuran = trim($product->tabel_ukuran ?? '');

        $categoryHeaders = [
            'kaos' => ['Panjang', 'Lebar', 'Pundak', 'Lengan', 'Lebar Lengan'],
            'kemeja' => ['Panjang', 'Lebar', 'Pundak', 'Lengan', 'Lebar Lengan'],
            'hoodie' => ['Panjang', 'Lebar', 'Pundak', 'Lengan', 'Lebar Lengan'],
            'jaket' => ['Panjang', 'Lebar', 'Pundak', 'Lengan', 'Lebar Lengan'],
            'sweater' => ['Panjang', 'Lebar', 'Pundak', 'Lengan', 'Lebar Lengan'],
            'blazer' => ['Panjang', 'Lebar', 'Pundak', 'Lengan', 'Lebar Lengan'],
            
          
            'celana' => ['Pinggang', 'Paha', 'Panjang', 'Kaki'],
            'celana_panjang' => ['Pinggang', 'Paha', 'Panjang', 'Kaki'],
            'celana_pendek' => ['Pinggang', 'Paha', 'Panjang'],
            'jeans' => ['Pinggang', 'Paha', 'Panjang', 'Kaki'],
            'jogger' => ['Pinggang', 'Paha', 'Panjang', 'Kaki'],
            'rok' => ['Pinggang', 'Pinggul', 'Panjang'],
            
            
            'topi' => ['Lingkar Kepala'],
            'topi_snapback' => ['Lingkar Kepala'],
            'topi_bucket' => ['Lingkar Kepala'],
            'topi_baseball' => ['Lingkar Kepala'],
            'beanie' => ['Lingkar Kepala'],
            
          
            'sepatu' => ['Ukuran'],
            'sepatu_sneakers' => ['Ukuran'],
            'sepatu_boots' => ['Ukuran'],
            'sepatu_formal' => ['Ukuran'],
            'sandal' => ['Ukuran'],
            'sandal_slide' => ['Ukuran'],
            'sandal_jepit' => ['Ukuran'],
            
            
            'jam_tangan' => ['Lingkar Tangan'],
            'gelang' => ['Lingkar Tangan'],
            'sarung_tangan' => ['Ukuran'],
            
            
            'tas' => ['Ukuran'],
            'tas_ransel' => ['Panjang', 'Lebar', 'Tinggi'],
            'tas_selempang' => ['Panjang', 'Lebar', 'Tinggi'],
            'tas_tangan' => ['Panjang', 'Lebar', 'Tinggi'],
            'dompet' => ['Panjang', 'Lebar'],
            
           
            'ikat_pinggang' => ['Panjang'],
            'kaos_kaki' => ['Ukuran'],
            'masker' => ['Ukuran'],
            'syal' => ['Panjang', 'Lebar'],
            'aksesoris' => ['Ukuran'],
            
          
            'lainnya' => ['Ukuran']
        ];

        $headers = $categoryHeaders[$kategori] ?? ['Ukuran'];

        $type = 'none';
        $sizes = [];

       
        if (empty($tabelUkuran)) {
            return [
                'type' => 'none',
                'headers' => [],
                'sizes' => $this->getDefaultSizes($kategori),
                'kategori' => $kategori
            ];
        }

  
        if (preg_match('/[A-Za-z0-9]+\s*\([0-9\sxX×\-\.]+\)/', $tabelUkuran)) {
            $type = 'detailed';
            
            preg_match_all('/([A-Za-z0-9\-]+)\s*\(([^)]+)\)/', $tabelUkuran, $matches, PREG_SET_ORDER);

            foreach ($matches as $match) {
                $size = trim($match[1]);
                $dimensionsStr = trim($match[2]);
                
               
                $dimensions = preg_split('/\s*[xX×\-]\s*/', $dimensionsStr);
                
               
                $dimensions = array_map(function($dim) {
                    return trim(str_replace(['cm', 'CM'], '', $dim));
                }, $dimensions);
                
                $dimensions = array_filter($dimensions);

                $sizes[] = [
                    'size' => $size,
                    'dimensions' => array_values($dimensions)
                ];
            }
        }

    
        elseif (preg_match('/^([0-9]{2})+$/', $tabelUkuran) && strlen($tabelUkuran) >= 4) {
            $type = 'simple_list';
            
            $sizeList = str_split($tabelUkuran, 2);

            foreach ($sizeList as $s) {
                $sizes[] = [
                    'size' => $s,
                    'dimensions' => []
                ];
            }
        }

      
        elseif (preg_match('/^([A-Za-z0-9]+)\s*[\-–]\s*([A-Za-z0-9]+)\s*(cm|CM)?$/', $tabelUkuran, $rangeMatch)) {
            $type = 'range';
            
            $start = trim($rangeMatch[1]);
            $end = trim($rangeMatch[2]);
            $unit = isset($rangeMatch[3]) ? trim($rangeMatch[3]) : '';
            
          
            if (is_numeric($start) && is_numeric($end)) {
                $startNum = (int)$start;
                $endNum = (int)$end;
                
                for ($i = $startNum; $i <= $endNum; $i++) {
                    $sizes[] = [
                        'size' => $i . ($unit ? ' ' . $unit : ''),
                        'dimensions' => []
                    ];
                }
            } else {
          
                $type = 'text';
                $sizes[] = [
                    'size' => $tabelUkuran,
                    'dimensions' => []
                ];
            }
        }

     
        elseif (preg_match('/^[0-9A-Za-z\s,\-\.]+$/', $tabelUkuran)) {
            $type = 'simple_list';
            
       
            $sizeList = preg_split('/[\s,]+/', $tabelUkuran);

            foreach ($sizeList as $s) {
                $s = trim($s);
                if (!empty($s)) {
                    $sizes[] = [
                        'size' => $s,
                        'dimensions' => []
                    ];
                }
            }
        }

     
        else {
            $type = 'text';
            
            $sizes[] = [
                'size' => $tabelUkuran,
                'dimensions' => []
            ];
        }

     
        if (empty($sizes)) {
            $sizes = $this->getDefaultSizes($kategori);
            $type = 'simple_list';
        }

        return [
            'type' => $type,
            'headers' => $headers,
            'sizes' => $sizes,
            'kategori' => $kategori
        ];
    }

    
    private function normalizeCategory($kategori)
    {
        
        $categoryMap = [
          
            'kaos' => ['kaos', 't-shirt', 'tshirt', 'tee', 'polo', 'shirt'],
            'kemeja' => ['kemeja', 'shirt', 'dress shirt', 'formal shirt'],
            'hoodie' => ['hoodie', 'sweater hoodie', 'jaket hoodie'],
            'jaket' => ['jaket', 'jacket', 'varsity', 'bomber', 'windbreaker'],
            'sweater' => ['sweater', 'sweatshirt', 'crewneck'],
            'blazer' => ['blazer', 'jas', 'suit'],
            
           
            'celana' => ['celana', 'pants', 'trousers'],
            'celana_panjang' => ['celana panjang', 'long pants'],
            'celana_pendek' => ['celana pendek', 'shorts', 'short pants'],
            'jeans' => ['jeans', 'denim'],
            'jogger' => ['jogger', 'jogger pants', 'celana jogger'],
            'rok' => ['rok', 'skirt'],
            
          
            'topi' => ['topi', 'cap', 'hat'],
            'topi_snapback' => ['snapback', 'topi snapback'],
            'topi_bucket' => ['bucket hat', 'topi bucket'],
            'topi_baseball' => ['baseball cap', 'topi baseball'],
            'beanie' => ['beanie', 'kupluk'],
            
           
            'sepatu' => ['sepatu', 'shoes'],
            'sepatu_sneakers' => ['sneakers', 'sepatu sneakers', 'sepatu kets'],
            'sepatu_boots' => ['boots', 'sepatu boots'],
            'sepatu_formal' => ['sepatu formal', 'formal shoes', 'pantofel'],
            'sandal' => ['sandal', 'sandals'],
            'sandal_slide' => ['slide', 'sandal slide'],
            'sandal_jepit' => ['sandal jepit', 'flip flop'],
            

            'jam_tangan' => ['jam tangan', 'jam', 'watch'],
            'gelang' => ['gelang', 'bracelet'],
            'tas' => ['tas', 'bag'],
            'tas_ransel' => ['ransel', 'backpack', 'tas ransel'],
            'tas_selempang' => ['selempang', 'sling bag', 'tas selempang'],
            'tas_tangan' => ['tas tangan', 'handbag'],
            'dompet' => ['dompet', 'wallet'],
            'ikat_pinggang' => ['ikat pinggang', 'belt', 'sabuk'],
            'kaos_kaki' => ['kaos kaki', 'socks'],
            'syal' => ['syal', 'scarf'],
            'aksesoris' => ['aksesoris', 'accessories', 'acc'],
        ];

        foreach ($categoryMap as $standard => $variations) {
            foreach ($variations as $variation) {
                if (str_contains($kategori, $variation)) {
                    return $standard;
                }
            }
        }

        return 'lainnya';
    }

  
    private function getDefaultSizes($kategori)
    {
        $defaultSizes = [
        
            'kaos' => ['S', 'M', 'L', 'XL', 'XXL'],
            'kemeja' => ['S', 'M', 'L', 'XL', 'XXL'],
            'hoodie' => ['S', 'M', 'L', 'XL', 'XXL'],
            'jaket' => ['S', 'M', 'L', 'XL', 'XXL'],
            'sweater' => ['S', 'M', 'L', 'XL', 'XXL'],
            'blazer' => ['S', 'M', 'L', 'XL', 'XXL'],
            
          
            'celana' => ['28', '29', '30', '31', '32', '33', '34', '35', '36'],
            'celana_panjang' => ['28', '29', '30', '31', '32', '33', '34', '35', '36'],
            'celana_pendek' => ['28', '29', '30', '31', '32', '33', '34'],
            'jeans' => ['28', '29', '30', '31', '32', '33', '34', '35', '36'],
            'jogger' => ['S', 'M', 'L', 'XL', 'XXL'],
            'rok' => ['S', 'M', 'L', 'XL'],
            
           
            'sepatu' => ['38', '39', '40', '41', '42', '43', '44'],
            'sepatu_sneakers' => ['38', '39', '40', '41', '42', '43', '44'],
            'sepatu_boots' => ['38', '39', '40', '41', '42', '43', '44'],
            'sepatu_formal' => ['38', '39', '40', '41', '42', '43', '44'],
            'sandal' => ['38', '39', '40', '41', '42', '43', '44'],
            'sandal_slide' => ['38', '39', '40', '41', '42', '43', '44'],
            'sandal_jepit' => ['38', '39', '40', '41', '42', '43', '44'],
            
           
            'topi' => ['All Size'],
            'topi_snapback' => ['All Size'],
            'topi_bucket' => ['All Size'],
            'topi_baseball' => ['All Size'],
            'beanie' => ['All Size'],
            
           
            'jam_tangan' => ['All Size'],
            'gelang' => ['All Size'],
            
         
            'tas' => ['All Size'],
            'tas_ransel' => ['All Size'],
            'tas_selempang' => ['All Size'],
            'tas_tangan' => ['All Size'],
            'dompet' => ['All Size'],
            
            
            'kaos_kaki' => ['All Size'],
            'ikat_pinggang' => ['All Size'],
            'syal' => ['All Size'],
            'aksesoris' => ['All Size'],
        ];

        $sizes = $defaultSizes[$kategori] ?? ['All Size'];
        
        return array_map(function($size) {
            return ['size' => $size, 'dimensions' => []];
        }, $sizes);
    }

    public function storeReview(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:50',
            'komentar' => 'required',
            'rating' => 'nullable|integer|min:1|max:5'
        ]);

       $fotoName = null;

        if ($request->hasFile('foto')) {
            $fotoName = time() . '.' . $request->foto->extension();
            $request->file('foto')->storeAs('reviews', $fotoName, 'public');
        }


        $isiReview = $request->nama . "|" . $request->komentar;

        DB::table('reviews')->insert([
            'product_id' => $request->product_id,
            'user_id'    => 0,
            'parent_id'  => $request->parent_id ?? null,
            'rating'     => $request->rating ?? 5,
            'komentar'   => $isiReview,
            'foto'       => $fotoName,
            'likes'      => 0,
            'dislikes'   => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success_review', 'Terima kasih! Ulasan Anda telah dipublikasikan.');
    }

    public function voteReview(Request $request, $id)
    {
        $review = DB::table('reviews')->where('id', $id);
        $data = $review->first();

        if ($request->type == 'like') {
            $review->update(['likes' => $data->likes + 1]);
        } else {
            $review->update(['dislikes' => $data->dislikes + 1]);
        }

        $updated = $review->first();
        return response()->json([
            'success' => true,
            'likes' => $updated->likes,
            'dislikes' => $updated->dislikes
        ]);
    }

    public function addToCart(Request $request, $id)
    {
        $product = DB::table('products')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.nama_kategori')
            ->where('products.id', $id)
            ->first();

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan!'
            ], 404);
        }

        $quantity = $request->input('quantity', 1);

        if ($quantity < 1) {
            return response()->json([
                'success' => false,
                'message' => 'Jumlah minimal pembelian adalah 1!'
            ], 400);
        }

        if ($product->stok < $quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Stok tidak mencukupi! Stok tersedia: ' . $product->stok
            ], 400);
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $totalQty = $cart[$id]['quantity'] + $quantity;
            if ($product->stok < $totalQty) {
                return response()->json([
                    'success' => false,
                    'message' => 'Total quantity melebihi stok yang tersedia! Maksimal: ' . $product->stok
                ], 400);
            }
            $cart[$id]['quantity'] = $totalQty;
        } else {
          
            $sizeChartData = $this->parseSizeChart($product);
            
            $cart[$id] = [
                "name" => $product->nama_produk,
                "quantity" => $quantity,
                "price" => $product->harga,
                "image" => $product->gambar,
                "stok" => $product->stok,
                "sizeChartData" => $sizeChartData,
                "size" => !empty($sizeChartData['sizes']) ? $sizeChartData['sizes'][0]['size'] : 'All Size'
            ];
        }

        session()->put('cart', $cart);

        $cartCount = count(session()->get('cart'));

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil ditambahkan ke keranjang!',
            'cart_count' => $cartCount
        ]);
    }

    public function showCart()
    {
        $cart = session()->get('cart', []);

        foreach ($cart as $id => $item) {
            $product = DB::table('products')
                ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
                ->select('products.*', 'categories.nama_kategori')
                ->where('products.id', $id)
                ->first();
                
            if ($product) {
                $cart[$id]['current_stok'] = $product->stok;
                $cart[$id]['stok_available'] = $product->stok >= $item['quantity'];
                $cart[$id]['price'] = $product->harga;

                
                if (!isset($cart[$id]['sizeChartData'])) {
                    $cart[$id]['sizeChartData'] = $this->parseSizeChart($product);
                }

               
                if (!isset($cart[$id]['size']) || empty($cart[$id]['size'])) {
                    $sizeChartData = $cart[$id]['sizeChartData'];
                    if (!empty($sizeChartData['sizes'])) {
                        $cart[$id]['size'] = $sizeChartData['sizes'][0]['size'];
                    } else {
                        $cart[$id]['size'] = 'All Size';
                    }
                }
            } else {
                unset($cart[$id]);
            }
        }

        session()->put('cart', $cart);

        $recommendations = DB::table('products')
    ->leftJoin('order_items', 'products.id', '=', 'order_items.product_id')
    ->select(
        'products.id',
        'products.nama_produk',
        'products.harga',
        'products.stok',
        'products.gambar',
        DB::raw('COALESCE(SUM(order_items.qty), 0) as total_terjual')
    )
    ->where('products.stok', '>', 0)
    ->groupBy(
        'products.id',
        'products.nama_produk',
        'products.harga',
        'products.stok',
        'products.gambar'
    )
    ->orderByDesc('total_terjual')
    ->limit(4)
    ->get();


        return view('order.cart', compact('cart', 'recommendations'));
    }

    public function updateSize(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'size' => 'required|string',
        ]);

        $cart = session()->get('cart', []);
        $productId = $request->id;

        if (isset($cart[$productId])) {
            $cart[$productId]['size'] = $request->size;
            session()->put('cart', $cart);

            return response()->json([
                'success' => true,
                'message' => 'Ukuran berhasil diperbarui!',
                'cart_count' => count($cart)
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Produk tidak ditemukan di keranjang.'
        ], 404);
    }

    public function removeFromCart(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang!');
        }

        return redirect()->back()->with('error', 'Produk tidak ditemukan!');
    }

    public function removeFromCheckout(Request $request)
    {
        $id = $request->id;
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        if (empty($cart)) {
            return redirect()->route('home')
                ->with('error', 'Semua produk dihapus dari checkout.');
        }

        return redirect()->back()->with('success', 'Produk dihapus dari checkout.');
    }

    public function updateCart(Request $request)
    {
        $request->validate([
            'id'       => 'required',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);
        $productId = $request->id;
        $newQty = (int) $request->quantity;

        if (!isset($cart[$productId])) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan di keranjang.'
            ], 404);
        }

        $product = DB::table('products')->where('id', $productId)->first();

        if (!$product) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
            return response()->json([
                'success' => false,
                'message' => 'Produk sudah tidak tersedia dan dihapus dari keranjang.'
            ], 404);
        }

        if ($product->stok <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'Stok produk sudah habis.'
            ], 400);
        }

        if ($newQty > $product->stok) {
            return response()->json([
                'success' => false,
                'message' => "Jumlah melebihi stok! Stok tersisa hanya {$product->stok} item."
            ], 400);
        }

        $cart[$productId]['quantity'] = $newQty;
        session()->put('cart', $cart);

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return response()->json([
            'success' => true,
            'message' => 'Jumlah produk berhasil diperbarui.',
            'subtotal' => 'Rp' . number_format($cart[$productId]['price'] * $newQty, 0, ',', '.'),
            'total_all' => 'Rp' . number_format($total, 0, ',', '.'),
            'cart_count' => count($cart),
            'total_unit' => collect($cart)->sum('quantity')
        ]);
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('home')
                ->with('error', 'Keranjang kamu masih kosong!');
        }

        $hasStockIssue = false;
        $errorMessage = '';

        foreach ($cart as $id => $item) {
            $product = DB::table('products')
                ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
                ->select('products.*', 'categories.nama_kategori')
                ->where('products.id', $id)
                ->first();

            if (!$product) {
                unset($cart[$id]);
                $hasStockIssue = true;
                $errorMessage = 'Beberapa produk tidak tersedia lagi.';
                continue;
            }

            $cart[$id]['price'] = $product->harga;

            
            if (!isset($cart[$id]['sizeChartData'])) {
                $cart[$id]['sizeChartData'] = $this->parseSizeChart($product);
            }

            
            if (!isset($cart[$id]['size']) || empty($cart[$id]['size'])) {
                $sizeChartData = $cart[$id]['sizeChartData'];
                if (!empty($sizeChartData['sizes'])) {
                    $cart[$id]['size'] = $sizeChartData['sizes'][0]['size'];
                } else {
                    $cart[$id]['size'] = 'All Size';
                }
            }

            if ($product->stok < $item['quantity']) {
                $hasStockIssue = true;
                $errorMessage = "Stok {$product->nama_produk} tidak mencukupi! Tersedia: {$product->stok}";

                if ($product->stok > 0) {
                    $cart[$id]['quantity'] = $product->stok;
                } else {
                    unset($cart[$id]);
                }
            }
        }

        session()->put('cart', $cart);

        if ($hasStockIssue) {
            return redirect()->route('cart.show')
                ->with('error', $errorMessage);
        }

        $customer = auth()->guard('customer')->user();

        return view('order.checkout', compact('cart', 'customer'));
    }

    public function processCheckout(Request $request)
    {
        $cart = session()->get('cart');

        if (!$cart || count($cart) === 0) {
            return redirect()->route('home')
                ->with('error', 'Keranjang kosong!');
        }

        $request->validate([
            'nama_pemesan'      => 'required|string|max:255',
            'no_hp'             => 'required|string|max:20',
            'alamat'            => 'required|string',
            'metode_pembayaran' => 'required|in:cod,transfer',
            'bukti_transfer'    => 'required_if:metode_pembayaran,transfer|image|mimes:jpg,jpeg,png|max:10240',
        ], [
            'nama_pemesan.required' => 'Nama pemesan wajib diisi',
            'no_hp.required' => 'Nomor HP wajib diisi',
            'alamat.required' => 'Alamat pengiriman wajib diisi',
            'metode_pembayaran.required' => 'Pilih metode pembayaran',
            'bukti_transfer.required_if' => 'Bukti transfer wajib diupload untuk pembayaran transfer',
        ]);

        
        foreach ($cart as $id => $item) {
            if (!isset($item['size']) || empty($item['size'])) {
                return back()->withInput()->with('error', "Harap pilih ukuran untuk produk: {$item['name']}");
            }
        }

        $customer = auth()->guard('customer')->user();
        $namaPemesan = ($customer && !empty($customer->nama))
            ? $customer->nama
            : $request->nama_pemesan;

        $noHp = ($customer && !empty($customer->no_hp))
            ? $customer->no_hp
            : $request->no_hp;

        $alamat = ($customer && !empty($customer->alamat))
            ? $customer->alamat
            : $request->alamat;

        $buktiTransferPath = null;
        if ($request->metode_pembayaran === 'transfer' && $request->hasFile('bukti_transfer')) {
            $file = $request->file('bukti_transfer');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

            $path = public_path('images/transfer');
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            $file->move($path, $filename);
            $buktiTransferPath = 'images/transfer/' . $filename;
        }

        $orderId = null;
        $orderData = [];

        try {
            DB::transaction(function () use (
                $cart,
                $customer,
                $namaPemesan,
                $noHp,
                $alamat,
                $request,
                $buktiTransferPath,
                &$orderId,
                &$orderData
            ) {
                $orderId = DB::table('orders')->insertGetId([
                    'customer_id'       => $customer?->id,
                    'nama_pemesan'      => $namaPemesan,
                    'no_hp'             => $noHp,
                    'alamat'            => $alamat,
                    'status'            => 'pending',
                    'catatan'           => $request->catatan,
                    'metode_pembayaran' => $request->metode_pembayaran,
                    'bukti_transfer'    => $buktiTransferPath,
                    'created_at'        => now(),
                    'updated_at'        => now(),
                ]);

                foreach ($cart as $productId => $item) {
                    $product = DB::table('products')
                        ->where('id', $productId)
                        ->lockForUpdate()
                        ->first();

                    if (!$product) {
                        throw new \Exception("Produk {$item['name']} tidak ditemukan");
                    }

                    if ($product->stok < $item['quantity']) {
                        throw new \Exception("Stok {$product->nama_produk} tidak mencukupi! Tersedia: {$product->stok}");
                    }

                    $ukuran = $item['size'] ?? 'All Size';

                    DB::table('order_items')->insert([
                        'order_id'   => $orderId,
                        'product_id' => $productId,
                        'ukuran'     => $ukuran,
                        'qty'        => $item['quantity'],
                        'harga'      => $item['price'],
                        'subtotal'   => $item['price'] * $item['quantity'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    DB::table('products')
                        ->where('id', $productId)
                        ->update([
                            'stok' => $product->stok - $item['quantity'],
                            'updated_at' => now()
                        ]);

                    $orderData[] = [
                        'nama_produk' => $item['name'],
                        'ukuran'      => $ukuran,
                        'qty'         => $item['quantity'],
                        'harga'       => $item['price'],
                        'subtotal'    => $item['price'] * $item['quantity'],
                    ];
                }
            });

            session()->forget('cart');

            return redirect()->route('checkout.success')->with([
                'order_id' => $orderId,
                'orders'   => $orderData,
                'customer' => $namaPemesan,
                'metode'   => $request->metode_pembayaran
            ]);

        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function checkoutSuccess()
    {
        $orders = session('orders');
        $customer = session('customer');
        $orderId = session('order_id');
        $metode = session('metode');

        if (!$orders) {
            return redirect()->route('home');
        }

        return view('order.checkout_success', [
            'orders'   => $orders,
            'customer' => $customer,
            'order_id' => $orderId,
            'metode'   => $metode,
            'status'   => 'pending'
        ]);
    }

    public function directCheckout(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'size' => 'required|string',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = DB::table('products')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.nama_kategori')
            ->where('products.id', $request->product_id)
            ->first();

        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan!');
        }

        if ($product->stok < $request->quantity) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi! Tersedia: ' . $product->stok);
        }

       
        $sizeChartData = $this->parseSizeChart($product);

        $cart = [];
        $cart[$product->id] = [
            "name" => $product->nama_produk,
            "quantity" => $request->quantity,
            "price" => $product->harga,
            "image" => $product->gambar,
            "stok" => $product->stok,
            "size" => $request->size,
            "sizeChartData" => $sizeChartData
        ];

        session()->put('cart', $cart);

        return redirect()->route('checkout.index');
    }
}