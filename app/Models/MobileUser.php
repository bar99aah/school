<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class MobileUser extends Model
{
    use HasFactory, HasApiTokens;
    protected $table='mobile_user';
    protected $fillable = ['f_name','m_name','l_name','phone_number','password','class_id','stu_id'];

    public function Class()
    {
        return $this->belongsTo(UserClass::class);
    }

    public function files()
    {
        return $this->hasMany(DownloadFile::class) ;
    }
    public function marks()
    {
        return $this->hasMany(DownloadMark::class) ;
    }
    public function exams()
    {
        return $this->hasMany(DownloadExam::class) ;
    }
}
