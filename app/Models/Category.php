<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ["name", "status"];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
    public static function rules()
    {
        return [
            "name" => "required",
        ];
    }

    public function scopeActive(Builder $builder)
    {
        $builder->where("status", "=", "active"); 
    }
}
