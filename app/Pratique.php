<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pratique extends Model
{
    protected $fillable=['enfant_id','exercice_id','datePratique','niveau','score'];
    public function enfant(){
        return  $this->belongsTo('App\Enfant');
    }
    #region relationship:many to many
    public function exercice(){
        return  $this->belongsTo('App\Exercice');
    }
}
