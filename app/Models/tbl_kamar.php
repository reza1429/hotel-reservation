<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_kamar extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function history_trans(){
        return $this->hasOne(history_trans::class);
    }

    public function reservasi(){
        return $this->hasOne(reservasi::class);
    }

    public function tipe(){
        return $this->belongsTo(tipe_kamar::class);
    }
}
