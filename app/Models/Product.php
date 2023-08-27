<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "category_id",
        "name",
        "description",
        "image",
        "purchase_price",
        "purchase_compare_price",
        "sale_price",
        "quantity",
    ];

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault();
    }

    public function Orders()
    {
        return $this->belongsToMany(Order::class, "product_order");
    }

    public static function rules()
    {
        return [
            "category_id" => "required|exists:categories,id",
            "name" => "required",
            "purchase_price" => "required|min:0|numeric",
            "sale_price" => "required|min:0|numeric",
            "quantity" => "required|min:0|numeric",
        ];
    }

    public function getProfitPercentAttribute()
    {
        $profit = $this->sale_price - $this->purchase_price;
        return number_format($profit * 100 / $this->purchase_price, 2);
    }
}
