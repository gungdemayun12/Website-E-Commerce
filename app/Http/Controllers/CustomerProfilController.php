<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomerProfilController extends Controller
{
public function index()
{
    $customer = Auth::guard('customer')->user();


    $notifications = DB::table('notifications')
        ->where('customer_id', $customer->id)
        ->orderBy('created_at', 'desc')
        ->get();


    $totalBelanja = DB::table('orders')
        ->join('order_items', 'orders.id', '=', 'order_items.order_id')
        ->where('orders.customer_id', $customer->id)
        ->where('orders.status', 'selesai')
        ->sum('order_items.subtotal');

    $balance = $totalBelanja ?? 0;

 
    $orders = DB::table('orders')
        ->where('customer_id', $customer->id)
        ->where('status', 'selesai')
        ->orderByDesc('created_at')
        ->get();

    $groupedOrders = $orders->map(function($order) {

        $items = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->select(
                'order_items.*',
                'products.nama_produk',
                'products.gambar',
                DB::raw('order_items.qty * order_items.harga as total_harga')
            )
            ->where('order_items.order_id', $order->id)
            ->get();

        $order->items = $items;
        $order->total_items = $items->sum('qty');
        $order->grand_total = $items->sum('total_harga');

        return $order;
    });

    return view('customer.profile.index', compact(
        'customer',
        'notifications',
        'balance',
        'groupedOrders'
    ));
}
    
    public function edit()
    {
      
        $customer = DB::table('customers')
            ->where('id', Auth::guard('customer')->id())
            ->first();

        return view('customer.profile.edit', compact('customer'));
    }

    public function memberUpdate(Request $request, $id)
    {
        if (Auth::guard('customer')->id() != $id) {
            return back()->with('error', 'Akses ditolak.');
        }

        $request->validate([
            'username' => 'required|string|max:100',
            'email'    => 'required|email|unique:customers,email,' . $id, 
            'no_hp'    => 'nullable|string|max:20',
            'alamat'   => 'nullable|string|max:255',
            'password' => 'nullable|min:6|confirmed',
            'foto'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $customer = DB::table('customers')->where('id', $id)->first();

        $data = [
            'username'   => $request->username,
            'email'      => $request->email,
            'no_hp'      => $request->no_hp,
            'alamat'     => $request->alamat,
            'updated_at' => now(),
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

       
       if ($request->hasFile('foto')) {

   
    if ($customer->foto && file_exists(public_path('images/customers/' . $customer->foto))) {
        unlink(public_path('images/customers/' . $customer->foto));
    }

  
    if (!file_exists(public_path('images/customers'))) {
        mkdir(public_path('images/customers'), 0755, true);
            }
        
           
            $fotoName = 'customer_' . $id . '_' . time() . '.' . $request->file('foto')->extension();
            $request->file('foto')->move(public_path('images/customers'), $fotoName);
        
            $data['foto'] = $fotoName;
        }


        DB::table('customers')->where('id', $id)->update($data);

        
        DB::table('notifications')->insert([
            'customer_id' => $id,
            'text'        => 'Informasi profil Anda telah berhasil diperbarui.',
            'created_at'  => now(),
        ]);

        return redirect()
            ->route('customer.profile')
            ->with('success', 'Profil berhasil diperbarui!');
    }
}