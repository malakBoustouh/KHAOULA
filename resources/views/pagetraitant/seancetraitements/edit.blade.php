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


                    <form  method="post" action="{{route('pagetraitant.seancetraitements.update',$seancetraitement->id)}}" enctype="multipart/form-data" >
                            @method('PUT')
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <!-- /.card-header -->

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
                                                                <b>العمر:</b> <a>{{ $age}} {{"سنة"}}</a>
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
                                                                    <b>الأب:</b> <a>{{$parentt->prenomp}} {{$parentt->nomp}}</a>
                                                                @endif
                                                            </li>
                                                            <li class="list-group-item">
                                                                <b>رقم الهاتف:</b> <a>{{$parentt->numTel}}</a>
                                                            </li>
                                                        </ul>

                                                        <div class="text-center">
                                                            @if($parentt->img)
                                                                <img src="{{ asset('storage/familles/'.$parentt->img) }}" class="profile-parents-img img-fluid img-circle" >
                                                            @else
                                                                <img  class="profile-parents-img img-fluid img-circle"
                                                                      src="{{asset('dist/img/mom.jpg')}}"
                                                                      alt="صورةالأم">
                                                            @endif
                                                        </div>
                                                        <p></p>
                                                        <ul class="list-group list-group-unbordered mb-3">
                                                            <li class="list-group-item">
                                                                <b>الأم:</b> <a>{{$parentt->prenomp}} {{$parentt->nomp}}</a>
                                                            </li>
                                                            <li class="list-group-item">
                                                                <b>رقم الهاتف:</b> <a>{{$parentt->numTel}}</a>
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

                                <div class="col-md-9">
                                    <div class="card">

                                        <div class="card-header p-2">


                                            <div class="card-body">

                                            </div><!-- /.card-header -->

                                            <div class="card-header">
                                        <h3 class="card-title">تعديل البيانات</h3>
                                    </div>
                                    <div class="card">
                                        <div class="tab-content">

                                                        <div class="card-body table-responsive p-0">
                                                            @if ($message = Session::get('success'))
                                                                <div class="alert alert-success">
                                                                    <p>{{ $message }}</p>
                                                                </div>
                                                            @endif
                              <div class="row">
                                <div class="col-md-6">


                                    <div class="form-group">
                                        <label>اللقب :</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                            </div>

                                            <select   class="form-control" style="width: 344.5px" id="named" name="enfant_id" >
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
                                        <textarea class="remarquearea" rows="3,5" cols="58,5" style="width: 383px" name="commentaire" >{{$seancetraitement->commentaire}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            نصائح للوالدين :
                                        </label>
                                        <textarea class="remarquearea" rows="3,5" cols="58,5" style="width: 383px" name="conseils" >{{$seancetraitement->conseils}}</textarea>
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
                                            <select   style="width: 344.5px" id="nameid" name="enf_id" >
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
                                            <input type="text"  class="form-control" name="duree" value="{{$seancetraitement->duree}}" >

                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <label> التقييم :</label>

                                        <div class="input-group">
                                            <select class="form-control" name="note" value="{{$seancetraitement->note}}">
                                                <option  selected>{{$seancetraitement->note}}</option>
                                                @if($seancetraitement->note =='1')
                                                    <option note="2">2</option>
                                                    <option note="3">3</option>
                                                    <option note="4">4</option>
                                                    <option note="5">5</option>
                                                    <option note="6">6</option>
                                                    <option note="7">7</option>
                                                    <option note="8">8</option>
                                                    <option note="9">9</option>
                                                    <option note="1O">10</option>
                                                @elseif($seancetraitement->note =="2")
                                                    <option note="1">1</option>
                                                    <option note="3">3</option>
                                                    <option note="4">4</option>
                                                    <option note="5">5</option>
                                                    <option note="6">6</option>
                                                    <option note="7">7</option>
                                                    <option note="8">8</option>
                                                    <option note="9">9</option>
                                                    <option note="1O">10</option>
                                                @elseif($seancetraitement->note =="3")
                                                    <option note="1">1</option>
                                                    <option note="2">2</option>
                                                    <option note="4">4</option>
                                                    <option note="5">5</option>
                                                    <option note="6">6</option>
                                                    <option note="7">7</option>
                                                    <option note="8">8</option>
                                                    <option note="9">9</option>
                                                    <option note="1O">10</option>
                                                @elseif($seancetraitement->note =="4")
                                                    <option note="1">1</option>
                                                    <option note="2">2</option>
                                                    <option note="3">3</option>
                                                    <option note="5">5</option>
                                                    <option note="6">6</option>
                                                    <option note="7">7</option>
                                                    <option note="8">8</option>
                                                    <option note="9">9</option>
                                                    <option note="1O">10</option>
                                                @elseif($seancetraitement->note =="5")
                                                    <option note="1">1</option>
                                                    <option note="2">2</option>
                                                    <option note="3">3</option>
                                                    <option note="4">4</option>
                                                    <option note="6">6</option>
                                                    <option note="7">7</option>
                                                    <option note="8">8</option>
                                                    <option note="9">9</option>
                                                    <option note="1O">10</option>
                                                @elseif($seancetraitement->note =="6")
                                                    <option note="1">1</option>
                                                    <option note="2">2</option>
                                                    <option note="3">3</option>
                                                    <option note="4">4</option>
                                                    <option note="5">5</option>
                                                    <option note="7">7</option>
                                                    <option note="8">8</option>
                                                    <option note="9">9</option>
                                                    <option note="1O">10</option>
                                                @elseif($seancetraitement->note =="7")
                                                    <option note="1">1</option>
                                                    <option note="2">2</option>
                                                    <option note="3">3</option>
                                                    <option note="4">4</option>
                                                    <option note="5">5</option>
                                                    <option note="6">6</option>
                                                    <option note="8">8</option>
                                                    <option note="9">9</option>
                                                    <option note="1O">10</option>
                                                @elseif($seancetraitement->note =="8")
                                                    <option note="1">1</option>
                                                    <option note="2">2</option>
                                                    <option note="3">3</option>
                                                    <option note="4">4</option>
                                                    <option note="5">5</option>
                                                    <option note="6">6</option>
                                                    <option note="7">7</option>
                                                    <option note="9">9</option>
                                                    <option note="1O">10</option>
                                                @elseif($seancetraitement->note =="9")
                                                    <option note="1">1</option>
                                                    <option note="2">2</option>
                                                    <option note="3">3</option>
                                                    <option note="4">4</option>
                                                    <option note="5">5</option>
                                                    <option note="6">6</option>
                                                    <option note="7">7</option>
                                                    <option note="8">8</option>
                                                    <option note="1O">10</option>
                                                @elseif($seancetraitement->note =="10")
                                                    <option note="1">1</option>
                                                    <option note="2">2</option>
                                                    <option note="3">3</option>
                                                    <option note="4">4</option>
                                                    <option note="5">5</option>
                                                    <option note="6">6</option>
                                                    <option note="7">7</option>
                                                    <option note="8">8</option>
                                                    <option note="9">9</option>
                                                @endif
                                            </select>
                                        </div></div>

                                    <div class="form-group">
                                        <label>
                                            الوصف :
                                        </label>
                                        <textarea class="remarquearea" rows="13" cols="20" style="width: 380px" name="description"  >{{$seancetraitement->description}}</textarea>
                                    </div>

                                </div>
                              </div>
                                        <div class="row" >
                                            <div class="col-sm-6">
                                                <div class="card card-default">
                                                    <button  type="submit" class="btn btn-success btn-block"  >حفظ</button>
                                                </div>
                                            </div>
                                            <div class="col-sm-6" >
                                                {!! Html::linkRoute('pagetraitant.show2', 'الغاء', array($enfant->id_enfant), array('class' => 'btn btn-danger btn-block')) !!}
                                            </div>
                                        </div>
                                    </div>
                                    </div>








                                <!-- /.col (right) -->
                                    </div></div>                                </div>



                            <!-- /.row -->

                                    </div></div></form></div></section>

                <!-- ./wrapper -->
      </div>


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

    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
@endsection
