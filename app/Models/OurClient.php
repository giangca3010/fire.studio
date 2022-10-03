<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurClient extends Model
{
    protected $fillable = [
        'short_title_en',
        'short_title_vi',
        'title_en',
        'title_vi',
        'client_info',
    ];
}
