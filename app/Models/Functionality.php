<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Functionality extends Model
{
    use HasFactory;

    protected $table = 'functionalities';

    protected $fillable = ['name', 'des_link'];

    public function permissions(){
        return $this->hasMany(Permission::class);
    }
}
