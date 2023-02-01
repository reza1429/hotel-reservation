<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reservasi extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tbl_kamar(){
        return $this->belongsTo(tbl_kamar::class);
    }

    public function pembayaran(){
        return $this->hasOne(pembayaran::class);
    }

    public function pengunjung(){
        return $this->belongsTo(pengunjung::class);
    }

    public function history_trans(){
        return $this->hasOne(history_trans::class);
    }
}
