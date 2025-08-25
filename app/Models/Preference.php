<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    protected $fillable = ['user_id', 'key', 'value'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
