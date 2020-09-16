<?php

namespace App\Http\Controllers\Api;
use App\Exercice;
use App\Parentt;
use App\Pratique;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class PratiquesController extends Controller{
    public function create(Request $request){

        $enfant = Parentt::where('user_id',Auth::user()->id)->first();
        $idenfant=$enfant->enfant_id;

        $exerice = Exercice::where('titre',$request->titre)->first();
        $exericeId=$exerice->id_exercice;
        $pratique = new Pratique();

        $pratique ->enfant_id = $idenfant;
        $pratique ->exercice_id = $exericeId;
        $pratique ->datePratique = $request->datePratique;
        $pratique ->niveau = $request->niveau;
        $pratique ->score = $request->score;
        $pratique ->save();
        //$pratique ->user;
        return response()->json([
            'success' => true,
            'message' => 'تم',
            ' $pratique ' =>  $pratique
        ]);
    }


   /* public function posts(){
        $posts = Post::orderBy('id','desc')->get();
        foreach($posts as $post){
            //get user of post
            $post->user;
            //comments count
            $post['commentsCount'] = count($post->comments);
            //likes count
            $post['likesCount'] = count($post->likes);
            //check if users liked his own post
            $post['selfLike'] = false;
            foreach($post->likes as $like){
                if($like->user_id == Auth::user()->id){
                    $post['selfLike'] = true;
                }
            }

        }

        return response()->json([
            'success' => true,
            'posts' => $posts
        ]);
    }



    public function myPosts(){
        $posts = Post::where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        $user = Auth::user();
        return response()->json([
            'success' => true,
            'posts' => $posts,
            'user' => $user
        ]);
    }*/

}
