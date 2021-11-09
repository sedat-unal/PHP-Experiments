<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class socialMedia extends Model
{
    use HasFactory;

    protected $table = 'socialMedia';

    protected $fillable = [
        'socialMediaIcon',
        'socialMediaLink',
        'status',
    ];
}
