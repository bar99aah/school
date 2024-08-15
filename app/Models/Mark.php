<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;

    protected $fillable = ['filePath', 'course_id'];

    public function Course()
    {
        return $this->belongsTo(Course::class);
    }

    public function files()
    {
        return $this->hasMany(DownloadFile::class,'file_id');
    }

    public function download()
    {
        return $this->belongsTo(DownloadMark::class);
    }

}
