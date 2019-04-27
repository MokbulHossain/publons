<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    public function who_can_see()
    {
        return $this->hasOne(Who_can_see::class);
    }
}
