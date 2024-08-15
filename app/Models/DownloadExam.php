<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownloadExam extends Model
{
    use HasFactory;
    protected $table = 'downloads_exams';
    protected $fillable = ['mobile_user_id','exam_id'];
    public function User()
    {
        return $this->belongsTo(MobileUser::class);
    }
}
