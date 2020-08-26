@extends('layouts.specialistes')

@section('title','|بيانات التشخيص')

@section('content')
    <head>
        <script>
            function printContent(el){
                var restorepage = document.body.innerHTML;
                var printcontent = document.getElementById(el).innerHTML;
                document.body.innerHTML = printcontent;
                window.print();
                document.body.innerHTML = restorepage;
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



                <form >
                    <!-- /.card-header -->

                    <div class="row">
                        <div class="col-md-3">

                            <!-- Profile Image -->
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">

                                    <div class="tab-content">

                                        <div class="active tab-pane" id="child">
                                            <div class="post">
                                                <div class="text-center">
                                                    <div class="card-header">

                                                        <div class="well">
                                                            <div class="form-group" >
                                                                <dl class="dl-horizontal" >
                                                                    <dt >التاريخ :</dt>
                                                                    <dd>{{ date('M j, Y h:ia', strtotime($diagnostic->created_at)) }}</dd>
                                                                </dl>
                                                            </div>

                                                            <dl class="dl-horizontal" >
                                                                <dt>اخر تعديل:</dt>
                                                                <dd >{{ date('M j, Y h:ia', strtotime($diagnostic->updated_at)) }}</dd>
                                                            </dl>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    {!! Html::linkRoute('pagecarsspecialiste.diagnostics.edit', 'تعديل', array($diagnostic->id), array('class' => 'btn btn-primary btn-block')) !!}
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    {!! Html::linkRoute('pagecarsspecialiste.affiche', 'رجوع>>',array($enfant->id_enfant), array('class' => 'btn btn-default btn-block btn-h1-spacing')) !!}
                                                                </div>

                                                            </div>
                                                            <br>
                                                            <div class="col-sm-6">
                                                                <button style="margin-right: 50px" onclick="printContent('div1')"> <i class="fa fa-print"></i>طباعة</button>
                                                            </div>
                                                            <br>


                                                        </div>

                                                    </div>
                                                </div>


                                                <ul class="list-group list-group-unbordered mb-3">

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

                        <div class="col-md-9" id="div1">

                            <div class="card">
                                <ul class="navbar-nav mr-auto">
                                    <!-- Messages Dropdown Menu -->
                                    <img src="{{ asset('dist/img/logoautisme.png')}}" >

                                </ul>
                                <div class="card-header p-2">
                                    <div class="tab-content">
                                        <div class="row">

                                            <div class="col-md-12">
                                              <div class="text-center">
                                                <img src="{{ asset('storage/enfants/'.$enfant->image) }}" class="center" style="border-radius: 8px;width: 150px;"/>
                                              </div>
                                                <div style="margin-right: 50px;">
                                                    <br><br><br>
                                                    <i class="fa fa-paperclip"></i> <label>  المعلومات الخاصة:</label>
                                                    <div class="form-group" ><label> الإسم الكامل :</label>    {{$enfant->nom}} {{$enfant->prenom}}</div>
                                                    <div class="form-group"><label>العمر  :</label>{{ $age}} {{"سنة"}}</div>
                                                    <div class="form-group"><label>  الجنس :</label>{{$enfant->sexe}}</div>
                                                    <div class="form-group"><label>زمرة الدم:</label>{{ $enfant->groupage}}</div>
                                                    <div class="form-group"><label> العنوان:</label>{{ $enfant->domicile}}{{"-"}} {{ $enfant->commune}}{{"-"}} {{ $enfant->wilaya}}</div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                    <div class="form-group"><label> ابن(ة):</label>{{$parent->prenomp}}</div>
                                                        </div>
                                                            <div class="col-md-6">
                                                    <div class="form-group"><label> رقم الهاتف الاب:</label>{{$parent->numTel}} </div>
                                                            </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                    <div class="form-group"><label> وابن(ة):</label>{{$parentt->prenomp}} {{$parentt->nomp}} </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                        <div class="form-group"><label> رقم الهاتف الام:</label>{{$parentt->numTel}} </div>
                                                        </div></div>
                                                    <i class="fa fa-paperclip"></i> <label>  معلومات كارز:</label>
                                                    <div class="form-group"><label> المشرفة  :</label>
                                                        @foreach($carsspecialistes as $t   )
                                                            @if($diagnostic->carsspecialiste_id==$t->id_carsspecialiste)
                                                                <td value="{{$t->id_carsspecialiste}}">{{'الدكتور(ة)'}} {{ $t->prenom}} {{ $t->nom}}  </td>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                    <div class="form-group"><label> تاريخ تطبيق المقياس  :</label>{{$diagnostic->dateDiagnostic}}</div>

                                                </div>
                                                    <div class="row">
                                                        <div class="col-md-6"><div class="form-group"><label class="container">{{$question}} :</label></div>
                                                            <div class="form-group"><label class="container"> =>{{$reponse0}}</label></div></div>
                                                        <div class="col-md-6"><div class="form-group"><label class="container">{{$question1}} :</label></div>
                                                            <div class="form-group"><label class="container">=> {{$reponse1}}</label></div></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6"><div class="form-group"><label class="container">{{$question2}} :</label></div>
                                                            <div class="form-group"><label class="container"> =>{{$reponse2}}</label></div></div>
                                                        <div class="col-md-6"><div class="form-group"><label class="container">{{$question3}} :</label></div>
                                                            <div class="form-group"><label class="container"> =>{{$reponse3}}</label></div></div>
                                                    </div>
                                                    <div class="row">

                                                        <div class="col-md-6"><div class="form-group"><label class="container">{{$question14}} :</label></div>
                                                            <div class="form-group"><label class="container"> =>{{$reponse14}}</label></div></div>

                                                        <div class="col-md-6"><div class="form-group"><label class="container">{{$question5}} :</label></div>
                                                            <div class="form-group"><label class="container"> =>{{$reponse5}}</label></div></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6"><div class="form-group"><label class="container">{{$question6}} :</label></div>
                                                            <div class="form-group"><label class="container"> =>{{$reponse6}}</label></div></div>
                                                        <div class="col-md-6"><div class="form-group"><label class="container">{{$question7}} :</label></div>
                                                            <div class="form-group"><label class="container"> =>{{$reponse7}}</label></div></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6"><div class="form-group"><label class="container">{{$question8}} :</label></div>
                                                            <div class="form-group"><label class="container"> =>{{$reponse8}}</label></div></div>
                                                        <div class="col-md-6"><div class="form-group"><label class="container">{{$question9}} :</label></div>
                                                            <div class="form-group"><label class="container"> =>{{$reponse9}}</label></div></div>
                                                    </div>
                                                      <div class="row">
                                                        <div class="col-md-6"><div class="form-group"><label class="container">{{$question10}} :</label></div>
                                                            <div class="form-group"><label class="container"> =>{{$reponse10}}</label></div></div>
                                                        <div class="col-md-6"><div class="form-group"><label class="container">{{$question11}} :</label></div>
                                                            <div class="form-group"><label class="container"> =>{{$reponse11}}</label></div></div>
                                                    </div>
                                                         <div class="row">
                                                        <div class="col-md-6"><div class="form-group"><label class="container">{{$question12}} :</label></div>
                                                            <div class="form-group"><label class="container"> =>{{$reponse12}}</label></div></div>
                                                        <div class="col-md-6"><div class="form-group"><label class="container">{{$question13}} :</label></div>
                                                            <div class="form-group"><label class="container"> =>{{$reponse13}}</label></div></div>
                                                    </div>
                                                    <div class="row">

                                                        <div class="col-md-6"><div class="form-group"><label class="container">{{$question4}} :</label></div>
                                                            <div class="form-group"><label class="container"> =>{{$reponse4}}</label></div></div>
                                                    </div>


                                                    <div class="text-center" >  <label > ========================= النتيجة  :</label>{{$diagnostic->niveau}}<label >====================</label ></div>
                                                    <footer>
                                                        <p class="text-center">2020 &copy;رانا معاك</p>

                                                    </footer>

                                            </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                            </div>







                </form></div></section></div>




    <!-- /.col (right) -->




    <!-- /.row -->



    <script type="text/javascript">
        function divPrint() {
            // Some logic determines which div should be printed...
            // This example uses div3.
            $("#div3").addClass("printable");
            window.print();
        }
    </script>

    <!-- select -->

    <!-- select-->
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('https://code.jquery.com/ui/1.12.1/jquery-ui.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.js')}}"></script>



@endsection
