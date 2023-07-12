<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_attr extends Model
{
    use HasFactory;
    protected $table = 'test';
    protected $fillable = ['product_id','sku','mrp','qty'];
}
