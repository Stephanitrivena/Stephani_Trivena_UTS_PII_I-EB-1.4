<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class history_groups extends Model
{
    use HasFactory;
    protected $guarded = ['name'];

    // membuat relasi antar table 
    public function history_friends()
    {
        return $this->hasMany('App\Models\history_friends');
    }
}
