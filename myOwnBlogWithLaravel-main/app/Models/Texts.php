<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Texts extends Model
{
    use HasFactory;

    //the table name belongs to model
    protected $table = 'texts';

    protected $fillable = [
        'textAuthor',
        'textCategory',
        'textTitle',
        'text',
        'textPicture',
        'textHowManySeen',
        'created_at',
        'updated_at',
    ];
}
