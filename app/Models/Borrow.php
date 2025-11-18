<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    protected $fillable = ["book_id", "user_id", "qty", "start_borrow", "end_borrow", "fine"];

    /**
     * Borrow belongs to a Book
     */
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    /**
     * Borrow belongs to a User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
