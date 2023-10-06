<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;

    protected $table = 'book';
    protected $fillable = [
        'category_id',
        'book_name',
        'book_slug',
        'book_summary',
        'book_image',
        'book_status',
        'created_by',
    ];

    // protected $guarded = [];

    public function category(): BelongsToMany
    {
        return $this->belongsToMany(Category::class,'book_category');
    }
}
