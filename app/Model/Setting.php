<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'id',
        'siteNameArabic',
        'siteNameEnglish',
        'logo',
        'icon',
        'email',
        'arabicDescription',
        'englishDescription',
        'keywords',
        'address',
        'contact',
        'openTime',
        'closeTime',
        'facebook',
        'youtube',
        'messageMaintenance'
    ];
}
