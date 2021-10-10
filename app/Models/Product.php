<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }


    public static function rules() {
        return [
           'name' => 'required|string|min:3|max:255',
           'category_id' => 'required|integer|exists:categories,id',
           'description' => 'nullable|string',
           'image' => 'nullable|image',
           'price' => 'nullable|number|min:0',
           'sale_price' => 'nullable|number|min:0',
           'quantitiy' => 'nullable|int|min:0',
           'sku' => 'nullable|number|min:0',
           'weight' => 'nullable|number|min:0',
           'width' => 'nullable|number|min:0',
           'height' => 'nullable|number|min:0',
           'length' => 'nullable|number|min:0',
           'status' => 'in:Active, Draft'
       ];
   }
}
