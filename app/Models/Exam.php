<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $fillable = ['filePath', 'class_id'];

    public function Class()
    {
        return $this->belongsTo(UserClass::class);
    }

    public function files()
    {
        return $this->hasMany(DownloadFile::class,'file_id');
    }
}
