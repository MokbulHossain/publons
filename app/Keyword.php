<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
	public $timestamps = false;
    public function who_can_see()
    {
        return $this->hasOne(Who_can_see::class);
    }
}
