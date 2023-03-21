<?php

namespace App\Models;

use App\Models\genre;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'collection',
        'isbn',
        'published_date',
        'number_of_pages',
        'placement',
        'status',
        'content',
        'genre_id',
    ];


    public function genre()
    {
        return $this->belongsTo(genre::class);
    }
}
