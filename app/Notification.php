<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $primaryKey = "id_notification";
    protected $fillable=['parentt_id','dateNotification','etat','detail','result'];
    #region relationship:one to many
    public function parentt(){
       return  $this->belongsTo('App\Parentt');
    }

}
