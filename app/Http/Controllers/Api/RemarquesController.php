<?php

namespace App\Http\Controllers\Api;
use App\Enfant;
use App\Notificationtrait;
use App\Parentt;
use App\Remarque;
use App\Traitant;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class RemarquesController extends Controller
{
    public function create(Request $request){
        $remarque = new Remarque();
        $notification = new Notificationtrait();
        //recherche enfant
        $parentts =Parentt::where('user_id',Auth::user()->id)->first();
        $idparent=$parentts->id_parentt;
        $idenfant=$parentts->enfant_id;

        $enfantNom =Enfant::where('id_enfant',$idenfant)->first();
        $enfantNom=$enfantNom->nom;

        $remarque->parentt_id = $idparent;
        $remarque->dateRemarque = $request->date;
        $remarque->detail = $request->detail;
        //recherche traitant
        $traitantid = User::where('name', 'LIKE', '%' . $request->name . '%')->first();
        $traitantid=$traitantid->id;
        $traitantid =Traitant::where('user_id',$traitantid)->first();
        $traitantid=$traitantid->id_traitant;

        $notification->traitant_id=$traitantid;
        $notification->parentt_id= $idparent;
            $notification->dateNotificationtrait= $request->date;
            $notification->etat=1;

        $names[0] = 'ارسل والد';
        $names[1] = $enfantNom;
        $names[2] = 'ملاحظة';

        $notification->detail=implode(" ", $names);

        $remarque->save();
        $notification->save();
        return response()->json([
            'success' => true,
            'remarque'=>$remarque,
            'message' => 'العملية تتمت بنجاح'
        ]);
    }


}
