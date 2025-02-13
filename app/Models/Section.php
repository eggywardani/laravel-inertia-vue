<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'class_id'];

    public function classroom() {
        return $this->belongsTo(Classroom::class);
    }

    public function students() {
        return $this->hasMany(Student::class);
    }

}
