<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Enfant;
use Charts;
use DB;
class CharrtController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        /*pie chart sexe*/
        $data = DB::table('enfants')
            ->select(
                DB::raw('sexe as sexe'),
                DB::raw('count(*) as number'))
            ->groupBy('sexe')
            ->get();
        $array[] = ['Sexe', 'Number'];
        foreach($data as $key => $value)
        {
            $array[++$key] = [$value->sexe, $value->number];
        }
        /*pie methode seance traitement*/
        $dataMethode = DB::table('seanceTraitements')
            ->select(
                DB::raw('methode as methode'),
                DB::raw('count(*) as number'))
            ->groupBy('methode')
            ->get();
        $arrayMethode[] = ['Methode', 'Number'];
        foreach($dataMethode as $key => $value)
        {
            $arrayMethode[++$key] = [$value->methode, $value->number];
        }


        /*pie chart female*/
        $data_female = \App\Diagnostic::join('enfants', 'diagnostics.enfant_id', '=', 'id_enfant')
            ->selectRaw("niveau As female,count(*) as number")
            ->where('sexe','=','أنثى')
            ->groupBy('female')
            ->get();
        $arfemale[] = ['Female', 'Number'];
        foreach($data_female as $key => $value)
        {
            $arfemale[++$key] = [$value->female, $value->number];
        }

        /*pie chart male*/
        $data_male = \App\Diagnostic::join('enfants', 'diagnostics.enfant_id', '=', 'id_enfant')
            ->selectRaw("niveau As male,count(*) as number")
            ->where('sexe','=','ذكر')
            ->groupBy('male')
            ->get();
        $armale[] = ['Female', 'Number'];
        foreach($data_male as $key => $value)
        {
            $armale[++$key] = [$value->male, $value->number];
        }



       /* $visitor = DB::table('visitor')
            ->select(
                DB::raw("year(created_at) as year"),
                DB::raw("SUM(click) as total_click"),
                DB::raw("SUM(viewer) as total_viewer"))
            ->orderBy("created_at")
            ->groupBy(DB::raw("year(created_at)"))
            ->get();


        $result[] = ['Year','Click','Viewer'];
        foreach ($visitor as $key => $value) {
            $result[++$key] = [$value->year, (int)$value->total_click, (int)$value->total_viewer];
        }*/

        /*pie chart niveau*/
        $data_niveau = DB::table('diagnostics')
            ->select(
                DB::raw('niveau as niveau'),
                DB::raw('count(*) as number'))
            ->groupBy('niveau')
            ->get();
        $ar[] = ['Niveau', 'Number'];
        foreach($data_niveau as $key => $value)
        {
            $ar[++$key] = [$value->niveau, $value->number];
        }

        /*chart year */
        $dta = DB::table('enfants')
            ->select( DB::raw("year(created_at) as year"),
                DB::raw('count(*) as num')
                )
            ->groupBy(DB::raw("year(created_at)"))
            ->get();

        $arra[] = ['Year', 'عدد المصابين'];
        foreach($dta as $key => $value)
        {
            $arra[++$key] = [(string)$value->year, (int)$value->num];

        }

        /*chart year  DIAGNOSTIC*/
        $dtayear = DB::table('seancetraitements')
            ->select(
                DB::raw('dateTraite as dateMonth'),
                DB::raw('count(*) as number'))
            ->groupBy('dateMonth')
            ->get();
        $arrayear[] = ['DateMonth', 'عدد المصابين'];
        foreach($dtayear as $key => $value)
        {
            $arrayear[++$key] = [$value->dateMonth, (int)$value->number];

        }
             /*chart year actuelle*/
        $chart_Month = Enfant::where(DB::raw("DATE_FORMAT(created_at,'%Y')"),date('Y'))->get();
        $chart = Charts::database( $chart_Month, 'bar', 'highcharts')
            ->title("احصائيات السنة الحالية")
            ->elementLabel("عدد الاطفال  ")
            ->dimensions(1000, 500)
            ->responsive(false)
            ->groupByMonth(date('Y'));
        /*chart Age*/
        //$calculeAge=Carbon::parse($enfant->dateNaissance);
        $chartYear =  \DB::table('enfants')
            ->select( DB::raw('concat(2*floor(TIMESTAMPDIFF(YEAR,enfants.dateNaissance,CURDATE())/2), \'-\', 2*floor(TIMESTAMPDIFF(YEAR,enfants.dateNaissance,CURDATE())/2) + 1) as `range`, count(*) as `numberofusers`'))
           ->orderby('range','asc')
            ->groupBy('range')
            ->get();
        $arraAge[] = [' Range', 'عدد المصابين'];
        foreach($chartYear as $key => $value)
        {
            $arraAge[++$key] = [$value->range,(int) $value->numberofusers];
        }

        /*$chart_Age = Enfant::where(DB::raw('TIMESTAMPDIFF(YEAR,enfants.dateNaissance,CURDATE())'))->first();

        $chartAge = Charts::database( $chart_Age, 'bar', 'highcharts')
            ->title("احصائيات السنة الحالية")
            ->elementLabel("عدد الاطفال  ")
            ->dimensions(1000, 500)
            ->responsive(false)
            ->groupByAge('age');*/
        return view('admin.chart.index',compact('chart','chartAge'))->with('methode', json_encode($arrayMethode))->with('sexe', json_encode($array))->with('dateMonth', json_encode( $arrayear))->with('male', json_encode($armale))->with('female', json_encode($arfemale))->with('niveau', json_encode($ar))->with('year', json_encode($arra))->with('range', json_encode($arraAge));
    }


}
