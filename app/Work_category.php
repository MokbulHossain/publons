<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work_category extends Model
{
    public function work_types()
    {
        return $this->hasMany(Work_type::class);
    }
}
