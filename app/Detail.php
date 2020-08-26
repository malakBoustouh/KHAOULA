<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $table="detail";
    protected $fillable = ['diagnostic_id', 'questions', 'reponses','numResponses', 'observations'];

    public function diagnostic()
    {
        return $this->belongsTo('App\Diagnostic');

    }
}
