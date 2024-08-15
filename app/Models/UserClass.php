<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserClass extends Model
{
    use HasFactory;
    protected $table='classes';
    protected $fillable = ['name'];

    public function Courses()
    {
        return $this->hasMany(Course::class) ;
    }

    public function Users()
    {
        return $this->hasMany(MobileUser::class) ;
    }

    public function Exam()
    {
        return $this->hasOne(Exam::class, 'id', 'class_id');
    }
    public function Plan()
    {
        return $this->hasOne(Plan::class, 'id', 'class_id');
    }
}
