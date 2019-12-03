<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'package_name', 'items', 'packages', 'price', 'description', 'package_image',
    ];
}
