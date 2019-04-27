<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bio_info extends Model
{
    public function who_can_see()
    {
        return $this->hasOne(Who_can_see::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
     public function user()
    {
        return $this->belongsTo(User::class);
    }
}
