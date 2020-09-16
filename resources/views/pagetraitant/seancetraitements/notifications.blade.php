@extends('layouts.traitants')
@section('title','| ملف الطفل')
@section('content')
    <head>
        <script src="{{ asset('https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('https://www.gstatic.com/charts/loader.js')}}"></script>
        <script type="text/javascript">
            var analytics = <?php echo $month; ?>

            google.charts.load('current', {'packages':['corechart']});

            google.charts.setOnLoadCallback(drawChart);

            function drawChart()
            {
                var data = google.visualization.arrayToDataTable(analytics);
                var options = {
                    title : 'منحنى تطور حالة الطفل في الحصص خلال العام',
                    hAxis: {
                        title: 'اشهر'
                    },
                    vAxis: {
                        title: 'التقييم'
                    },
                    backgroundColor: '#f1f8e9'
                };


                var chart = new google.visualization.LineChart(document.getElementById('line_chart'));
                chart.draw(data, options);
            }
        </script>
        <script type="text/javascript">
            var analyticsdatejanvier = <?php echo $datejanvier; ?>

            google.charts.load('current', {'packages':['corechart']});

            google.charts.setOnLoadCallback(drawChart);

            function drawChart()
            {
                var datadatejanvier = google.visualization.arrayToDataTable(analyticsdatejanvier);
                var options = {
                    title : 'منحنى تطور حالة الطفل في الحصص خلال شهر جانفي',
                    hAxis: {
                        title: 'شهر جانفي'
                    },
                    vAxis: {
                        title: 'التقييم'
                    },
                    backgroundColor: '#f1f8e9'
                };


                var chart = new google.visualization.LineChart(document.getElementById('line_chartdatejanvier'));
                chart.draw(datadatejanvier, options);
            }
        </script>
    </head>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#child" data-toggle="tab"> الطفل</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#parents" data-toggle="tab">بيانات الأولياء</a></li>
                                </ul>
                                <div class="tab-content">

                                    <div class="active tab-pane" id="child">
                                        <div class="post">
                                            <div class="text-center">
                                                @if($enfant->image)
                                                    <img src="{{ asset('storage/enfants/'.$enfant->image) }}" class="profile-user-img img-fluid img-circle"/>
                                                @else
                                                    <img class="profile-user-img img-fluid img-circle"
                                                         src="{{asset('dist/img/child1.jpg')}}"
                                                         alt="صورة الطفل">
                                                @endif
                                            </div>

                                            <h3 class="profile-username text-center childname">{{$enfant->prenom}} {{$enfant->nom}}</h3>
                                            <ul class="list-group list-group-unbordered mb-3">
                                                <li class="list-group-item">
                                                    <b>الجنس:</b> <a>{{ $enfant->sexe}}</a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>العمر:</b> <a>{{$age}} {{"سنة"}}</a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>زمرة الدم:</b> <a>{{ $enfant->groupage}}</a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b> العنوان:</b> <a>{{ $enfant->domicile}}{{"-"}} {{ $enfant->commune}}{{"-"}} {{ $enfant->wilaya}} </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="parents">
                                        <div class="post">
                                            <div>
                                                <p></p>
                                            </div>
                                            <div class="text-center">
                                                @if($parentt->img)

                                                    <img src="{{ asset('storage/familles/'.$parentt->img) }}" class="profile-parents-img img-fluid img-circle" alt="صورة الأب">
                                                @else
                                                    <img class="profile-parents-img img-fluid img-circle"
                                                         src="{{asset('dist/img/dad.jpg')}}"
                                                         alt="صورة الأب">
                                                @endif
                                            </div>
                                            <p></p>
                                            <ul class="list-group list-group-unbordered mb-3">
                                                <li class="list-group-item">
                                                    @if($parentt->enfant_id==$enfant->id_enfant)
                                                        <b>الأب:</b> <a>{{$parentt->prenomp}} </a>
                                                    @endif
                                                </li>
                                                <li class="list-group-item">
                                                    <b>رقم الهاتف:</b> <a>{{$parentt->numTel}}</a>
                                                </li>
                                            </ul>

                                            <div class="text-center">
                                                @if($parent->img)
                                                    <img src="{{ asset('storage/familles/'.$parent->img) }}" class="profile-parents-img img-fluid img-circle" >
                                                @else
                                                    <img  class="profile-parents-img img-fluid img-circle"
                                                          src="{{asset('dist/img/mom.jpg')}}"
                                                          alt="صورةالأم">
                                                @endif
                                            </div>
                                            <p></p>
                                            <ul class="list-group list-group-unbordered mb-3">
                                                <li class="list-group-item">
                                                    <b>الأم:</b> <a>{{$parent->prenomp}} {{$parent->nomp}}</a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>رقم الهاتف:</b> <a>{{$parent->numTel}}</a>
                                                </li>
                                            </ul>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->


                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">

                            <div class="card-header p-2">

                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" style="margin-right: 10px;width: 110px" class="form-control float-right" placeholder="بحث">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link " href="#prise" data-toggle="tab"> حصص المعالجة</a></li>
                                    <li class="nav-item"><a class="nav-link " href="#diagnostic" data-toggle="tab">التشخيص</a></li>
                                    <li class="nav-item"><a class="nav-link active" href="#remarque" data-toggle="tab">ملاحظات الاباء</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#statistique" data-toggle="tab">احصائيات</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#traite" data-toggle="tab" >إضافة حصة معالجة</a></li>


                                </ul>

                                <div class="card-body">

                                </div><!-- /.card-header -->

                                <div class="tab-content">
                                    <div class=" tab-pane" id="diagnostic">
                                        <div class="post">
                                            <div class="card">
                                                <div class="card-body table-responsive p-0">
                                                    @if ($message = Session::get('success'))
                                                        <div class="alert alert-success">
                                                            <p>{{ $message }}</p>
                                                        </div>
                                                    @endif
                                                    <table class="table table-hover">
                                                        <tr>
                                                            <th>التاريخ</th>
                                                            <th>المختص(ة)</th>
                                                            <th>المشرف(ة)</th>
                                                            <th>النتيجة</th>
                                                        </tr>
                                                        @if(count($diagnostic))
                                                            @foreach($diagnostics as $h   )
                                                                @if($enfant->id_enfant==$h->enfant_id)
                                                                    <tr class='clickable-row'  data-href="{{route('affiche',$h->id)}}"  style="cursor: pointer;">
                                                                        <td>{{$h->dateDiagnostic}}</td>
                                                                        @foreach($carsspecialistes as $t   )
                                                                            @if($h->carsspecialiste_id==$t->id_carsspecialiste)
                                                                                <td value="{{$t->id_carsspecialiste}}">{{'الدكتور(ة)'}} {{ $t->prenom}} {{ $t->nom}}  </td>
                                                                            @endif
                                                                        @endforeach
                                                                        @foreach($carsspecialistes as $t   )
                                                                            @if($h->carsspecialiste_id==$t->id_carsspecialiste)
                                                                                <td value="{{$t->id_carsspecialiste}}">{{'الدكتور(ة)'}} {{ $t->prenom}} {{ $t->nom}}  </td>
                                                                            @endif
                                                                        @endforeach
                                                                        <td>{{$h->niveau}}</td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            <tr><td colspan="7">لا يوجد معالجة</td></tr>
                                                        @endif
                                                    </table>

                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                    </div>
                                    <div class=" tab-pane" id="prise">
                                        <div class="post">
                                            <div class="card">
                                                <div class="card-body table-responsive p-0">
                                                    <table class="table table-hover">
                                                        <tr>
                                                            <th>التاريخ</th>
                                                            <th>المختص(ة)</th>
                                                            <th>المدة</th>
                                                            <th>الطريقة المستعملة</th>
                                                            <th>التقييم</th>
                                                            <th>التعليق</th>
                                                            <th>الوصف</th>




                                                        </tr >
                                                        @if(count($seancetraitement))

                                                            @foreach($seancetraitements as $s   )
                                                                @if($enfant->id_enfant==$s->enfant_id)
                                                                    <tr  data-href="{{route('pagetraitant.seancetraitements.edit',$s->id)}}"  style="cursor: pointer;">
                                                                        <td>{{ $s->dateTraite}}</td>
                                                                        @foreach($traitants as $t   )
                                                                            @if($s->traitant_id==$t->id_traitant)
                                                                                <td value="{{$t->id_traitant}}">{{'الدكتور(ة)'}} {{ $t->prenom}} {{ $t->nom}}  </td>
                                                                            @endif
                                                                        @endforeach

                                                                        <td>{{ $s->duree}}</td>
                                                                        <td>{{ $s->methode}}</td>
                                                                        <td>{{ $s->note}}</td>
                                                                        <td>{{ $s->commentaire}}</td>
                                                                        <td>{{ $s->description}}</td>



                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            <tr><td colspan="7">لا يوجد معالجة</td></tr>
                                                        @endif

                                                    </table>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="active tab-pane" id="remarque">
                                        <div class="post">
                                            <div class="card">
                                                <div class="card-body table-responsive p-0">
                                                    <table class="table table-hover">
                                                        <tr>
                                                            <th>التاريخ</th>
                                                            <th>الملاحظة</th>




                                                        </tr >
                                                        @if(count($remarque))


                                                            <tr >
                                                                <td>{{ $remarque->dateRemarque}}</td>
                                                                <td>{{$remarque->detail}}</td>

                                                            </tr>

                                                        @else
                                                            <tr><td colspan="7">لا توجد ملاحظة</td></tr>
                                                        @endif

                                                    </table>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="statistique">
                                        <div class="post">

                                            <br><br>
                                            <div class="row">

                                                <div class="col-md-6" >
                                                    <a  style="margin-right: 80px" href="{{route('charrt',$enfant->id_enfant)}}" class="btn btn-info" >احصائيات التطور في الحصص </a>

                                                </div>
                                                <div class="col-md-6" >
                                                    <button  class="btn btn-info"  data-toggle="modal" data-target="#seance">احصائيات التطور في الالعاب التعليمية</button>
                                                </div>

                                            </div>
                                            <br><br>




                                        </div></div>
                                    <div class="tab-pane" id="traite">
                                        <div class="card">
                                            <div class="card-body table-responsive p-0">
                                                <div class="card-header">
                                                    <h3 class="card-title">المعلومات</h3>
                                                </div>
                                                <form method="post" action="{{route('pagetraitant.seancetraitements.store')}}" enctype="multipart/form-data">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <!-- /.card-header -->

                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-6">


                                                                <div class="form-group">
                                                                    <label>اللقب :</label>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                                        </div>
                                                                        <select   class="form-control" style="width: 325px" id="named" name="enfant_id" >
                                                                            <option ></option>

                                                                            <option  value="{{$enfant->id_enfant}}" selected readonly>{{$enfant->prenom}}</option>
                                                                        </select>

                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>تاريخ الحصة :</label>

                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>


                                                                        </div>
                                                                        <input type="date" class="form-control" readonly name="dateTraite" value="{{$dateActuelle}}" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask>

                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label> الطريقة المستعملة:</label>
                                                                    <select class="form-control" name="methode">
                                                                        <option methode="TEACCH"> TEACCH</option>
                                                                        <option methode="ABA"> ABA</option>
                                                                        <option methode="PECS"> PECS</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>
                                                                        التعليق :
                                                                    </label>
                                                                    <textarea class="remarquearea" rows="3,5" style="width: 365px" cols="58,5"  name="commentaire" placeholder="لا يوجد"></textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>
                                                                        نصائح للوالدين :
                                                                    </label>
                                                                    <textarea class="remarquearea" rows="3,5" style="width: 365px" cols="58,5" name="conseils" placeholder="لا توجد"></textarea>
                                                                </div>
                                                            </div>
                                                            <!-- /.col -->
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>الإسم :</label>
                                                                    <div class="input-group" >
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                                        </div>
                                                                        <select   style="width: 325px" id="nameid" name="enf_id" >
                                                                            <option></option>
                                                                            <option value="{{$enfant->id_enfant}}" selected readonly>{{$enfant->nom}}</option>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">

                                                                    <label> مدة الحصة :</label>

                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i class="fa fa-clock-o"></i></span>

                                                                        </div>
                                                                        <input type="text" class="form-control" name="duree">

                                                                    </div>
                                                                </div>
                                                                <div class="form-group">

                                                                    <label> التقييم :</label>

                                                                    <div class="input-group">
                                                                        <select class="form-control" name="note">
                                                                            <option note="1">1</option>
                                                                            <option note="2">2</option>
                                                                            <option note="3">3</option>
                                                                            <option note="4">4</option>
                                                                            <option note="5">5</option>
                                                                            <option note="6">6</option>
                                                                            <option note="7">7</option>
                                                                            <option note="8">8</option>
                                                                            <option note="9">9</option>
                                                                            <option note="1O">10</option>
                                                                        </select>

                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>
                                                                        الوصف :
                                                                    </label>
                                                                    <textarea class="remarquearea" rows="13" style="width: 365px"  cols="58" name="description" placeholder="لا يوجد"></textarea>
                                                                </div>

                                                            </div>
                                                            <!-- /.col (right) -->

                                                        </div>
                                                        <!-- /.row -->

                                                    </div><!-- /.container-fluid -->
                                                    <div class="card ">
                                                        <button type="submit" class="btn btn-primary" >حفظ</button>
                                                    </div>
                                                </form></div>

                                        </div>




                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>



                </div></div>
            <!-- Modal -->
            <div class="modal fade" id="seance" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" style="margin-left: 4px;" id="myModalLabel"> الالعاب </h4>

                            <button type="button" style="margin-right: 370px;" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>

                        <br><br>
                        <div class="modal-body">
                            <div class="panel-body" align="center">
                                <a  class="btn  btn-success" style="width: 150px"  href="{{route('quizJobs',$enfant->id_enfant)}}"  >كويز المهن</a>
                                <br><br>
                                <a  class="btn  btn-success" style="width: 150px"  href="{{route('quizAnimals',$enfant->id_enfant)}}" >كويز الحيوانات</a>
                                <br><br>
                                <a  class="btn  btn-success" style="width: 150px"  href="{{route('quizColors',$enfant->id_enfant)}}"  >كويز الالوان</a>
                                <br><br>
                                <a  class="btn  btn-success" style="width: 150px"  href="{{route('quizFormes',$enfant->id_enfant)}}"  >كويز الاشكال</a>
                                <br><br>
                                <a  class="btn  btn-success" style="width: 150px"  href="{{route('quizFruits',$enfant->id_enfant)}}"  >كويز الفواكه</a>
                                <br><br>
                                <a  class="btn  btn-success" style="width: 150px"  href="{{route('quizDirections',$enfant->id_enfant)}}"  >كويز الاتجاهات</a>
                                <br><br>
                                <a  class="btn  btn-success" style="width: 150px"  href="{{route('memoryGame',$enfant->id_enfant)}}"  >كويز لعبة الذاكرة</a>
                            </div></div>
                        <br><br>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>

                        </div>

                    </div>
                </div>
            </div>
        </section></div>

    <!-- /.content -->


    <!-- ./wrapper -->
    <script>
        jQuery(document).ready(function($) {
            $(".clickable-row").click(function() {
                window.location = $(this).data("href");
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded",()=>{
            const rows=document.querySelectorAll("tr[data-href]");
            rows.forEach(row=>{
                row.addEventListener("click",()=>{
                    window.location.href=row.dataset.href;
                });

            });
        });

        /* $(document).ready(function () {
             $(document.body).on("click","tr[data-href]",function () {
                 window.location.href=this.dataset.href;

             });

         });*/
    </script>
    <script src="{{asset('//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js')}}"></script>
    <script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js')}}"></script>
    <script type="text/javascript">

        $("#nameid").select2({
            placeholder: "اختر ",
            allowClear: false
        });
    </script>
    <script type="text/javascript">

        $("#named").select2({
            placeholder: "اختر ",
            allowClear: false
        });
    </script>


    <!-- jQuery -->


@endsection
