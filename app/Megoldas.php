<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Megoldas extends Model
{
    protected $table = 'megoldasok';
    protected $fillable = ['hallgato_megjegyzes', 'tanar_megjegyzes', 'path', 'ertekeles'];
    public function diak() {
        return $this->belongsTo(User::class, 'diakid');
    }
    public function targy() {
        return $this->belongsTo(Targy::class);
    }
}
