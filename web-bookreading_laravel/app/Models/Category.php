<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';
    protected $fillable = [
        'category_name',
        'category_slug',
        'category_description',
        'category_image',
        'category_status',
        'created_by',
    ];

    protected $guarded = [];

    public function book(): BelongsToMany
    {
        return $this->belongsToMany(Book::class,'book_category');
    }
}
