<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    use HasFactory;
    protected $table= "transaksi_details";
    protected $fillable = ['transaksi_id','product_id','title','image','price','qty','kode_cart'];
}
