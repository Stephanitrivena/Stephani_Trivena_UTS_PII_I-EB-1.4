<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class history_friends extends Model
{
    use HasFactory;
    protected $guarded = ['nama'];

    // membuat relasi antar table 
    public function history_groups()
    {
        return $this->belongsTo(history_groups::class,'groups_id');
    }
}
