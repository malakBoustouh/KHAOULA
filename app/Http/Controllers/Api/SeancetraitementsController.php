<?php

namespace App\Http\Controllers\Api;
use App\Enfant;
use App\Exercice;
use App\Parentt;
use app\Pratique;
use App\Seancetraitement;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class SeancetraitementsController extends Controller{


    public function seancetraitements(){

        $parentts =Parentt::where('user_id',Auth::user()->id)->first();
        $enf=$parentts->enfant_id;
        $seances =Seancetraitement::where('enfant_id',$enf)->get();
        foreach($seances as $seance){
            $seance->dateTraite;
            $seance->commentaire;
            $seance->conseils;
        }

        return response()->json([
            'success' => true,
            'seance' => $seances
        ]);
    }
}
