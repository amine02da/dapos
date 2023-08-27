<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ["client_id", "total_price", "status"];

    public function Client()
    {
        return $this->belongsTo(Client::class)->withDefault();
    }

    public function Products()
    {
        return $this->belongsToMany(Product::class, "product_order")->withPivot("quantity");
    }
}
