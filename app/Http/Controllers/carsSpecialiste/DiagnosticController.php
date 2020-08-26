<?php

namespace App\Http\Controllers\carsSpecialiste;

use App\Detail;
use App\Enfant;
use App\Carsspecialiste;
use App\Diagnostic;
use App\Parentt;
use DB;
use PDF;
use App\Traitant;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Integer;
use Session;

class DiagnosticController extends Controller
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
        //$arr['enfants']=Enfant::latest()->paginate(2);
        $arr['enfants'] = Enfant::simplePaginate(5);
        $arr['diagnostics'] = Diagnostic::all();
        $arr['carsspecialistes'] = Carsspecialiste::all();


        return view('pagecarsspecialiste.diagnostics.index')->with($arr)->with('i', (request()->input('page', 1) - 1) * 5);
    }
//***************************search


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $arr['enfants'] = Enfant::all();
        $arr['diagnostics'] = Diagnostic::all();
        $arr['carsspecialistes'] = Carsspecialiste::all();
        $dateActuelle = Carbon::now()->toDateString();
        return view('pagecarsspecialiste.diagnostics.create', compact('dateActuelle', 'carsspecialiste'))->with($arr);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request, Diagnostic $diagnostic, Detail $detail)
    {
        if (isset($request)) {
            $nomid = $request->enf_id;
            $prenomid = $request->enfant_id;
            $dateid = $request->enfa_id;
            $nomSpecialiste = Auth::user()->name;
            $nomSpecialiste = User::where('name', 'LIKE', '%' . $nomSpecialiste . '%')->first();
            $iduser = $nomSpecialiste->id;

            $specialiste = Carsspecialiste::join('users', 'users.id', 'carsspecialistes.user_id')->where('carsspecialistes.user_id', $iduser)->first();
            $idSp = $specialiste->id_carsspecialiste;
            $diagnostic = Diagnostic::create([
                "enfant_id" => $prenomid,
                "id_superviseur" => $request->trait,
                "carsspecialiste_id" => $idSp,
                "dateDiagnostic" => $request->date,
                "remarque" => $request->remarque15,
                "niveau" => $request->autismresult
            ]);

            $responses = json_decode($request->responses);
            $questions = json_decode($request->questions);
            $remarques = json_decode($request->remarques);
            /* dd($questions); */
            for ($i = 1; $i <= 15; $i++) {
                $response = (array)$responses[$i - 1];
                $question = (array)$questions[$i - 1];
                $remarque = (array)$remarques[$i - 1];
                /* dd($response); */
                $details = new Detail();
                $details->reponses = $response['rText'];
                $details->numResponses =  $response['value'];
                // $requestData['text'];

                $details->questions = $question['value'];
                $details->observations = $remarque['value'];
                $diagnostic->detail()->save($details);
            }

            return redirect()->route('pagecarsspecialiste.affiche', $prenomid)->with(compact('detail'))->with('success', 'تمت اضافة التشخيص بنجاح ');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $diagnostic = Diagnostic::where('id', $id)->first();
        $enfant = Enfant::join('diagnostics', 'diagnostics.enfant_id', '=', 'enfants.id_enfant')->where('diagnostics.id', $id)->first();
        $id_enfant = $enfant->id_enfant;
        $enfant = $enfant::find($id_enfant);
        $carsspecialiste = Carsspecialiste::join('diagnostics', 'diagnostics.carsspecialiste_id', '=', 'carsspecialistes.id_carsspecialiste')->where('diagnostics.id', $id)->first();
        $id_carsspecialiste = $carsspecialiste->id_carsspecialiste;
        $carsspecialiste = carsspecialiste::find($id_carsspecialiste);
        $arr['carsspecialistes'] = Carsspecialiste::all();
        $detail = Detail::join('diagnostics', 'diagnostics.id', '=', 'detail.diagnostic_id')->where('diagnostics.id', $id)->get();
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
        return view('pagecarsspecialiste.diagnostics.show')->with(compact('diagnostic','parent', 'age', 'parentt', 'carsspecialiste', 'enfant','id',
        'question','question1','question2','question3','question4','question5','question6','question7','question8','question9','question10','question11','question12','question13','question14',
        'reponse0','reponse1','reponse2','reponse3','reponse4','reponse5','reponse6','reponse7','reponse8','reponse9','reponse10','reponse11','reponse12','reponse13','reponse14',
        'observ0','observ1','observ2','observ3','observ4','observ5','observ6','observ7','observ8','observ9','observ10','observ11','observ12','observ13','observ14'))->with($arr);
    }

    public function affiche($id_enfant)
    {

        $arr['enfants'] = Enfant::all();
        $arr['diagnostics'] = Diagnostic::all();
        $arr['carsspecialistes'] = Carsspecialiste::all();
        $enfant = Enfant::where('id_enfant', $id_enfant)->first();
        $dateNaiss = $enfant->dateNaissance;

        $dateActuelle = Carbon::now()->toDateString();
        $diagnostic = Diagnostic::join('enfants', 'enfants.id_enfant', '=', 'diagnostics.enfant_id')->where('diagnostics.enfant_id', $id_enfant)->first();
        // dd($diagnostic);
        $parentt = Parentt::join('enfants', 'enfants.id_enfant', '=', 'parentts.enfant_id')->where('parentts.enfant_id', $id_enfant)->first();
        $firs = $parentt->id_parentt;
        $parent = Parentt::join('enfants', 'enfants.id_enfant', '=', 'parentts.enfant_id')->where('parentts.id_parentt', $firs + 1)->first();

        //$idcarsspecialiste=$diagnostic->carsspecialiste_id;
        //$carsspecialiste = Carsspecialiste::where('id_carsspecialiste', $idcarsspecialiste)->first();

        $arr['parentts'] = Parentt::all();
        $arr['$diagnostics'] = Diagnostic::all();
        $arr['enfants'] = Enfant::all();
        $calculeAge = Carbon::parse($dateNaiss)->age;
        //dd($calculeAge);
        return view('pagecarsspecialiste.diagnostics.affiche')->with(compact('calculeAge', 'parent', 'dateActuelle', 'enfant', 'parentt', 'diagnostic', 'carsspecialiste', 'dateActuelle'))->with($arr);
    }

    public function storeAffiche(Request $request, Diagnostic $diagnostic)
    {
        $this->validate($request,
            array(
                'nom' => 'required',
                'prenom' => 'required',
                'dateNaissance' => 'required',
                'autismresult' => 'required'
            )
        );
        // dd($request->all());
        $nomid = $request->enf_id;
        $prenomid = $request->enfant_id;
        $dateid = $request->enfa_id;
        $diagnostic->enfant_id = $prenomid;
        $diagnostic->id_superviseur = $request->trait;
        $nomSpecialiste = explode(' ', Auth::user()->name, 2); // Restricts it to only 2 values, for names like Billy Bob Jones

        $nomSpecialiste = User::where('name', 'LIKE', '%' . $nomSpecialiste . '%')
            ->first();
        $iduser = $nomSpecialiste->id;
        $specialiste = Carsspecialiste::join('users', 'users.id', '=', 'carsspecialistes.user_id')->where('carsspecialistes.user_id', $iduser)->first();
        $idSp = $specialiste->id_carsspecialiste;
        $diagnostic = Diagnostic::create([
            "enfant_id" => $prenomid,
            "id_superviseur" => $request->trait,
            "carsspecialiste_id" => $idSp,
            "dateDiagnostic" => $request->date,
            "remarque" => $request->remarque15,
            "niveau" => $request->autismresult
        ]);

        $responses = json_decode($request->responses);
        $questions = json_decode($request->questions);
        $remarques = json_decode($request->remarques);
        /* dd($questions); */
        for ($i = 1; $i <= 15; $i++) {
            $response = (array)$responses[$i - 1];
            $question = (array)$questions[$i - 1];
            $remarque = (array)$remarques[$i - 1];
            /* dd($response); */
            $details = new Detail();
            $details->reponses = $response['rText'];
            // $requestData['text'];
            //$requestData['r'.$i];
            $details->questions = $question['value'];
            $details->observations = $remarque['value'];
            $diagnostic->detail()->save($details);
        }
        return redirect()->route('pagecarsspecialiste.affiche', $prenomid)->with('success', 'تمت اضافة التشخيص بنجاح ');


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Diagnostic $diagnostic)
    {

        $arr['diagnostic'] = $diagnostic;
        $arr['enfant'] = $diagnostic->enfant_id;
        $enfant = enfant::find($arr['enfant']);
        $arr['enfant'] = $enfant;

        $arr['carsspecialiste'] = $diagnostic->carsspecialiste_id;
        $carsspecialiste = carsspecialiste::find($arr['carsspecialiste']);
        $arr['carsspecialiste'] = $carsspecialiste;

        $arr['detail'] =$diagnostic->id;
        $detail = Detail::join('diagnostics', 'diagnostics.id', '=', 'detail.diagnostic_id')->where('diagnostics.id',  $arr['detail'] )->get();
        $detail0=$detail->get(0);  $detail1=$detail->get(1);  $detail2=$detail->get(2);  $detail3=$detail->get(3);
        $detail4=$detail->get(4);  $detail5=$detail->get(5);  $detail6=$detail->get(6);  $detail7=$detail->get(7);
        $detail8=$detail->get(8);  $detail9=$detail->get(9);  $detail10=$detail->get(10);  $detail11=$detail->get(11);
        $detail12=$detail->get(12);  $detail13=$detail->get(13);  $detail14=$detail->get(14);
        $sumResponses=($detail0->numResponses+$detail1->numResponses+$detail2->numResponses+$detail3->numResponses+$detail4->numResponses+$detail5->numResponses+$detail6->numResponses+
       $detail7->numResponses+$detail8->numResponses+$detail9->numResponses+$detail10->numResponses+$detail11->numResponses+$detail12->numResponses+$detail13->numResponses+$detail14->numResponses);
        return view('pagecarsspecialiste.diagnostics.edit')->with(compact('carsspecialiste','enfant',
        'detail0','detail1','detail2','detail3','detail4','detail5','detail6','detail7','detail8','detail9','detail10','detail11','detail12','detail13','detail14','sumResponses'))->with($arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request, Diagnostic  $idDiagnostic)
    public function update(Request $request,$idDiagnostic)
    {

        $diagnostic= Diagnostic::findOrFail($idDiagnostic);
        $diagnostic->niveau = $request->autismresult;
        $diagnostic->save();
        $detail = Detail::join('diagnostics', 'diagnostics.id', '=', 'detail.diagnostic_id')->where('detail.diagnostic_id', $idDiagnostic)->get();
       $details=$detail->get(0);
      /*  $responses = json_decode($request->responses);
        $questions = json_decode($request->questions);
        $remarques = json_decode($request->remarques);
        /* dd($questions); */
       /* for ($i = 1; $i <= 15; $i++) {
            $response = (array)$responses[$i - 1];
            $question = (array)$questions[$i - 1];
            $remarque = (array)$remarques[$i - 1];

            $details = $details->get($i - 1);
            $details->reponses = $response['rText'];
            $details->numResponses =  $response['value'];
            // $requestData['text'];

            $details->questions = $question['value'];
            $details->observations = $remarque['value'];
            $diagnostic->detail()->save($details);
        }*/


        $responses = json_decode($request->responses);
        $questions = json_decode($request->questions);
        $remarques = json_decode($request->remarques);

            $response = (array)$responses[0];
            $question = (array)$questions[0];
            $remarque = (array)$remarques[0];

            $details->reponses = $response['rText'];
            $details->numResponses =  $response['value'];
            // $requestData['text'];

            $details->questions = $question['value'];
            $details->observations = $remarque['value'];
           // $diagnostic->detail()->save($details->get($i-1));


          $diagnostic->detail()->save($details);
           // $details->save();


        return redirect()->route('pagecarsspecialiste.diagnostic.index')->with('success', 'تمت عملية التعديل بنجاح ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //search
    /* function action(Request $request)
     {
         if($request->ajax())
         {
             $output = '';
             $query = $request->get('query');
             if($query != '')
             {
                 $data = DB::table('enfants')
                     ->where('nom', 'like', '%'.$query.'%')
                    // ->orWhere('prenom', 'like', '%'.$query.'%')
                     //->orWhere('sexe', 'like', '%'.$query.'%')
                     //->orWhere('image', 'like', '%'.$query.'%')
                    // ->orderBy('enfant_id', 'desc')
                     ->get();

             }
             else
             {
                 $data = DB::table('enfants')
                     ->orderBy('id_enfant', 'desc')
                     ->get();
             }
             $total_row = $data->count();
             if($total_row > 0)
             {
                 foreach($data as $row)
                 {
                     $output .= '

          <tr >

          <td  width="6%">'.$row->image.'</td>
          <td  width="46%">'.$row->nom.'</td>
          <td  width="36%">'.$row->prenom.'</td>
          <td  width="26%">'.$row->sexe.'</td>
         </tr>
         ';
                 }
             }
             else
             {
                 $output = '
        <tr>
         <td align="center" colspan="5">No Data Found</td>
        </tr>
        ';
             }
             $data = array(
                 'table_data'  => $output,
                 'total_data'  => $total_row
             );

             echo json_encode($data);


         }
     }*/

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = "";

            $enfants = DB::table('enfants')->where('nom', 'LIKE', '%' . $request->search . "%")->get();
            if ($enfants) {
                foreach ($enfants as $key => $enfant) {
                    $output .= '<tr>' .
                        '<td>' . $enfant->id - enfant . '</td>' .
                        '<td>' . $enfant->nom . '</td>' .
                        '<td>' . $enfant->prenom . '</td>' .
                        '<td>' . $enfant->sexe . '</td>' .
                        '</tr>';
                }
                return Response($output);
            }
        }
    }


}
