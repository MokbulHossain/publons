<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funding extends Model
{
    public function who_can_see()
    {
        return $this->hasOne(Who_can_see::class);
    }
    public function funding_agency()
    {
        return $this->belongsTo(Funding_agency::class);
    }
      public function funding_type_infos()
    {
        return $this->hasMany(Funding_type_info::class);
    }
     public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
