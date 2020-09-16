<?php

namespace App\Http\Controllers\Traitant;
use App\Enfant;
use App\Notification;
use App\Notificationtrait;
use App\Parentt;
use App\Traitant;
use App\Seancetraitement;
use Cassandra\FutureRows;
use Cassandra\Rows;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use mysql_xdevapi\RowResult;
use Session;

class NotificationController extends Controller
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
        $arr['notificationtraits']=Notificationtrait::all();
        return view('pagetraitant.seancetraitements')->with($arr);
    }


    public function update(Request $request,Parentt $parentt)
    {

    }


    public function destroy(Parentt $parentt)
    {
        $idf= $parentt->enfant_id;
        Parentt::destroy($idf);
        $enfant=Enfant::find($idf);
        $enfant->delete();
        return redirect()->route('pagetraitant.parentts.index')->with('success','تمت عملية الحذف بنجاح '); ;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

}
