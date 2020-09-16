<?php

namespace App\Http\Controllers\Admin;
use App\Enfant;
use App\Parentt;
use App\Traitant;
use App\User;
use Carbon\Carbon;
use DB;
use Cassandra\FutureRows;
use Cassandra\Rows;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use mysql_xdevapi\RowResult;
use Session;
class EnfantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }
    public function index()
    {

        $arr['enfants']=Enfant::simplePaginate(5);
        $arr['parentts']=Parentt::all();

        return view('admin.enfants.index')->with($arr)->with('i', (request()->input('page', 1) - 1) * 5);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arr['enfants']=Enfant::all();
        $arr['parentts']=Parentt::all();
        $arr['traitants']=Traitant::all();

        return view('admin.enfants.create')->with($arr);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request,Enfant $enfant,Parentt $parentt,User $user)
    {
        $this->validate($request, array('imageChild'=>'required','imageMother1'=>'required','imageMother2'=>'required',
                'nom'=>'required', 'nom1'=>'required', 'dateNaissance'=>'required', 'lieuNaissannce'=>'required','wilaya'=>'required',
            'commune'=>'required','domicile'=>'required',
                'motpass1'=>'required', 'email1'=>'required|email','prenom1'=>'required','dateNaissance1'=>'required',
                'numTel1'=>'required', 'lieuTravail1'=>'required','niveauEduc1'=>'required', 'motpass2'=>'required', 'email2'=>'required|email','prenom2'=>'required','dateNaissance2'=>'required',
                'numTel2'=>'required', 'lieuTravail2'=>'required','niveauEduc2'=>'required','nom2'=>'required'
                )
        );
        $data = $request->all();
        $mail = DB::table('users')->pluck('email')->toArray();
        //dd($user);
        if(isset($mail,$data['email'])) {
            return redirect()->route('admin.enfants.create')->with('success','البريد الالكتروني مستخدم من قبل يرجى تغييره');

        }
        else{
        if($request->imageChild->getClientOriginalName()){
            $ext =  $request->imageChild->getClientOriginalExtension();
            $file = date('YmdHis').rand(1,99999).'.'.$ext;
            $request->imageChild->storeAs('public/enfants',$file);
        }
        else
        {
            $file = '';
        }
        $enfant->image=$file;
        $enfant->prenom=$request->nom1;
        $enfant->nom=$request->nom;
        $enfant->dateNaissance=$request->dateNaissance;
        $enfant->lieuNaissannce=$request->lieuNaissannce;
        $enfant->sexe=$request->sexe;
        $enfant->groupage=$request->groupage;
        $enfant->wilaya=$request->wilaya;
        $enfant->commune=$request->commune;
        $enfant->domicile=$request->domicile;

        $enfant->save();
        $requestData=$request->all();
        for($i=1;$i<=2;$i++){
            $parentts=new Parentt(); $users=new User();

            if($requestData['imageMother'.$i]->getClientOriginalName()){
                $ext = $requestData['imageMother'.$i]->getClientOriginalExtension();
                $file = date('YmdHis').rand(1,99999).'.'.$ext;
                $requestData['imageMother'.$i]->storeAs('public/familles',$file);
            }
            else
            {
                $file = '';
            }
            $names[0] = $requestData['nom'.$i];
            $names[1] =$requestData['prenom'.$i];
            $users->name= implode(" ", $names);
            $users->email=$requestData['email'.$i];
            $users->image=$file;
            $users->password=Hash::make($requestData['motpass'.$i]);
            $users->save();
            $lastInsertedId = $users->id;
            $parentts->user_id=$lastInsertedId;
//            $last_id =    \DB::table('categories')->max('id');

            $parentts->img=$file;
            $parentts->prenomp=$requestData['prenom'.$i];
            $parentts->nomp=$requestData['nom'.$i];
            $parentts->dateNaissancep=$requestData['dateNaissance'.$i];
            $parentts->motpass=$requestData['motpass'.$i];
            $parentts->numTel=$requestData['numTel'.$i];
            $parentts->email=$requestData['email'.$i];
            $parentts->niveauEduc=$requestData['niveauEduc'.$i];
            $parentts->lieuTravail=$requestData['lieuTravail'.$i];
            $enfant->parentts()->save($parentts);
        }



        return redirect()->route('admin.enfants.index')->with('success','تمت عملية الاضافة بنجاح ');}
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_enfant)
    {
        $enfant = Enfant::where('id_enfant',$id_enfant)->first();
        $parentt = Parentt::join('enfants', 'enfants.id_enfant', '=', 'parentts.enfant_id')->where('parentts.enfant_id',$id_enfant)->first();
        $firs=$parentt->id_parentt;
        $parent = Parentt::join('enfants', 'enfants.id_enfant', '=', 'parentts.enfant_id')->where('parentts.id_parentt',$firs+1)->first();
        //CALCUATE AGE Enfant
        $dateNaiss= $enfant->dateNaissance;
        $calculeAgeEnf=Carbon::parse($dateNaiss)->age;
        //CALCUATE AGE pere
        $dateNaissP= $parentt->dateNaissancep;
        $calculeAgePere=Carbon::parse($dateNaissP)->age;
        //CALCUATE AGE mere
        $dateNaissM= $parent->dateNaissancep;
        $calculeAgeMere=Carbon::parse($dateNaissM)->age;

        return view('admin.enfants.show')->with( compact('calculeAgeMere','calculeAgePere','calculeAgeEnf','parentt','parent','enfant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_enfant)
    {
        $enfant = Enfant::where('id_enfant',$id_enfant)->first();
        $parentt = Parentt::join('enfants', 'enfants.id_enfant', '=', 'parentts.enfant_id')->where('parentts.enfant_id',$id_enfant)->first();

        $firs=$parentt->id_parentt;
        $parent = Parentt::join('enfants', 'enfants.id_enfant', '=', 'parentts.enfant_id')->where('parentts.id_parentt',$firs+1)->first();
        $arr['enfants']=$id_enfant;
        $arr['parentt'] =$parentt;


        return view('admin.enfants.edit')->with(compact('parentt','parent','enfant'))->with($arr);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $enfant)
    {
        $parentt = Parentt::join('enfants', 'enfants.id_enfant', '=', 'parentts.enfant_id')->where('parentts.enfant_id',$enfant)->get();

        /********************************************************************************/
        /********parent1*******/
        //pour determiner le terme 2
        $parent1=$parentt->get(1);
        //pour determiner USER PARENT1
        $use1=$parent1->user_id;
        $user1=User::find($use1);
        if(isset($request->imageMother2) && $request->imageMother2->getClientOriginalName()){
            $ext =  $request->imageMother2->getClientOriginalExtension();
            $file = date('YmdHis').rand(1,99999).'.'.$ext;
            $request->imageMother2->storeAs('public/familles',$file);
        }
        else
        {
            if(!$parent1->img)
                $file = '';
            else
                $file = $parent1->img;
        }


        $parent1->img=$file;
        $parent1->prenomp=$request->prenomp2;
        $parent1->nomp=$request->nomp2;
        $parent1->dateNaissancep=$request->dateNaissancep2;
        $parent1->motpass=$request->motpassp2;
        $parent1->numTel=$request->numTelp2;
        $parent1->email=$request->emailp2;
        $parent1->niveauEduc=$request->niveauEducp2;
        $parent1->lieuTravail=$request->lieuTravailp2;
        $parent1->save();

        $names1[0] = $request->nomp2;
        $names1[1] = $request->prenomp2;

        $user1->image=$file;
        $user1->name=implode(" ", $names1);
        $user1->email=$request->emailp2;
        $user1->password=Hash::make($request->motpass2);


        /********************************************************************************/
        /********parent2*******/
        //pour determiner le terme 1
        $parent2=$parentt->get(0);
        //dd($parent2);
        //pour determiner USER PARENT2
         $use2=$parent2->user_id;
         $user2=User::find($use2);
        if(isset($request->imageMother1) && $request->imageMother1->getClientOriginalName()){
            $ext =  $request->imageMother1->getClientOriginalExtension();
            $file = date('YmdHis').rand(1,99999).'.'.$ext;
            $request->imageMother1->storeAs('public/familles',$file);
        }
        else
        {
            if(!$parent2->img)
                $file = '';
            else
                $file = $parent2->img;
        }
             $parent2->img=$file;
        $parent2->prenomp=$request->prenomp1;
        $parent2->nomp=$request->prenomEnf;
        $parent2->dateNaissancep=$request->dateNaissancep1;
        $parent2->motpass=$request->motpassp1;
        $parent2->numTel=$request->numTelp1;
        $parent2->email=$request->emailp1;
        $parent2->niveauEduc=$request->niveauEducp1;
        $parent2->lieuTravail=$request->lieuTravailp1;
        $parent2->save();
        $names2[0] =$request->prenomEnf;
        $names2[1] = $request->prenomp1;
        $user2->image=$file;$user2->name=implode(" ", $names2);$user2->email=$request->emailp1; $user2->password=Hash::make($request->motpass1);



/************************************************************************************************/
//pour determine id enfant

        $enfant=Enfant::find($enfant);
        if(isset($request->imageChild) && $request->imageChild->getClientOriginalName()){
            $ext =  $request->imageChild->getClientOriginalExtension();
            $file = date('YmdHis').rand(1,99999).'.'.$ext;
            $request->imageChild->storeAs('public/enfants',$file);
        }
        else
        {
            if(!$enfant->image)
                $file = '';
            else
                $file = $enfant->image;
        }

        $enfant->image=$file;
        $enfant->prenom=$request->prenomEnf;
        $enfant->nom=$request->nomEnf;
        $enfant->dateNaissance=$request->dateNaissance;
        $enfant->lieuNaissannce=$request->lieuNaissannce;
        $enfant->sexe=$request->sexe;
        $enfant->groupage=$request->groupage;
        $enfant->wilaya=$request->wilaya;
        $enfant->commune=$request->commune;
        $enfant->domicile=$request->domicile;

        $enfant->save();
        $user1->save(); $user2->save();
        return redirect()->route('admin.enfants.index')->with('success','تمت عملية التعديل بنجاح ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = Enfant::findOrFail($request->id_enfant);
        $parentt = Parentt::join('enfants', 'enfants.id_enfant', '=', 'parentts.enfant_id')->where('parentts.enfant_id',$request->id_enfant)->get();
        $idParent11=$parentt->get(1);
        $idParent1=$idParent11->id_parentt;
        $idUser1= $idParent11->user_id;
        $idParent22=$parentt->get(0);
        $idParent2=$idParent22->id_parentt;
        $idUser2=$idParent22->user_id;
        $Userdata1 =User::findOrFail($idUser1);$Userdata2 =User::findOrFail($idUser2); $Userdata1->delete(); $Userdata2->delete();
        $Parentdata1 =Parentt::findOrFail($idParent1); $Parentdata2 =Parentt::findOrFail($idParent2);  $Parentdata1->delete();  $Parentdata2->delete();
        $data->delete();

        return redirect()->route('admin.enfants.index')->with('success','تمت عملية الحذف بنجاح ');
    }


}
