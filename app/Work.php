<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
      public function language()
    {
        return $this->belongsTo(Language::class);
    }
     public function publication_country()
    {
        return $this->belongsTo(Country::class);
    }
     public function work_category()
    {
        return $this->belongsTo(Work_category::class);
    }
     public function citation_type()
    {
        return $this->belongsTo(Citation_type::class);
    }
    public function work_identifiers()
    {
        return $this->hasMany(Work_identifier::class);
    }
}
