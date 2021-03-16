<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feladat extends Model
{
    protected $table = 'feladatok';
    // Feltölthető mezők
    protected $fillable = ['nev', 'leiras', 'pont', 'hatarido_tol', 'hatarido_ig', 'beadott', 'ertekelt'];
    public function in_targy() {
        return $this->belongsTo(Targy::class, 'targyid');
    }
    public function solutions(){
        return $this->hasMany(Megoldas::class, 'feladatid');
    }
}
