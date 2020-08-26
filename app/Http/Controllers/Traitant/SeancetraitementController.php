<?php

namespace App\Http\Controllers\Traitant;

use App\Carsspecialiste;
use App\Detail;
use App\Diagnostic;
use App\Enfant;
use App\Parentt;
use App\Pratique;
use App\Remarque;
use App\Specialiste;
use App\Traitant;
use App\Seancetraitement;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Session;
use Charts;
use DB;


class SeancetraitementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $seancetraitement = Seancetraitement::select('enfant_id')->join('enfants', 'enfants.id_enfant', '=', 'seancetraitements.enfant_id')->GROUPBY('enfant_id')->get();
        $arr['seancetraitements']=Seancetraitement::all();
        $arr['enfants']=Enfant::paginate(5);
        return view('pagetraitant.seancetraitements.index')->with($arr) ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $arr['enfants']=Enfant::all();
        $arr['traitants']=Traitant::all();
        $arr['seancetraitements']=Seancetraitement::all();
        $dateActuelle=Carbon::now()->toDateString();
        return view('pagetraitant.seancetraitements.create',compact('dateActuelle'))->with($arr);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request ,Seancetraitement $seancetraitement)
    {
       $this->validate($request,
            array(
                'enfant_id'=>'required',
                'enf_id'=>'required',
                'duree'=>'required'
                )
        );

       // dd($request->all());
        $nomid=$request->enf_id;
        $prenomid=$request->enfant_id;
        if($nomid==$prenomid){
        $seancetraitement->enfant_id= $prenomid;
            //$nomTraitant = explode(' ',  Auth::user()->name, 2); // Restricts it to only 2 values, for names like Billy Bob Jones
           // $last_name = $nomTraitant[0];
           // $first_name = !empty($nomTraitant[1]) ? $nomTraitant[1] : '';
            $nomTraitant= Auth::user()->name;
            $nomSpecialiste = User::where('name', 'LIKE', '%'.$nomTraitant.'%') ->first();

            $iduser= $nomSpecialiste->id;
            $traitant = Traitant::join('users', 'users.id', '=', 'traitants.user_id')->where('traitants.user_id',$iduser)->first();
            $idTrait= $traitant->id_traitant;

            $seancetraitement->traitant_id= $idTrait;
            $seancetraitement->dateTraite=$request->dateTraite;
            $seancetraitement->methode=$request->methode;
            if($request->commentaire==""){
                $seancetraitement->commentaire="لاتوجد";

            }else  {
                $seancetraitement->commentaire=$request->commentaire;
           }
            if($request->conseils==""){
                $seancetraitement->conseils="لاتوجد";

            }else  {
                $seancetraitement->conseils=$request->conseils;
            }

            $seancetraitement->duree=$request->duree;
            $seancetraitement->note=$request->note;
            if($request->description==""){
                $seancetraitement->description="لايوجد";

            }else  {
                $seancetraitement->description=$request->description;
            }

            $seancetraitement->save();
            return redirect()->route('pagetraitant.show2',$seancetraitement->enfant_id)->with('success','تمت عملية الاضافة بنجاح ');

        }
        else{
            return redirect()->route('pagetraitant.seancetraitements.create')->with('success','خطأ في تحديد الاسم او اللقب ');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        /**************************************************/
        /* $enfant=enfant::find($id);
        // dd($enfant);
         $idf=  $enfant->enfant_id;
         $seancetraitement=Seancetraitement::find($idf);*/
        $seance= seancetraitement::find($id);

        $idt= $seance->traitant_id;

       // $traitant=Traitant::find(  $idt);
        $seancetraitement= seancetraitement::find($id);

        $idf= $seancetraitement->enfant_id;

        $enfant=Enfant::find(  $idf);
        $traitant = Traitant::where('id_traitant',$idt)->first();
        //dd( $traitant);
        $arr['traitants']=Traitant::all();


        return view('pagetraitant.seancetraitements.show', compact('seancetraitement'),compact('enfant'),compact('traitant'))->with($arr);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Seancetraitement $seancetraitement)
    {
        $arr['seancetraitement']=$seancetraitement;
        $arr['enfant']=$seancetraitement->enfant_id ;
        $enfant = enfant::find($arr['enfant']);
        $id_enfant=$enfant->id_enfant;
        $arr['enfant']= $enfant;
        $enfant = Enfant::where('id_enfant',$id_enfant)->first();
        $calculeAge=Carbon::parse($enfant->dateNaissance);
        $age=$calculeAge->age;
        $parentt = Parentt::join('enfants', 'enfants.id_enfant', '=', 'parentts.enfant_id')->where('parentts.enfant_id',$id_enfant)->first();

        return view('pagetraitant.seancetraitements.edit')->with(compact('enfant','parentt','seancetraitement','age'))->with($arr);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seancetraitement $seancetraitement)
    {
        $nomid=$request->enf_id;
        $prenomid=$request->enfant_id;

            $seancetraitement->enfant_id= $prenomid;
            $seancetraitement->traitant_id=1;
            $seancetraitement->dateTraite=$request->dateTraite;
            $seancetraitement->methode=$request->methode;
            $seancetraitement->commentaire=$request->commentaire;
            $seancetraitement->conseils=$request->conseils;
            $seancetraitement->duree=$request->duree;
            $seancetraitement->note=$request->note;
            $seancetraitement->description=$request->description;
        $seancetraitement->save();
        return redirect()->route('pagetraitant.show2',$seancetraitement->enfant_id)->with('success','تمت عملية التعديل بنجاح ');
    }


    public function traite($id){

        $enfant= enfant::find($id);

        //dd($id);
        $arr['traitants']=Traitant::all();
        $arr['seancetraitements']=Seancetraitement::all();
        $arr['enfants']=Enfant::all();

        return view('pagetraitant.seancetraitements.traite', compact('seancetraitement'),compact('enfant'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */



    public function show2($id_enfant){
        $arr['enfants']=Enfant::all();
        $arr['diagnostics']=Diagnostic::all();
        $arr['seancetraitements']=Seancetraitement::all();
        $enfant = Enfant::where('id_enfant',$id_enfant)->first();
        $calculeAge=Carbon::parse($enfant->dateNaissance);
        $age=$calculeAge->age;
        $dateActuelle=Carbon::now()->toDateString();
        $seancetraitement = Seancetraitement::join('enfants', 'enfants.id_enfant', '=', 'seancetraitements.enfant_id')->where('seancetraitements.enfant_id',$id_enfant)->first();
        $diagnostic = Diagnostic::join('enfants', 'enfants.id_enfant', '=', 'diagnostics.enfant_id')->where('diagnostics.enfant_id',$id_enfant)->first();
        $parentt= Parentt::join('enfants', 'enfants.id_enfant', '=', 'parentts.enfant_id')->where('parentts.enfant_id',$id_enfant)->first();
        $firs=$parentt->id_parentt;
        $remarque= Remarque::join('parentts', 'parentts.id_parentt', '=', 'remarques.parentt_id')->where('parentts.id_parentt',$firs)->first();
        $parent = Parentt::join('enfants', 'enfants.id_enfant', '=', 'parentts.enfant_id')->where('parentts.id_parentt',$firs+1)->first();
        $arr['traitants']=Traitant::all();
        $arr['remarques']=Remarque::all();
        $arr['carsspecialistes']=Carsspecialiste::all();
        $arr['parentts']=Parentt::all();
        //********************************************************chart
        //chart  month
        $data = DB::table('seancetraitements')
            ->select(
                DB::raw('note as sums'),

                DB::raw('Month(created_at)as month' ))
            ->where('enfant_id','=',$id_enfant)

            ->get();
        //$k= date("F", mktime(0, 0, 0, date, 1));
        $array[] = ['', 'تقييم'];
        foreach($data as $key => $value)
        {

            $array[++$key] = [(string)$value->month,(int) $value->sums];
        }

//DATE_FORMAT(created_at,'%M')as date

        //chart janfier
        $datadatejanvier = DB::table('seancetraitements')
            ->select(
                DB::raw('note as sums'),

                DB::raw("DATE_FORMAT(created_at,'%D')as datejanvier"))
            ->where('enfant_id','=',$id_enfant)
            ->where( DB::raw('Month(created_at)' ),'=','1' )

            ->get();
        //$k= date("F", mktime(0, 0, 0, date, 1));
        $arraydatejanvier[] = ['شهر جانفي', 'تقييم'];
        foreach($datadatejanvier as $key => $value)
        {

            $arraydatejanvier[++$key] = [(string)$value->datejanvier,(int) $value->sums];
        }


        return view('pagetraitant.seancetraitements.show2')->with(compact('enfant','remarque','parent','parentt','seancetraitement','diagnostic','specialiste','age','dateActuelle'))->with($arr)->with('month', json_encode($array))->with('datejanvier', json_encode($arraydatejanvier));
    }


    public function affiche($idF)
    {
        $diagnostic = Diagnostic::where('id', $idF)->first();
        $enfant = Enfant::join('diagnostics', 'diagnostics.enfant_id', '=', 'enfants.id_enfant')->where('diagnostics.id', $idF)->first();
        $id_enfant = $enfant->id_enfant;
        $enfant = $enfant::find($id_enfant);
        $carsspecialiste = Carsspecialiste::join('diagnostics', 'diagnostics.carsspecialiste_id', '=', 'carsspecialistes.id_carsspecialiste')->where('diagnostics.id', $idF)->first();
        $id_carsspecialiste = $carsspecialiste->id_carsspecialiste;
        $carsspecialiste = carsspecialiste::find($id_carsspecialiste);
        $arr['carsspecialistes'] = Carsspecialiste::all();
        $detail = Detail::join('diagnostics', 'diagnostics.id', '=', 'detail.diagnostic_id')->where('diagnostics.id', $idF)->get();
        //responses and reponse
        $detail0 = $detail->get(0);$question= $detail0->questions;$reponse0= $detail0->reponses;$observ0= $detail0->observations;
        $detail1 = $detail->get(1);$question1= $detail1->questions;$reponse1= $detail1->reponses;$observ1= $detail1->observations;
        $detail2 = $detail->get(2);$question2= $detail2->questions;$reponse2= $detail2->reponses;$observ2= $detail2->observations;
        $detail3 = $detail->get(3);$question3= $detail3->questions;$reponse3= $detail3->reponses;$observ3= $detail3->observations;
        $detail4 = $detail->get(4);$question4= $detail4->questions;$reponse4= $detail4->reponses;$observ4= $detail4->observations;
        $detail5 = $detail->get(5);$question5= $detail5->questions;$reponse5= $detail5->reponses;$observ5= $detail5->observations;
        $detail6 = $detail->get(6);$question6= $detail6->questions;$reponse6= $detail6->reponses;$observ6= $detail6->observations;
        $detail7 = $detail->get(7);$question7= $detail7->questions;$reponse7= $detail7->reponses;$observ7= $detail7->observations;
        $detail8 = $detail->get(8);$question8= $detail8->questions;$reponse8= $detail8->reponses;$observ8= $detail8->observations;
        $detail9 = $detail->get(9);$question9 =$detail9->questions;$reponse9= $detail9->reponses;$observ9= $detail9->observations;
        $detail10 = $detail->get(10);$question10= $detail10->questions;$reponse10= $detail10->reponses;$observ10= $detail10->observations;
        $detail11 = $detail->get(11);$question11= $detail11->questions;$reponse11= $detail11->reponses;$observ11= $detail11->observations;
        $detail12 = $detail->get(12);$question12= $detail12->questions;$reponse12= $detail12->reponses;$observ12= $detail12->observations;
        $detail13 = $detail->get(13);$question13= $detail13->questions;$reponse13= $detail13->reponses;$observ13= $detail13->observations;
        $detail14 = $detail->get(14);$question14= $detail14->questions;$reponse14= $detail14->reponses;$observ14= $detail14->observations;
        $arr['detail'] = Detail::all();
        $parentt = Parentt::join('enfants', 'enfants.id_enfant', '=', 'parentts.enfant_id')->where('parentts.enfant_id', $id_enfant)->first();
        $firs = $parentt->id_parentt;
        $parent = Parentt::join('enfants', 'enfants.id_enfant', '=', 'parentts.enfant_id')->where('parentts.id_parentt', $firs + 1)->first();
        $calculeAge = Carbon::parse($enfant->dateNaissance);
        $age = $calculeAge->age;
        return view('pagetraitant.seancetraitements.affiche')->with(compact('diagnostic','parent', 'age', 'parentt', 'carsspecialiste', 'enfant','id',
            'question','question1','question2','question3','question4','question5','question6','question7','question8','question9','question10','question11','question12','question13','question14',
            'reponse0','reponse1','reponse2','reponse3','reponse4','reponse5','reponse6','reponse7','reponse8','reponse9','reponse10','reponse11','reponse12','reponse13','reponse14',
            'observ0','observ1','observ2','observ3','observ4','observ5','observ6','observ7','observ8','observ9','observ10','observ11','observ12','observ13','observ14'))->with($arr);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     ************************************************************************/
    public function chart($enf)
    {
        $enfant = Enfant::where('id_enfant',$enf)->first();
        //chart  month

        $data = DB::table('seancetraitements')
            ->select(
                DB::raw('MAX(note) as sums'),

                DB::raw('Month(created_at)as month' ))
            ->where('enfant_id','=',$enf)
            ->groupby(DB::raw('Month(created_at)' ))
            ->get();
        //$k= date("F", mktime(0, 0, 0, date, 1));
        $array[] = ['', 'تقييم'];
        foreach($data as $key => $value)
        {

            $array[++$key] = [(string)$value->month,(int) $value->sums];
        }

//DATE_FORMAT(created_at,'%M')as date

        //chart janfier
        $datadatejanvier = DB::table('seancetraitements')
            ->select(
                DB::raw('note as sums'),

                DB::raw("DATE_FORMAT(created_at,'%D')as datejanvier"))
            ->where('enfant_id','=',$enf)
            ->where( DB::raw('Month(created_at)' ),'=','1' )

            ->get();
        //$k= date("F", mktime(0, 0, 0, date, 1));
        $arraydatejanvier[] = ['شهر جانفي', 'تقييم'];
        foreach($datadatejanvier as $key => $value)
        {

            $arraydatejanvier[++$key] = [(string)$value->datejanvier,(int) $value->sums];
        }
        //chart fivrier
        $datadatefivrier = DB::table('seancetraitements')
            ->select(
                DB::raw('note as sums'),

                DB::raw("DATE_FORMAT(created_at,'%D')as datefivrier"))
            ->where('enfant_id','=',$enf)
            ->where( DB::raw('Month(created_at)' ),'=','2' )

            ->get();
        //$k= date("F", mktime(0, 0, 0, date, 1));
        $arraydatefivrier[] = ['شهر فيفري', 'تقييم'];
        foreach($datadatefivrier as $key => $value)
        {

            $arraydatefivrier[++$key] = [(string)$value->datefivrier,(int) $value->sums];
        }
  //chart mars
        $datadatemars = DB::table('seancetraitements')
            ->select(
                DB::raw('note as sums'),

                DB::raw("DATE_FORMAT(created_at,'%D')as datemars"))
            ->where('enfant_id','=',$enf)
            ->where( DB::raw('Month(created_at)' ),'=','3' )

            ->get();
        //$k= date("F", mktime(0, 0, 0, date, 1));
        $arraydatemars[] = ['شهر مارس', 'تقييم'];
        foreach($datadatemars as $key => $value)
        {

            $arraydatemars[++$key] = [(string)$value->datemars,(int) $value->sums];
        }
        //chart avril
        $datadateavril = DB::table('seancetraitements')
            ->select(
                DB::raw('note as sums'),

                DB::raw("DATE_FORMAT(created_at,'%D')as dateavril"))
            ->where('enfant_id','=',$enf)
            ->where( DB::raw('Month(created_at)' ),'=','4' )

            ->get();
        //$k= date("F", mktime(0, 0, 0, date, 1));
        $arraydateavril[] = ['شهر افريل', 'تقييم'];
        foreach($datadateavril as $key => $value)
        {

            $arraydateavril[++$key] = [(string)$value->dateavril,(int) $value->sums];
        }
        //chart MAI
        $datadatemai = DB::table('seancetraitements')
            ->select(
                DB::raw('note as sums'),

                DB::raw("DATE_FORMAT(created_at,'%D')as datemai"))
            ->where('enfant_id','=',$enf)
            ->where( DB::raw('Month(created_at)' ),'=','5' )

            ->get();
        //$k= date("F", mktime(0, 0, 0, date, 1));
        $arraydatemai[] = ['شهر ماي', 'تقييم'];
        foreach($datadatemai as $key => $value)
        {

            $arraydatemai[++$key] = [(string)$value->datemai,(int) $value->sums];
        }
 //chart septembre
        $datadateseptember = DB::table('seancetraitements')
            ->select(
                DB::raw('note as sums'),

                DB::raw("DATE_FORMAT(created_at,'%D')as dateseptember"))
            ->where('enfant_id','=',$enf)
            ->where( DB::raw('Month(created_at)' ),'=','9' )

            ->get();
        //$k= date("F", mktime(0, 0, 0, date, 1));
        $arraydateseptember[] = ['شهر سبتمبر', 'تقييم'];
        foreach($datadateseptember as $key => $value)
        {

            $arraydateseptember[++$key] = [(string)$value->dateseptember,(int) $value->sums];
        }
        //chart october
        $datadateoctober = DB::table('seancetraitements')
            ->select(
                DB::raw('note as sums'),

                DB::raw("DATE_FORMAT(created_at,'%D')as dateoctober"))
            ->where('enfant_id','=',$enf)
            ->where( DB::raw('Month(created_at)' ),'=','10' )

            ->get();
        //$k= date("F", mktime(0, 0, 0, date, 1));
        $arraydateoctober[] = ['شهر أكتوبر', 'تقييم'];
        foreach($datadateoctober as $key => $value)
        {

            $arraydateoctober[++$key] = [(string)$value->dateoctober,(int) $value->sums];
        }
        //chartnovember
        $datadatenovember = DB::table('seancetraitements')
            ->select(
                DB::raw('note as sums'),

                DB::raw("DATE_FORMAT(created_at,'%D')as datenovember"))
            ->where('enfant_id','=',$enf)
            ->where( DB::raw('Month(created_at)' ),'=','11' )

            ->get();
        //$k= date("F", mktime(0, 0, 0, date, 1));
        $arraydatenovember[] = ['شهر نوفمبر', 'تقييم'];
        foreach($datadatenovember as $key => $value)
        {

            $arraydatenovember[++$key] = [(string)$value->datenovember,(int) $value->sums];
        }
        //chartdecember
        $datadatedecember = DB::table('seancetraitements')
            ->select(
                DB::raw('note as sums'),

                DB::raw("DATE_FORMAT(created_at,'%D')as datedecember"))
            ->where('enfant_id','=',$enf)
            ->where( DB::raw('Month(created_at)' ),'=','12' )

            ->get();
        //$k= date("F", mktime(0, 0, 0, date, 1));
        $arraydatedecember[] = ['شهر ديسمبر', 'تقييم'];
        foreach($datadatedecember as $key => $value)
        {

            $arraydatedecember[++$key] = [(string)$value->datedecember,(int) $value->sums];
        }



        $datadateyear = DB::table('seancetraitements')
            ->select(
                DB::raw('MAX(note) as sums'),

                DB::raw("DATE_FORMAT(created_at,'%Y')as dateyear"))
            ->where('enfant_id','=',$enf)
            ->groupby('dateyear' )
            ->get();
        $arraydateyear[] = ['عام', 'تقييم'];
        foreach($datadateyear as $key => $value)
        {
            $arraydateyear[++$key] = [(string)$value-> dateyear,(int) $value->sums];
        }

        return view('pagetraitant.seancetraitements.chart',compact('enfant'))->with('month', json_encode($array))->with('datejanvier', json_encode($arraydatejanvier))->with('datefivrier', json_encode($arraydatefivrier))->with('datemars', json_encode($arraydatemars))->with('dateavril', json_encode($arraydateavril))->with('datemai', json_encode($arraydatemai))->with('datedecember', json_encode($arraydatedecember))->with('datenovember', json_encode($arraydatenovember))->with('dateoctober', json_encode($arraydateoctober))->with('dateseptember', json_encode($arraydateseptember))->with('dateyear', json_encode($arraydateyear));
    }
    /***********************************************************************************************/
    /*****************************************كويز المهن*************************************************/
    /***********************************************************************************************/

    public function quizJobs($appenf)
    {
        //Month(created_at)as month
        //DATE_FORMAT(pratiques.created_at,'%D')
        $enfant = Enfant::where('id_enfant',$appenf)->first();
        //**********************************************chart monthly
        $data = DB::table('pratiques','exercices') ->select(
          DB::raw('MAX(score) as score') ,
            DB::raw('Month(pratiques.created_at) as date'))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
        ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "كويز المهن")
            //->where( DB::raw('Month(pratiques.created_at)' ),'=','1' )
            //->orderBy('pratiques.score', 'asc')
            ->groupby(DB::raw('Month(pratiques.created_at)' ))
            ->get();
        $array[] = ['', 'تقييم'];
        foreach($data as $key => $value)
        {
            $array[++$key] = [(string)$value->date,(int) $value->score];
        }

//DATE_FORMAT(created_at,'%M')as date

        //chart janfier
        $datadatejanvier =  DB::table('pratiques','exercices') ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datejanvier"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "كويز المهن")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','1' )
            ->get();
        $arraydatejanvier[] = ['شهر جانفي', 'تقييم'];
        foreach($datadatejanvier as $key => $value)
        {
            $arraydatejanvier[++$key] = [(string)$value->datejanvier,(int) $value->sums];
        }
        //chart fivrier
        $datadatefivrier = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datefivrier"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "كويز المهن")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','2' )
            ->get();
        $arraydatefivrier[] = ['شهر فيفري', 'تقييم'];
        foreach($datadatefivrier as $key => $value)
        {
            $arraydatefivrier[++$key] = [(string)$value->datefivrier,(int) $value->sums];
        }
  //chart mars
        $datadatemars = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datemars"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "كويز المهن")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','3' )
            ->get();
        $arraydatemars[] = ['شهر مارس', 'تقييم'];
        foreach($datadatemars as $key => $value)
        {
            $arraydatemars[++$key] = [(string)$value->datemars,(int) $value->sums];
        }
        //chart avril
        $datadateavril = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as dateavril"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "كويز المهن")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','4' )
            ->get();
        $arraydateavril[] = ['شهر افريل', 'تقييم'];
        foreach($datadateavril as $key => $value)
        {
            $arraydateavril[++$key] = [(string)$value->dateavril,(int) $value->sums];
        }
        //chart MAI
        $datadatemai = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datemai"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "كويز المهن")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','5' )
            ->get();
        $arraydatemai[] = ['شهر ماي', 'تقييم'];
        foreach($datadatemai as $key => $value)
        {
            $arraydatemai[++$key] = [(string)$value->datemai,(int) $value->sums];
        }
 //chart septembre
        $datadateseptember = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as dateseptember"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "كويز المهن")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','9' )
            ->get();
        $arraydateseptember[] = ['شهر سبتمبر', 'تقييم'];
        foreach($datadateseptember as $key => $value)
        {
            $arraydateseptember[++$key] = [(string)$value->dateseptember,(int) $value->sums];
        }
        //chart october
        $datadateoctober = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as dateoctober"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "كويز المهن")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','10' )
            ->get();
        $arraydateoctober[] = ['شهر أكتوبر', 'تقييم'];
        foreach($datadateoctober as $key => $value)
        {
            $arraydateoctober[++$key] = [(string)$value->dateoctober,(int) $value->sums];
        }
        //chartnovember
        $datadatenovember = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datenovember"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "كويز المهن")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','11' )
            ->get();
        //$k= date("F", mktime(0, 0, 0, date, 1));
        $arraydatenovember[] = ['شهر نوفمبر', 'تقييم'];
        foreach($datadatenovember as $key => $value)
        {
            $arraydatenovember[++$key] = [(string)$value->datenovember,(int) $value->sums];
        }
        //chartdecember
        $datadatedecember = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datedecember"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "كويز المهن")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','12' )
            ->get();
        $arraydatedecember[] = ['شهر ديسمبر', 'تقييم'];
        foreach($datadatedecember as $key => $value)
        {
            $arraydatedecember[++$key] = [(string)$value->datedecember,(int) $value->sums];
        }
        return view('pagetraitant.seancetraitements.quiz.quizJobs',compact('enfant'))->with('date', json_encode($array))->with('datejanvier', json_encode($arraydatejanvier))->with('datefivrier', json_encode($arraydatefivrier))->with('datemars', json_encode($arraydatemars))->with('dateavril', json_encode($arraydateavril))->with('datemai', json_encode($arraydatemai))->with('datedecember', json_encode($arraydatedecember))->with('datenovember', json_encode($arraydatenovember))->with('dateoctober', json_encode($arraydateoctober))->with('dateseptember', json_encode($arraydateseptember));
    }
    /***********************************************************************************************/
    /*****************************************كويز الحيوانات*************************************************/
    /***********************************************************************************************/

    public function quizAnimals($hawayanetenf)
    {
        //Month(created_at)as month
        //DATE_FORMAT(pratiques.created_at,'%D')
        $enfant = Enfant::where('id_enfant',$hawayanetenf)->first();

        //**********************************************chart monthly
        $dataH = DB::table('pratiques','exercices') ->select(
            DB::raw('MAX(score) as score') ,
            DB::raw('Month(pratiques.created_at) as dateH'))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $hawayanetenf)->where('exercices.titre','=', "كويز الحيوانات")
            //->where( DB::raw('Month(pratiques.created_at)' ),'=','1' )
            //->orderBy('pratiques.score', 'asc')
            ->groupby(DB::raw('Month(pratiques.created_at)' ))
            ->get();

        $arrayH[] = ['', 'تقييم'];
        foreach($dataH as $key => $value)
        {
            $arrayH[++$key] = [(string)$value->dateH,(int) $value->score];
        }
        $datadatejanvier =  DB::table('pratiques','exercices') ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datejanvier"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $hawayanetenf)->where('exercices.titre','=', "كويز الحيوانات")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','1' )
            ->get();
        $arraydatejanvier[] = ['شهر جانفي', 'تقييم'];

        foreach($datadatejanvier as $key => $value)
        {

            $arraydatejanvier[++$key] = [(string)$value->datejanvier,(int) $value->sums];
        }
        //chart fivrier
        $datadatefivrier = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datefivrier"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $hawayanetenf)->where('exercices.titre','=', "كويز الحيوانات")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','2' )
            ->get();
        $arraydatefivrier[] = ['شهر فيفري', 'تقييم'];
        foreach($datadatefivrier as $key => $value)
        {
            $arraydatefivrier[++$key] = [(string)$value->datefivrier,(int) $value->sums];
        }
  //chart mars
        $datadatemars = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datemars"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $hawayanetenf)->where('exercices.titre','=', "كويز الحيوانات")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','3' )
            ->get();
        $arraydatemars[] = ['شهر مارس', 'تقييم'];
        foreach($datadatemars as $key => $value)
        {
            $arraydatemars[++$key] = [(string)$value->datemars,(int) $value->sums];
        }
        //chart avril
        $datadateavril = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as dateavril"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $hawayanetenf)->where('exercices.titre','=', "كويز الحيوانات")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','4' )
            ->get();
        $arraydateavril[] = ['شهر افريل', 'تقييم'];
        foreach($datadateavril as $key => $value)
        {
            $arraydateavril[++$key] = [(string)$value->dateavril,(int) $value->sums];
        }
        //chart MAI
        $datadatemai = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datemai"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $hawayanetenf)->where('exercices.titre','=', "كويز الحيوانات")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','5' )
            ->get();
        $arraydatemai[] = ['شهر ماي', 'تقييم'];
        foreach($datadatemai as $key => $value)
        {
            $arraydatemai[++$key] = [(string)$value->datemai,(int) $value->sums];
        }
 //chart septembre
        $datadateseptember = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as dateseptember"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $hawayanetenf)->where('exercices.titre','=', "كويز الحيوانات")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','9' )
            ->get();
        $arraydateseptember[] = ['شهر سبتمبر', 'تقييم'];
        foreach($datadateseptember as $key => $value)
        {
            $arraydateseptember[++$key] = [(string)$value->dateseptember,(int) $value->sums];
        }
        //chart october
        $datadateoctober = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as dateoctober"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $hawayanetenf)->where('exercices.titre','=', "كويز الحيوانات")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','10' )
            ->get();
        $arraydateoctober[] = ['شهر أكتوبر', 'تقييم'];
        foreach($datadateoctober as $key => $value)
        {
            $arraydateoctober[++$key] = [(string)$value->dateoctober,(int) $value->sums];
        }
        //chartnovember
        $datadatenovember = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datenovember"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $hawayanetenf)->where('exercices.titre','=', "كويز الحيوانات")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','11' )
            ->get();
        //$k= date("F", mktime(0, 0, 0, date, 1));
        $arraydatenovember[] = ['شهر نوفمبر', 'تقييم'];
        foreach($datadatenovember as $key => $value)
        {
            $arraydatenovember[++$key] = [(string)$value->datenovember,(int) $value->sums];
        }
        //chartdecember
        $datadatedecember = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datedecember"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $hawayanetenf)->where('exercices.titre','=', "كويز الحيوانات")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','12' )
            ->get();
        $arraydatedecember[] = ['شهر ديسمبر', 'تقييم'];
        foreach($datadatedecember as $key => $value)
        {
            $arraydatedecember[++$key] = [(string)$value->datedecember,(int) $value->sums];
        }
        return view('pagetraitant.seancetraitements.quiz.quizAnimals',compact('enfant','inf'))->with('dateH', json_encode($arrayH))->with('datejanvier', json_encode($arraydatejanvier))->with('datefivrier', json_encode($arraydatefivrier))->with('datemars', json_encode($arraydatemars))->with('dateavril', json_encode($arraydateavril))->with('datemai', json_encode($arraydatemai))->with('datedecember', json_encode($arraydatedecember))->with('datenovember', json_encode($arraydatenovember))->with('dateoctober', json_encode($arraydateoctober))->with('dateseptember', json_encode($arraydateseptember));
    }

    /***********************************************************************************************/
    /*****************************************كويز الاشكال*************************************************/
    /***********************************************************************************************/
    public function quizFormes($hawayanetenf)
    {
        //Month(created_at)as month
        //DATE_FORMAT(pratiques.created_at,'%D')
        $enfant = Enfant::where('id_enfant',$hawayanetenf)->first();

        //**********************************************chart monthly
        $dataH = DB::table('pratiques','exercices') ->select(
            DB::raw('MAX(score) as score') ,
            DB::raw('Month(pratiques.created_at) as dateH'))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $hawayanetenf)->where('exercices.titre','=', "كويز الاشكال")
            //->where( DB::raw('Month(pratiques.created_at)' ),'=','1' )
            //->orderBy('pratiques.score', 'asc')
            ->groupby(DB::raw('Month(pratiques.created_at)' ))
            ->get();

        $arrayH[] = ['', 'تقييم'];
        foreach($dataH as $key => $value)
        {
            $arrayH[++$key] = [(string)$value->dateH,(int) $value->score];
        }
        $datadatejanvier =  DB::table('pratiques','exercices') ->select(
            DB::raw('score as sums'),
            DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datejanvier"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $hawayanetenf)->where('exercices.titre','=', "كويز الاشكال")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','1' )
            ->get();
        $arraydatejanvier[] = ['شهر جانفي', 'تقييم'];

        foreach($datadatejanvier as $key => $value)
        {

            $arraydatejanvier[++$key] = [(string)$value->datejanvier,(int) $value->sums];
        }
        //chart fivrier
        $datadatefivrier = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datefivrier"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $hawayanetenf)->where('exercices.titre','=', "كويز الاشكال")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','2' )
            ->get();
        $arraydatefivrier[] = ['شهر فيفري', 'تقييم'];
        foreach($datadatefivrier as $key => $value)
        {
            $arraydatefivrier[++$key] = [(string)$value->datefivrier,(int) $value->sums];
        }
        //chart mars
        $datadatemars = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datemars"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $hawayanetenf)->where('exercices.titre','=', "كويز الاشكال")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','3' )
            ->get();
        $arraydatemars[] = ['شهر مارس', 'تقييم'];
        foreach($datadatemars as $key => $value)
        {
            $arraydatemars[++$key] = [(string)$value->datemars,(int) $value->sums];
        }
        //chart avril
        $datadateavril = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as dateavril"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $hawayanetenf)->where('exercices.titre','=', "كويز الاشكال")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','4' )
            ->get();
        $arraydateavril[] = ['شهر افريل', 'تقييم'];
        foreach($datadateavril as $key => $value)
        {
            $arraydateavril[++$key] = [(string)$value->dateavril,(int) $value->sums];
        }
        //chart MAI
        $datadatemai = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datemai"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $hawayanetenf)->where('exercices.titre','=', "كويز الاشكال")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','5' )
            ->get();
        $arraydatemai[] = ['شهر ماي', 'تقييم'];
        foreach($datadatemai as $key => $value)
        {
            $arraydatemai[++$key] = [(string)$value->datemai,(int) $value->sums];
        }
        //chart septembre
        $datadateseptember = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as dateseptember"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $hawayanetenf)->where('exercices.titre','=', "كويز الاشكال")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','9' )
            ->get();
        $arraydateseptember[] = ['شهر سبتمبر', 'تقييم'];
        foreach($datadateseptember as $key => $value)
        {
            $arraydateseptember[++$key] = [(string)$value->dateseptember,(int) $value->sums];
        }
        //chart october
        $datadateoctober = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as dateoctober"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $hawayanetenf)->where('exercices.titre','=', "كويز الاشكال")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','10' )
            ->get();
        $arraydateoctober[] = ['شهر أكتوبر', 'تقييم'];
        foreach($datadateoctober as $key => $value)
        {
            $arraydateoctober[++$key] = [(string)$value->dateoctober,(int) $value->sums];
        }
        //chartnovember
        $datadatenovember = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datenovember"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $hawayanetenf)->where('exercices.titre','=', "كويز الاشكال")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','11' )
            ->get();
        //$k= date("F", mktime(0, 0, 0, date, 1));
        $arraydatenovember[] = ['شهر نوفمبر', 'تقييم'];
        foreach($datadatenovember as $key => $value)
        {
            $arraydatenovember[++$key] = [(string)$value->datenovember,(int) $value->sums];
        }
        //chartdecember
        $datadatedecember = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datedecember"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $hawayanetenf)->where('exercices.titre','=', "كويز الاشكال")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','12' )
            ->get();
        $arraydatedecember[] = ['شهر ديسمبر', 'تقييم'];
        foreach($datadatedecember as $key => $value)
        {
            $arraydatedecember[++$key] = [(string)$value->datedecember,(int) $value->sums];
        }
        return view('pagetraitant.seancetraitements.quiz.quizFormes',compact('enfant','inf'))->with('dateH', json_encode($arrayH))->with('datejanvier', json_encode($arraydatejanvier))->with('datefivrier', json_encode($arraydatefivrier))->with('datemars', json_encode($arraydatemars))->with('dateavril', json_encode($arraydateavril))->with('datemai', json_encode($arraydatemai))->with('datedecember', json_encode($arraydatedecember))->with('datenovember', json_encode($arraydatenovember))->with('dateoctober', json_encode($arraydateoctober))->with('dateseptember', json_encode($arraydateseptember));
    }
    /***********************************************************************************************/
    /*****************************************كويز لعبة الذاكرة*************************************************/
    /***********************************************************************************************/
    public function memoryGame($appenf)
    {
        $enfant = Enfant::where('id_enfant',$appenf)->first();
        //**********************************************chart monthly
        $data = DB::table('pratiques','exercices') ->select(
            DB::raw('MAX(score) as score') ,
            DB::raw('Month(pratiques.created_at) as date'))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "لعبة الذاكرة")

            ->groupby(DB::raw('Month(pratiques.created_at)' ))
            ->get();
        $array[] = ['', 'تقييم'];
        foreach($data as $key => $value)
        {
            $array[++$key] = [(string)$value->date,(int) $value->score];
        }

//DATE_FORMAT(created_at,'%M')as date

        //chart janfier
        $datadatejanvier = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datejanvier"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "لعبة الذاكرة")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','1' )
            ->get();
        $arraydatejanvier[] = ['شهر فيفري', 'تقييم'];
        foreach($datadatejanvier as $key => $value)
        {
            $arraydatejanvier[++$key] = [(string)$value->datejanvier,(int) $value->sums];
        }
        //chart fivrier
        $datadatefivrier = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datefivrier"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "لعبة الذاكرة")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','2' )
            ->get();
        $arraydatefivrier[] = ['شهر فيفري', 'تقييم'];
        foreach($datadatefivrier as $key => $value)
        {
            $arraydatefivrier[++$key] = [(string)$value->datefivrier,(int) $value->sums];
        }
        //chart mars
        $datadatemars = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datemars"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "لعبة الذاكرة")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','3' )
            ->get();
        $arraydatemars[] = ['شهر مارس', 'تقييم'];
        foreach($datadatemars as $key => $value)
        {
            $arraydatemars[++$key] = [(string)$value->datemars,(int) $value->sums];
        }
        //chart avril
        $datadateavril = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as dateavril"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "لعبة الذاكرة")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','4' )
            ->get();
        $arraydateavril[] = ['شهر افريل', 'تقييم'];
        foreach($datadateavril as $key => $value)
        {
            $arraydateavril[++$key] = [(string)$value->dateavril,(int) $value->sums];
        }
        //chart MAI
        $datadatemai = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datemai"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "لعبة الذاكرة")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','5' )
            ->get();
        $arraydatemai[] = ['شهر ماي', 'تقييم'];
        foreach($datadatemai as $key => $value)
        {
            $arraydatemai[++$key] = [(string)$value->datemai,(int) $value->sums];
        }
        //chart septembre
        $datadateseptember = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as dateseptember"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "لعبة الذاكرة")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','9' )
            ->get();
        $arraydateseptember[] = ['شهر سبتمبر', 'تقييم'];
        foreach($datadateseptember as $key => $value)
        {
            $arraydateseptember[++$key] = [(string)$value->dateseptember,(int) $value->sums];
        }
        //chart october
        $datadateoctober = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as dateoctober"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "لعبة الذاكرة")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','10' )
            ->get();
        $arraydateoctober[] = ['شهر أكتوبر', 'تقييم'];
        foreach($datadateoctober as $key => $value)
        {
            $arraydateoctober[++$key] = [(string)$value->dateoctober,(int) $value->sums];
        }
        //chartnovember
        $datadatenovember = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datenovember"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "لعبة الذاكرة")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','11' )
            ->get();
        //$k= date("F", mktime(0, 0, 0, date, 1));
        $arraydatenovember[] = ['شهر نوفمبر', 'تقييم'];
        foreach($datadatenovember as $key => $value)
        {
            $arraydatenovember[++$key] = [(string)$value->datenovember,(int) $value->sums];
        }
        //chartdecember
        $datadatedecember = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datedecember"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "لعبة الذاكرة")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','12' )
            ->get();
        $arraydatedecember[] = ['شهر ديسمبر', 'تقييم'];
        foreach($datadatedecember as $key => $value)
        {
            $arraydatedecember[++$key] = [(string)$value->datedecember,(int) $value->sums];
        }
        return view('pagetraitant.seancetraitements.quiz.memoryGame',compact('enfant'))->with('date', json_encode($array))->with('datejanvier', json_encode($arraydatejanvier))->with('datefivrier', json_encode($arraydatefivrier))->with('datemars', json_encode($arraydatemars))->with('dateavril', json_encode($arraydateavril))->with('datemai', json_encode($arraydatemai))->with('datedecember', json_encode($arraydatedecember))->with('datenovember', json_encode($arraydatenovember))->with('dateoctober', json_encode($arraydateoctober))->with('dateseptember', json_encode($arraydateseptember));
    }

    /***********************************************************************************************/
    /*****************************************كويز الاتجاهات*************************************************/
    /***********************************************************************************************/
    public function quizDirections($appenf)
    {
        //Month(created_at)as month
        //DATE_FORMAT(pratiques.created_at,'%D')
        $enfant = Enfant::where('id_enfant',$appenf)->first();
        //**********************************************chart monthly
        $data = DB::table('pratiques','exercices') ->select(
            DB::raw('MAX(score) as score') ,
            DB::raw('Month(pratiques.created_at) as date'))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "كويز الاتجاهات")
            //->where( DB::raw('Month(pratiques.created_at)' ),'=','1' )
            //->orderBy('pratiques.score', 'asc')
            ->groupby(DB::raw('Month(pratiques.created_at)' ))
            ->get();
        $array[] = ['', 'تقييم'];
        foreach($data as $key => $value)
        {
            $array[++$key] = [(string)$value->date,(int) $value->score];
        }

//DATE_FORMAT(created_at,'%M')as date

        //chart janfier
        $datadatejanvier =  DB::table('pratiques','exercices') ->select(
            DB::raw('score as sums'),
            DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datejanvier"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "كويز الاتجاهات")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','1' )
            ->get();
        $arraydatejanvier[] = ['شهر جانفي', 'تقييم'];
        foreach($datadatejanvier as $key => $value)
        {
            $arraydatejanvier[++$key] = [(string)$value->datejanvier,(int) $value->sums];
        }
        //chart fivrier
        $datadatefivrier = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datefivrier"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "كويز الاتجاهات")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','2' )
            ->get();
        $arraydatefivrier[] = ['شهر فيفري', 'تقييم'];
        foreach($datadatefivrier as $key => $value)
        {
            $arraydatefivrier[++$key] = [(string)$value->datefivrier,(int) $value->sums];
        }
        //chart mars
        $datadatemars = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datemars"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "كويز الاتجاهات")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','3' )
            ->get();
        $arraydatemars[] = ['شهر مارس', 'تقييم'];
        foreach($datadatemars as $key => $value)
        {
            $arraydatemars[++$key] = [(string)$value->datemars,(int) $value->sums];
        }
        //chart avril
        $datadateavril = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as dateavril"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "كويز الاتجاهات")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','4' )
            ->get();
        $arraydateavril[] = ['شهر افريل', 'تقييم'];
        foreach($datadateavril as $key => $value)
        {
            $arraydateavril[++$key] = [(string)$value->dateavril,(int) $value->sums];
        }
        //chart MAI
        $datadatemai = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datemai"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "كويز الاتجاهات")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','5' )
            ->get();
        $arraydatemai[] = ['شهر ماي', 'تقييم'];
        foreach($datadatemai as $key => $value)
        {
            $arraydatemai[++$key] = [(string)$value->datemai,(int) $value->sums];
        }
        //chart septembre
        $datadateseptember = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as dateseptember"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "كويز الاتجاهات")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','9' )
            ->get();
        $arraydateseptember[] = ['شهر سبتمبر', 'تقييم'];
        foreach($datadateseptember as $key => $value)
        {
            $arraydateseptember[++$key] = [(string)$value->dateseptember,(int) $value->sums];
        }
        //chart october
        $datadateoctober = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as dateoctober"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "كويز الاتجاهات")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','10' )
            ->get();
        $arraydateoctober[] = ['شهر أكتوبر', 'تقييم'];
        foreach($datadateoctober as $key => $value)
        {
            $arraydateoctober[++$key] = [(string)$value->dateoctober,(int) $value->sums];
        }
        //chartnovember
        $datadatenovember = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datenovember"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "كويز الاتجاهات")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','11' )
            ->get();
        //$k= date("F", mktime(0, 0, 0, date, 1));
        $arraydatenovember[] = ['شهر نوفمبر', 'تقييم'];
        foreach($datadatenovember as $key => $value)
        {
            $arraydatenovember[++$key] = [(string)$value->datenovember,(int) $value->sums];
        }
        //chartdecember
        $datadatedecember = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datedecember"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "كويز الاتجاهات")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','12' )
            ->get();
        $arraydatedecember[] = ['شهر ديسمبر', 'تقييم'];
        foreach($datadatedecember as $key => $value)
        {
            $arraydatedecember[++$key] = [(string)$value->datedecember,(int) $value->sums];
        }
        return view('pagetraitant.seancetraitements.quiz.quizDirections',compact('enfant'))->with('date', json_encode($array))->with('datejanvier', json_encode($arraydatejanvier))->with('datefivrier', json_encode($arraydatefivrier))->with('datemars', json_encode($arraydatemars))->with('dateavril', json_encode($arraydateavril))->with('datemai', json_encode($arraydatemai))->with('datedecember', json_encode($arraydatedecember))->with('datenovember', json_encode($arraydatenovember))->with('dateoctober', json_encode($arraydateoctober))->with('dateseptember', json_encode($arraydateseptember));
    }
    /***********************************************************************************************/
    /*****************************************كويز الالوان*************************************************/
    /***********************************************************************************************/
    public function quizColors($appenf)
    {
        //Month(created_at)as month
        //DATE_FORMAT(pratiques.created_at,'%D')
        $enfant = Enfant::where('id_enfant',$appenf)->first();
        //**********************************************chart monthly
        $data = DB::table('pratiques','exercices') ->select(
            DB::raw('MAX(score) as score') ,
            DB::raw('Month(pratiques.created_at) as date'))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', " كويز الألوان")
            //->where( DB::raw('Month(pratiques.created_at)' ),'=','1' )
            //->orderBy('pratiques.score', 'asc')
            ->groupby(DB::raw('Month(pratiques.created_at)' ))
            ->get();
        $array[] = ['', 'تقييم'];
        foreach($data as $key => $value)
        {
            $array[++$key] = [(string)$value->date,(int) $value->score];
        }

//DATE_FORMAT(created_at,'%M')as date

        //chart janfier
        $datadatejanvier =  DB::table('pratiques','exercices') ->select(
            DB::raw('score as sums'),
            DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datejanvier"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', " كويز الألوان")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','1' )
            ->get();
        $arraydatejanvier[] = ['شهر جانفي', 'تقييم'];
        foreach($datadatejanvier as $key => $value)
        {
            $arraydatejanvier[++$key] = [(string)$value->datejanvier,(int) $value->sums];
        }
        //chart fivrier
        $datadatefivrier = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datefivrier"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', " كويز الألوان")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','2' )
            ->get();
        $arraydatefivrier[] = ['شهر فيفري', 'تقييم'];
        foreach($datadatefivrier as $key => $value)
        {
            $arraydatefivrier[++$key] = [(string)$value->datefivrier,(int) $value->sums];
        }
        //chart mars
        $datadatemars = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datemars"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "كويز الألوان")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','3' )
            ->get();
        $arraydatemars[] = ['شهر مارس', 'تقييم'];
        foreach($datadatemars as $key => $value)
        {
            $arraydatemars[++$key] = [(string)$value->datemars,(int) $value->sums];
        }
        //chart avril
        $datadateavril = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as dateavril"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "كويز الألوان")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','4' )
            ->get();
        $arraydateavril[] = ['شهر افريل', 'تقييم'];
        foreach($datadateavril as $key => $value)
        {
            $arraydateavril[++$key] = [(string)$value->dateavril,(int) $value->sums];
        }
        //chart MAI
        $datadatemai = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datemai"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "كويز الألوان")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','5' )
            ->get();
        $arraydatemai[] = ['شهر ماي', 'تقييم'];
        foreach($datadatemai as $key => $value)
        {
            $arraydatemai[++$key] = [(string)$value->datemai,(int) $value->sums];
        }
        //chart septembre
        $datadateseptember = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as dateseptember"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', " كويز الألوان")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','9' )
            ->get();
        $arraydateseptember[] = ['شهر سبتمبر', 'تقييم'];
        foreach($datadateseptember as $key => $value)
        {
            $arraydateseptember[++$key] = [(string)$value->dateseptember,(int) $value->sums];
        }
        //chart october
        $datadateoctober = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as dateoctober"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', " كويز الألوان")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','10' )
            ->get();
        $arraydateoctober[] = ['شهر أكتوبر', 'تقييم'];
        foreach($datadateoctober as $key => $value)
        {
            $arraydateoctober[++$key] = [(string)$value->dateoctober,(int) $value->sums];
        }
        //chartnovember
        $datadatenovember = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datenovember"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', " كويز الألوان")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','11' )
            ->get();
        //$k= date("F", mktime(0, 0, 0, date, 1));
        $arraydatenovember[] = ['شهر نوفمبر', 'تقييم'];
        foreach($datadatenovember as $key => $value)
        {
            $arraydatenovember[++$key] = [(string)$value->datenovember,(int) $value->sums];
        }
        //chartdecember
        $datadatedecember = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datedecember"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', " كويز الألوان")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','12' )
            ->get();
        $arraydatedecember[] = ['شهر ديسمبر', 'تقييم'];
        foreach($datadatedecember as $key => $value)
        {
            $arraydatedecember[++$key] = [(string)$value->datedecember,(int) $value->sums];
        }
        return view('pagetraitant.seancetraitements.quiz.quizColors',compact('enfant'))->with('date', json_encode($array))->with('datejanvier', json_encode($arraydatejanvier))->with('datefivrier', json_encode($arraydatefivrier))->with('datemars', json_encode($arraydatemars))->with('dateavril', json_encode($arraydateavril))->with('datemai', json_encode($arraydatemai))->with('datedecember', json_encode($arraydatedecember))->with('datenovember', json_encode($arraydatenovember))->with('dateoctober', json_encode($arraydateoctober))->with('dateseptember', json_encode($arraydateseptember));
    }
    /***********************************************************************************************/
    /*****************************************كويز الفواكه*************************************************/
    /***********************************************************************************************/
    public function quizFruits($appenf)
    {
        //Month(created_at)as month
        //DATE_FORMAT(pratiques.created_at,'%D')
        $enfant = Enfant::where('id_enfant',$appenf)->first();
        //**********************************************chart monthly
        $data = DB::table('pratiques','exercices') ->select(
            DB::raw('MAX(score) as score') ,
            DB::raw('Month(pratiques.created_at) as date'))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "كويز الفواكه")
            //->where( DB::raw('Month(pratiques.created_at)' ),'=','1' )
            //->orderBy('pratiques.score', 'asc')
            ->groupby(DB::raw('Month(pratiques.created_at)' ))
            ->get();
        $array[] = ['', 'تقييم'];
        foreach($data as $key => $value)
        {
            $array[++$key] = [(string)$value->date,(int) $value->score];
        }

//DATE_FORMAT(created_at,'%M')as date

        //chart janfier
        $datadatejanvier =  DB::table('pratiques','exercices') ->select(
            DB::raw('score as sums'),
            DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datejanvier"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "كويز الفواكه")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','1' )
            ->get();
        $arraydatejanvier[] = ['شهر جانفي', 'تقييم'];
        foreach($datadatejanvier as $key => $value)
        {
            $arraydatejanvier[++$key] = [(string)$value->datejanvier,(int) $value->sums];
        }
        //chart fivrier
        $datadatefivrier = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datefivrier"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "كويز الفواكه")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','2' )
            ->get();
        $arraydatefivrier[] = ['شهر فيفري', 'تقييم'];
        foreach($datadatefivrier as $key => $value)
        {
            $arraydatefivrier[++$key] = [(string)$value->datefivrier,(int) $value->sums];
        }
        //chart mars
        $datadatemars = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datemars"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "كويز الفواكه")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','3' )
            ->get();
        $arraydatemars[] = ['شهر مارس', 'تقييم'];
        foreach($datadatemars as $key => $value)
        {
            $arraydatemars[++$key] = [(string)$value->datemars,(int) $value->sums];
        }
        //chart avril
        $datadateavril = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as dateavril"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "كويز الفواكه")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','4' )
            ->get();
        $arraydateavril[] = ['شهر افريل', 'تقييم'];
        foreach($datadateavril as $key => $value)
        {
            $arraydateavril[++$key] = [(string)$value->dateavril,(int) $value->sums];
        }
        //chart MAI
        $datadatemai = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datemai"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "كويز الفواكه")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','5' )
            ->get();
        $arraydatemai[] = ['شهر ماي', 'تقييم'];
        foreach($datadatemai as $key => $value)
        {
            $arraydatemai[++$key] = [(string)$value->datemai,(int) $value->sums];
        }
        //chart septembre
        $datadateseptember = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as dateseptember"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "كويز الفواكه")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','9' )
            ->get();
        $arraydateseptember[] = ['شهر سبتمبر', 'تقييم'];
        foreach($datadateseptember as $key => $value)
        {
            $arraydateseptember[++$key] = [(string)$value->dateseptember,(int) $value->sums];
        }
        //chart october
        $datadateoctober = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as dateoctober"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "كويز الفواكه")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','10' )
            ->get();
        $arraydateoctober[] = ['شهر أكتوبر', 'تقييم'];
        foreach($datadateoctober as $key => $value)
        {
            $arraydateoctober[++$key] = [(string)$value->dateoctober,(int) $value->sums];
        }
        //chartnovember
        $datadatenovember = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datenovember"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "كويز الفواكه")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','11' )
            ->get();
        //$k= date("F", mktime(0, 0, 0, date, 1));
        $arraydatenovember[] = ['شهر نوفمبر', 'تقييم'];
        foreach($datadatenovember as $key => $value)
        {
            $arraydatenovember[++$key] = [(string)$value->datenovember,(int) $value->sums];
        }
        //chartdecember
        $datadatedecember = DB::table('pratiques','exercices')
            ->select(
                DB::raw('score as sums'),
                DB::raw("DATE_FORMAT(pratiques.created_at,'%D')as datedecember"))
            ->join( 'exercices','exercices.id_exercice', '=', 'pratiques.exercice_id')
            ->where('pratiques.enfant_id', $appenf)->where('exercices.titre','=', "كويز الفواكه")
            ->where( DB::raw('Month(pratiques.created_at)' ),'=','12' )
            ->get();
        $arraydatedecember[] = ['شهر ديسمبر', 'تقييم'];
        foreach($datadatedecember as $key => $value)
        {
            $arraydatedecember[++$key] = [(string)$value->datedecember,(int) $value->sums];
        }
        return view('pagetraitant.seancetraitements.quiz.quizFruits',compact('enfant'))->with('date', json_encode($array))->with('datejanvier', json_encode($arraydatejanvier))->with('datefivrier', json_encode($arraydatefivrier))->with('datemars', json_encode($arraydatemars))->with('dateavril', json_encode($arraydateavril))->with('datemai', json_encode($arraydatemai))->with('datedecember', json_encode($arraydatedecember))->with('datenovember', json_encode($arraydatenovember))->with('dateoctober', json_encode($arraydateoctober))->with('dateseptember', json_encode($arraydateseptember));
    }
}
