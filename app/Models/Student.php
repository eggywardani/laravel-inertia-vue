<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'classroom_id', 'section_id'];

    protected $with = ['classroom', 'section'];

    public function classroom() {
        return $this->belongsTo(Classroom::class);
    }

    public function section() {
        return $this->belongsTo(Section::class);
    }




}
