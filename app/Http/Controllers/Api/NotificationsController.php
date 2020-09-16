<?php

namespace App\Http\Controllers\Api;
use App\Enfant;
use App\Exercice;
use App\Notification;
use App\Parentt;
use App\Seancetraitement;
use App\User;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class NotificationsController extends Controller{



    public function show(){

            $parent = Parentt::where('user_id',Auth::user()->id)->first();
            $parent=$parent->id_parentt;
            $notes = Notification::where('parentt_id',$parent)->first();
            $note_id=$notes->id_notification;

        $updateNoti = DB::table('notifications')
            ->where('notifications.id_notification', $note_id)
            ->update(['etat' => 0]);
            return response()->json([
                'success' => true,
                'nots' => $notes,
            ]);
    }
}
