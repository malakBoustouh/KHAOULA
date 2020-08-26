<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Diagnostic extends Model
{
    protected $fillable = [
        'enfant_id',
        'carsspecialiste_id',
        'dateDiagnostic',
        'niveau',
        'remarque',
        'methode',
        'id_superviseur'
    ];

    public function enfant(){
        return  $this->belongsTo('App\Enfant');
    }
    #region relationship:many to many
    public function carsspecialiste(){
        return  $this->belongsTo('App\Carsspecialiste');
    }
    public function detail(){
        return $this->hasMany('App\Detail');

    }
}
