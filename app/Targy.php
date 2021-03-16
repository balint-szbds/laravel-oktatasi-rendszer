<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Targy extends Model
{
    protected $table = 'targyak';
    // Feltölthető mezők
    protected $fillable = ['nev', 'leiras', 'kod', 'kredit', 'tanarid'];
    public function teacher() {
        return $this->belongsTo(UserModel::class, 'tanarid');
    }
    public function students() {
        return $this->belongsToMany(UserModel::class, 'targy_user_model', 'targy_id', 'user_model_id');
    }
    public function assignments(){
        return $this->hasMany(Feladat::class, 'targyId');
    }
}
