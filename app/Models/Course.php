<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'class_id','teacher_name'];

    public function Class()
    {
        return $this->belongsTo(UserClass::class);
    }
}
