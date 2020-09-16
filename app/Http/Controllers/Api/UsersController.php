<?php

namespace App\Http\Controllers\Api;
use App\Exercice;
use App\Parentt;
use app\Pratique;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller{
    public function update(Request $request){
       // $parentUser =User::find($request->id);
       // $parent =Parentt::find($parentUser->id);
        $parent =Parentt::find($request->id);
        //$parent =Parentt::find($request->id);
      //  $id_user=$parent->user_id;
        //$user =User::find(Auth::user()->id);

        //check if user is editing his own comment
        if($parent->user_id != Auth::user()->id){
            return response()->json([
                'success' => false,
                'message' => 'unauthorize access'
            ]);
        }
        $parent->nomp = $request->nom;
        $parent->prenomp = $request->prenom;
        $parent->motpass = $request->pass;
        $parent->email = $request->email;

       /* if($request->img != ''){
            //choose a unique name for photo
            $img = time().'.jpg';
            file_put_contents('storage/familles/'.$img,base64_decode($request->img));
            $parent->img = $img;
        }*/

      if(isset($request->img) ){
            $ext =  $request->img->getClientOriginalExtension();
            $file = date('YmdHis').rand(1,99999).'.'.$ext;
            $request->img->storeAs('public/familles',base64_decode($file));
        }
        else
        {
            if(!$parent->img)
                $file = '';
            else
                $file = $parent->img;
        }
        $parent->img=$file;

        $parent->update();

        $names[0] = $request->nom;
        $names[1] =$request->prenom;

        Auth::user()->name= implode(" ", $names);
        Auth::user()->image=$file;
        Auth::user()->password=Hash::make($request->pass);  Auth::user()->email=$request->email;
        Auth::user()->update();


        return response()->json([
            'success' => true,
            'message' => 'profile edited'
        ]);
    }

    public function parents(){
        $parentts =Parentt::where('user_id',Auth::user()->id)->first();
        $user = Auth::user();
        //show user of each comment
        return response()->json([
            'success' => true,
            'parents' => $parentts,
            'user' => $user
        ]);
    }
}
