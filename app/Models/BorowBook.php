<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorowBook extends Model
{
    use HasFactory;
    protected $table = 'borow_book';
    protected $fillable = [
        'user_id',
        'book_id',
        'date_borow',
        'date_return',
        'status',
    ];
}
