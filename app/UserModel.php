<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = 'users';
    // Feltölthető mezők
    protected $fillable = ['name', 'email', 'foglalkozas'];
    public function list() {
        return $this->hasMany(User::class);
    }
    public function teacher_on(){
        return $this->hasMany(Targy::class, 'tanarid');
    }
    public function studies_in(){
        return $this->belongsToMany(Targy::class, 'targy_user_model', 'user_model_id', 'targy_id');
    }
}
