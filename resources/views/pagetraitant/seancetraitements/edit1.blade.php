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
                    <form  method="post" action="{{route('pagetraitant.seancetraitements.update',$seancetraitement->id)}}" enctype="multipart/form-data" >
                            @method('PUT')
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <!-- /.card-header -->
                        @if ($message = Session::get('success'))
                            <div class="alert alert-danger" role="alert">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">


                                    <div class="form-group">
                                        <label>اللقب :</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                            </div>

                                            <select   class="form-control" style="width: 468px" id="named" name="enfant_id" >
                                                <option ></option>
                                                @foreach($enfants as $enfant)
                                                    <option  value="{{$enfant->id_enfant}}" selected disabled>{{$enfant->prenom}}</option>
                                                @endforeach
                                            </select>


                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>تاريخ الحصة :</label>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>


                                            </div>
                                            <input type="date" class="form-control" name="dateTraite"  value="{{$seancetraitement->dateTraite}}" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label> الطريقة المستعملة:</label>
                                        <select class="form-control" name="methode" value="methode">
                                            <option  selected> {{$seancetraitement->methode}}</option>
                                            @if($seancetraitement->methode=="TEACCH")
                                            <option methode="ABA"> ABA</option>
                                            <option methode="PECS"> PECS</option>
                                             @elseif($seancetraitement->methode=="ABA")
                                                <option methode="TEACCH"> TEACCH</option>
                                                <option methode="PECS"> PECS</option>
                                             @elseif($seancetraitement->methode=="PECS")
                                                <option methode="TEACCH"> TEACCH</option>
                                                <option methode="ABA"> ABA</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            التعليق :
                                        </label>
                                        <textarea class="remarquearea" rows="3,5" cols="58,5" name="commentaire"  >{{$seancetraitement->commentaire}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            نصائح للوالدين :
                                        </label>
                                        <textarea class="remarquearea" rows="3,5" cols="58,5" name="conseils" >{{$seancetraitement->conseils}}</textarea>
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

                                            <input type="text" class="form-control"   value="{{$enfant->nom}}" disabled>


                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <label> مدة الحصة :</label>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-clock-o"></i></span>

                                            </div>
                                            <input type="text" class="form-control" name="duree" value="{{$seancetraitement->duree}}" >

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            الوصف :
                                        </label>
                                        <textarea class="remarquearea" rows="13" cols="58" name="description"  >{{$seancetraitement->description}}</textarea>
                                    </div>

                                </div>
                                <!-- /.col (right) -->

                            </div>
                            <!-- /.row -->

                        </div><!-- /.container-fluid -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card card-default">
                                    <button type="submit" class="btn btn-success btn-block"  >حفظ</button>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                {!! Html::linkRoute('pagetraitant.seancetraitements.index', 'الغاء', array($seancetraitement->id), array('class' => 'btn btn-danger btn-block')) !!}
                            </div>
                        </div>
                    </form></div>


                <!-- ./wrapper -->
            </div>
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
