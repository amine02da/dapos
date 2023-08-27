<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ["name", "phone", "address"];

    public static function rules()
    {
        return [
            "name" => "required",
            "phone" => "required|min:10|max:10",
        ];
    }

    public function Orders()
    {
        return $this->hasMany(Order::class);
    }
}
