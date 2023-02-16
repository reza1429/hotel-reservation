<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipe_kamar extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tbl_kamar(){
        return $this->hasMany(tbl_kamar::class);
    }
}
