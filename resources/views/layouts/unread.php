<?php


$remarque = \App\Notificationtrait::select('notificationtraits.detail')->join('traitants', 'traitants.id_traitant', '=', 'notificationtraits.traitant_id')->
    where('traitants.user_id',Auth::user()->id)-> where('notificationtraits.etat',1) ->count();

/*$remarque = DB::table('notificationtraits')
    ->where('traitant_id',Auth::user()->name)-> where('etat',1)// if this user is sender
    ->count();*/



echo $remarque
//return array_merge($test1->toArray(), $test2->toArray());
?>
