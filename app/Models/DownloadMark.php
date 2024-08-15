<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownloadMark extends Model
{
    use HasFactory;
    protected $table = 'downloads_marks';
    protected $fillable = ['mobile_user_id','mark_id'];
    public function User()
    {
        return $this->belongsTo(MobileUser::class);
    }

    public function Mark()
    {
        return $this->belongsTo(Mark::class);
    }

}
