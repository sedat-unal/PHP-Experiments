<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    //bu modele ait veritabanı tablosunu tanımlıyorum.
    protected $table = 'sliders';

    //değiştirilebilir içerikleri tanımladığım yer.
    protected $fillable = [
        'sliderPictureName',
        'sliderTitle',
        'sliderCategory',
        'sliderTextID',
        'sliderContent',
        'created_at',
        'updated_at'
    ];
}
