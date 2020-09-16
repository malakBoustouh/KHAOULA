@extends('layouts.traitants')

@section('title','| حصة معالجة')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">المعلومات</h3>
                    </div>


                    <form >

                        <!-- /.card-header -->

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">


                                    <div class="form-group">
                                        <i class="fa fa-user"></i>  <label> الاسم و اللقب :</label>   {{$enfant->prenom}}  {{$enfant->nom}}
                                        <div class="input-group">

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <i class="fa fa-intersex" style="font-size:20px"></i> <label>الجنس:</label> {{$enfant->sexe}}
                                    </div>
                                    <div class="form-group">
                                        <i class="fa fa-calendar"></i> <label>تاريخ الميلاد :</label> {{$enfant->dateNaissance}}
                                    </div>
                                    <div class="form-group">
                                        <i class="fa fa-user-md" style="font-size:24px"></i> <label> المعالج  :</label>
                                        @foreach($traitants as $t   )
                                            @if($seancetraitement->traitant_id==$t->id_traitant)
                                                <td value="{{$t->id_traitant}}">{{'الدكتور(ة)'}} {{ $t->prenom}} {{ $t->nom}}  </td>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <i class="fa fa-calendar"></i> <label>تاريخ الحصة :</label> {{$seancetraitement->dateTraite}}
                                    </div>
                                    <div class="form-group">
                                        <label> الطريقة المستعملة:</label>
                                        {{$seancetraitement->methode}}
                                    </div>
                                    <div class="form-group">

                                        <i class="fa fa-clock-o"></i>  <label> مدة الحصة :</label> {{$seancetraitement->duree}}

                                    </div>

                                    <div class="form-group">
                                        <label>
                                            التعليق :
                                        </label>
                                        <textarea class="remarquearea" rows="3,5" cols="58,5" name="commentaire"> {{$seancetraitement->commentaire}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            نصائح للوالدين :
                                        </label>
                                        <textarea class="remarquearea" rows="3,5" cols="58,5" name="conseils" > {{$seancetraitement->conseils}}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>
                                            الوصف :
                                        </label>
                                        <textarea class="remarquearea" rows="13" cols="58" name="description">{{$seancetraitement->description}}</textarea>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">

                                    <div class="card bg-light mb-3" style="max-width: 18rem;margin-right: 260px;">

                                        <div class="card-header">

                                            <div class="well">
                                                <div class="form-group" >
                                                    <dl class="dl-horizontal" >
                                                        <dt >بتاريخ :</dt>
                                                        <dd>{{ date('M j, Y h:ia', strtotime($seancetraitement->created_at)) }}</dd>
                                                    </dl>
                                                </div>

                                                <dl class="dl-horizontal" >
                                                    <dt>اخر تعديل:</dt>
                                                    <dd >{{ date('M j, Y h:ia', strtotime($seancetraitement->updated_at)) }}</dd>
                                                </dl>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        {!! Html::linkRoute('pagetraitant.seancetraitements.edit', 'تعديل', array($seancetraitement->id), array('class' => 'btn btn-primary btn-block')) !!}
                                                    </div>
                                                    <div class="col-sm-6">
                                                        {!! Html::linkRoute('pagetraitant.dossierEnfants.show', 'رجوع>>',array($enfant->id_enfant), array('class' => 'btn btn-default btn-block btn-h1-spacing')) !!}

                                                    </div>
                                                </div>
                                                <br>


                                            </div>

                                        </div>

                                    </div>



                                </div>
                            </div>
                            <!-- /.col (right) -->

                        </div>
                        <!-- /.row -->
                    </form></div><!-- /.container-fluid -->

            </div>


            <!-- ./wrapper -->

        </section>
    </div>
    <script src="{{asset('//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js')}}"></script>
    <script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js')}}"></script>
    <script type="text/javascript">

        $("#nameid").select2({
            placeholder: "اختر ",
            allowClear: true
        });
    </script>
    <script type="text/javascript">

        $("#named").select2({
            placeholder: "اختر ",
            allowClear: true
        });
    </script>
    <!-- jQuery -->


@endsection
