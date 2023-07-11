<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'book_id',
        'comment',
        'rating',
    ];

    /**
     * Get the user who made the review.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the book being reviewed.
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
