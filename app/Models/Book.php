<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Author;


class Book extends Model
{
    use HasFactory;
    protected $table = 'books';

    protected $fillable = ['title', 'author', 'description', 'category_id', 'image'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function authors()
{
    return $this->belongsToMany(Author::class);
}

public function reviews()
{
    return $this->hasMany(Review::class);
}

public function borrows()
{
    return $this->hasMany(Borrow::class);
}


}
