<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use App\Models\Project;

class Type extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function projects(){
        return $this->hasMany(Project::class);
    }

    public static function generateSlug($name){
        return Str::slug($name, '-');
    }
}
