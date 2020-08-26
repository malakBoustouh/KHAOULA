<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificationtrait extends Model
{

    protected $fillable=['traitant_id','parentt_id','dateNotificationtrait','etat','detail'];
    #region relationship:one to many
    public function traitant(){
       return  $this->belongsTo('App\Traitant');
    }
    public function parentt(){
        return  $this->belongsTo('App\Parentt');
    }

}
