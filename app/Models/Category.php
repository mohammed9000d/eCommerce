<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function products() {
        return $this->hasMany(Product::class, 'category', 'id');
    }

    public static function rules() {
        return [
            'name' => 'required|string|max:100|min:3',
            'description' => 'nullable|string|min:5',
            'image' => 'nullable|image'
        ];
    }
}
