<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request) {
        $query = DB::table('categories')
                    ->leftJoin(
                        DB::raw('(SELECT category_id, COUNT(*) as product_count FROM products GROUP BY category_id) as product_counts'),
                        'categories.id',
                        '=',
                        'product_counts.category_id'
                    )
                    ->select('categories.*', DB::raw('COALESCE(product_counts.product_count, 0) as product_count'));
        
        
        if ($request->keyword) {
            $query->where('categories.nama_kategori', 'LIKE', '%'. $request->keyword. '%');
        }
        
        $query->orderBy('categories.nama_kategori', 'asc');
        
        $categories = $query->get();
        
       
        $total_kategori = DB::table('categories')->count();
        $kategori_terpakai = DB::table('categories')
                            ->whereExists(function($query) {
                                $query->select(DB::raw(1))
                                      ->from('products')
                                      ->whereRaw('products.category_id = categories.id');
                            })
                            ->count();
        $kategori_kosong = $total_kategori - $kategori_terpakai;
        
        return view('admin.kategori_index', compact('categories', 'total_kategori', 'kategori_terpakai', 'kategori_kosong'));
    }

    
    public function create() {
        return view('admin.kategori_create'); 
    }

   
    public function store(Request $request) {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
            'gambar' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
        ]);

       
        $namaGambar = null;
        if ($request->hasFile('gambar')) {
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/categories';
        
           
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
        
            $file = $request->file('gambar');
            $namaGambar = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->move($destinationPath, $namaGambar);
        }


        DB::table('categories')->insert([
            'nama_kategori' => $request->nama_kategori,
            'slug' => Str::slug($request->slug),
            'gambar' => $namaGambar,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('dashboard.kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    
    public function edit($id) {
        $category = DB::table('categories')->where('id', $id)->first();
        return view('admin.kategori_edit', compact('category'));
    }

    
    public function update(Request $request, $id) {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,'.$id,
            'gambar' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
        ]);

        $category = DB::table('categories')->where('id', $id)->first();
        $namaGambar = $category->gambar;

        if ($request->hasFile('gambar')) {
                $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/images/categories';
            
                
                if ($category->gambar && file_exists($destinationPath . '/' . $category->gambar)) {
                    unlink($destinationPath . '/' . $category->gambar);
                }
            
               
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
            
              
                $file = $request->file('gambar');
                $namaGambar = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $file->move($destinationPath, $namaGambar);
            }


        DB::table('categories')->where('id', $id)->update([
            'nama_kategori' => $request->nama_kategori,
            'slug' => Str::slug($request->slug),
            'gambar' => $namaGambar,
            'updated_at' => now(),
        ]);

        return redirect()->route('dashboard.kategori.index')->with('success', 'Kategori berhasil diperbarui!');
    }

  
    public function destroy($id) {
        $productCount = DB::table('products')->where('category_id', $id)->count();
        
        if ($productCount > 0) {
            return redirect()->route('dashboard.kategori.index')
                           ->with('error', 'Tidak dapat menghapus kategori yang masih memiliki produk!');
        }
        
        $category = DB::table('categories')->where('id', $id)->first();
        if ($category->gambar && file_exists(public_path('images/categories/' . $category->gambar))) {
            unlink(public_path('images/categories/' . $category->gambar));
        }
        
        DB::table('categories')->where('id', $id)->delete();
        
        return redirect()->route('dashboard.kategori.index')->with('success', 'Kategori berhasil dihapus!');
    }
}