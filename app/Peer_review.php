<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peer_review extends Model
{
    public function journal_conference()
    {
        return $this->belongsTo(Journal_conference::class);
    }
    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

}
