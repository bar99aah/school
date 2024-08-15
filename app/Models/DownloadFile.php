<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownloadFile extends Model
{
    use HasFactory;
    protected $table = 'downloads_plans';
    protected $fillable = ['mobile_user_id','plan_id'];
    public function User()
    {
        return $this->belongsTo(MobileUser::class);
    }
}
