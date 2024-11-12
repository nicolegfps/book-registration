<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'author',
        'genre',
        'publication_date',
    ];

    // Cast the publication_date to a Carbon date instance
    protected $casts = [
        'publication_date' => 'date',
    ];
}
