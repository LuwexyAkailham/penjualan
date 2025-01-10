<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Tentukan kolom yang boleh diisi
    protected $fillable = ['name'];
}

