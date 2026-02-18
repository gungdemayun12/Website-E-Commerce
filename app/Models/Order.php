<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['product_id', 'nama_pemesan', 'no_hp', 'alamat', 'ukuran', 'jumlah', 'catatan', 'metode_pembayaran'];
}