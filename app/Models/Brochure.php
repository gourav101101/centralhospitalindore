<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brochure extends Model
{
    protected $fillable = [
        'file_path',
        'original_name',
    ];
}
