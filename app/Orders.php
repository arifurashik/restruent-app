<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $guarded = [];

    public function customer_name() {
		return $this->belongsTo(User::class, 'customer_id','id');
    }
}
