<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserToken extends Model
{
    use HasFactory;
    protected $fillable = ['mobile_user_id','api_token'];

    public function User()
    {
        return $this->belongsTo(MobileUser::class) ;
    }
}
