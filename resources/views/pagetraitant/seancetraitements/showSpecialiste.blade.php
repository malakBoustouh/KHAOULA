@extends('layouts.traitants')

@section('title','| ملف الشخصي')

@section('content')
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
                <!-- left column -->
                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->

                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">البيانات</h3>
                    </div>

                    <!-- /.card-header -->
                    <form >
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group" >
                                        <i class="fa fa-child"></i><label> الإسم الكامل :</label>{{$enfant->nom}} {{$enfant->prenom}}
                                    </div>
                                    <div class="form-group">

                                        <i class="fa fa-calendar"></i><label>تاريخ الميلاد  :</label>{{$enfant->dateNaissance}}

                                    </div>
                                    <div class="form-group">

                                        <i class="fa fa-intersex" style="font-size:20px"></i><label>  الجنس :</label>{{$enfant->sexe}}

                                    </div>
                                    <div class="form-group">

                                        <i class="fa fa-calendar"></i>  <label> تاريخ تطبيق المقياس  :</label>{{$diagnostic->date}}

                                    </div>
                                    <div class="form-group">
                                        <i class="fa fa-user-md" style="font-size:24px"></i>  <label> المشرفة  :</label>
                                        @foreach($specialistes as $t   )
                                            @if($diagnostic->specialiste_id==$t->id_specialiste)
                                                <td value="{{$t->id_specialiste}}">{{'الدكتور(ة)'}} {{ $t->prenom}} {{ $t->nom}}  </td>
                                            @endif
                                        @endforeach
                                    </div>

                                    <div class="form-group">

                                        <i class="fa fa-commenting-o" ></i> <label > النتيجة  :</label>{{$diagnostic->niveau}}


                                    </div>
                                </div>


                                <div class="col-md-6">

                                    <div class="card bg-light mb-3" style="max-width: 18rem;margin-right: 260px;">

                                        <div class="card-header">

                                            <div class="well">
                                                <div class="form-group" >
                                                    <dl class="dl-horizontal" >
                                                        <dt >بتاريخ :</dt>
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
                                                        {!! Html::linkRoute('pagetraitant.show2', 'رجوع>>',array($enfant->id_enfant), array('class' => 'btn btn-default btn-block btn-h1-spacing')) !!}

                                                    </div>
                                                </div>
                                                <br>


                                            </div>

                                        </div>

                                    </div>



                                </div>
                                <!-- /.row -->
                            </div>
                        </div>
                    </form>  </div><!-- /.container-fluid -->

                        <div></div>
            </div>


            <!-- /.content -->
                </div></div></section>
    </div>





    <!-- select -->




@endsection
