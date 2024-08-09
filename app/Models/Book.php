<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category_id',
        'author',
        'publisher',
        'year',
        'description',
        'quantity',
        'file_path',
        'cover_image',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
