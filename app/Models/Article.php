<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tag() {
        return $this->belongsTo(Tag::class, 'tag_id', 'id');
    }

    public function scopeSearch($q, $request) {
        if($request->has('title') && $request->title) {
            $q->where('title', 'like', '%'.$request->title.'%');
        }
        if($request->has('tag_id') && $request->tag_id) {
            $q->where('tag_id', 'like', '%'.$request->tag_id.'%');
        }
    }

    public static function rules() {
        return [
            'title' => 'required|string|min:3|max:20',
            'tag_id' => 'required|integer|exists:tags,id',
            'image' => 'nullable|image',
            'short_description' => 'nullable|string',
            'full_description' => 'nullable|string'
        ];
    }
}
