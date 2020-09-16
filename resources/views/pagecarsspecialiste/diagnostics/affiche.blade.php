@extends('layouts.specialistes')
@section('title','| ملف الطفل')
@section('content')
    <head>
        <link rel="stylesheet" href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css')}}">
        <script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js')}}"></script>
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

                                            <h3 class="profile-username text-center childname">{{$parentt->nomp}} {{$enfant->nom}}</h3>
                                            <ul class="list-group list-group-unbordered mb-3">
                                                <li class="list-group-item">
                                                    <b>الجنس:</b> <a>{{ $enfant->sexe}}</a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>العمر:</b> <a>{{$calculeAge}} {{"سنة"}}</a>
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
                                                        <b>الأب:</b> <a> {{$parentt->nomp}} {{$parentt->prenomp}}</a>
                                                    @endif
                                                </li>
                                                <li class="list-group-item">
                                                    <b>رقم الهاتف:</b> <a>{{$parentt->numTel}}</a>
                                                </li>
                                            </ul>

                                            <div class="text-center">
                                                @if($parentt->img)
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
                                                    <b>الأم:</b> <a>{{$parent->nomp}} {{$parent->prenomp}}</a>
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
                                        <input type="text" name="table_search" class="form-control float-right" placeholder="بحث">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#prise" data-toggle="tab">التشخيص</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#traite" data-toggle="tab" >إضافة تشخيص</a></li>


                                </ul>

                                <div class="card-body">

                                </div><!-- /.card-header -->

                                <div class="tab-content">
                                    <div class="active tab-pane"  id="prise">
                                        <div class="post">
                                            <div class="card">
                                                <div class="card-body table-responsive p-0">
                                                    @if ($message = Session::get('success'))
                                                        <div class="alert alert-success">
                                                            <p>{{ $message }}</p>
                                                        </div>
                                                    @endif
                                                    @if ($message = Session::get('succe'))
                                                        <div class="alert alert-danger" role="alert">
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
                                                                    <tr   data-href="{{route('pagecarsspecialiste.show',$h->id)}}"  style="cursor: pointer;">
                                                                        <td>{{$h->dateDiagnostic}}</td>
                                                                        @foreach($carsspecialistes as $t   )
                                                                            @if($h->carsspecialiste_id==$t->id_carsspecialiste)
                                                                                <td value="{{$t->id_carsspecialiste}}">{{'الدكتور(ة)'}} {{ $t->prenom}} {{ $t->nom}}  </td>
                                                                                <td  value="{{$t->id_supervisseur}}">{{'الدكتور(ة)'}} {{ $t->prenom}} {{ $t->nom}}  </td>
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

                                    <div class="tab-pane" id="traite">
                                        <div class="card">
                                            <section class="content">
                                                @csrf

                                                <div class="card card-primary">


                                                    <!-- /.card-header -->
                                                    @if ($message = Session::get('success'))
                                                        <div class="alert alert-danger" role="alert">
                                                            <p>{{ $message }}</p>
                                                        </div>
                                                @endif
                                                <!-- /.card-header -->
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group" >
                                                                    <label>اللقب و الإسم:</label>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i class="fa fa-child"></i></span>
                                                                        </div>

                                                                        <select   class="form-control" style="width: 319px" id="named" name="enfant_id" >
                                                                            <option ></option>
                                                                            <option  value="{{$enfant->id_enfant}}" selected readonly>{{$enfant->prenom}} {{$enfant->nom}}</option>
                                                                            <option id="birthday" value="{{$enfant->dateNaissance}}" hidden ></option>
                                                                        </select>

                                                                    </div>
                                                                </div>
                                                                <div class="form-group">

                                                                    <label> المشرفة  :</label>

                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                                        </div>

                                                                        <select   style="width: 319px" id="nametrait" name="trait" >
                                                                            <option ></option>
                                                                            @foreach($carsspecialistes as $trait)
                                                                                <option value="{{$trait->id_carsspecialiste}}" >{{$trait->nom}} {{$trait->prenom}} </option>
                                                                            @endforeach
                                                                        </select>

                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-6">

                                                                <div class="form-group">

                                                                    <label> تاريخ تطبيق المقياس  :</label>

                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                        </div>
                                                                        <input type="date" class="form-control" name="date" id="dateD" readonly value="{{$dateActuelle}}">

                                                                    </div>
                                                                </div>
                                                                <div class="form-group">

                                                                    <label > النتيجة  :</label>

                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i class="fa fa-commenting-o" ></i></span>
                                                                        </div>
                                                                        <input type="text" readonly class="form-control"  id="autismresult"  name="autismresult" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- /.row -->

                                                        </div><!-- /.container-fluid -->


                                                    </div>
                                                </div>
                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <!-- general form elements -->
                                                        <div class="card card-info">
                                                            <div class="card-header">
                                                                <h3 class="card-title" >العلاقات مع الآخرين</h3>
                                                                <input type="text" name="quest1" value="العلاقات مع الآخرين" hidden>
                                                            </div>
                                                            <!-- /.card-header -->
                                                            <div class="card-body">

                                                                <!-- radio -->
                                                                <div class="form-group">
                                                                    <label class="container">
                                                                        <input type="radio" name="r1"  class="minimal" value="1">
                                                                        <span class="input-label" >لا يوجد أي دلالة أو صعوبة في التعامل مع الآخرين.</span>
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="container"> ---
                                                                        <input type="radio" name="r1" class="minimal" value="1.5">
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="container">
                                                                        <input type="radio" name="r1" class="minimal" value="2" >
                                                                        <span class="input-label">علاقات غير عادية بدرجة بسيطة.</span>
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="container"> ---
                                                                        <input type="radio" name="r1" class="minimal" value="2.5">
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="container">
                                                                        <input type="radio" name="r1"  class="minimal" value="3" >
                                                                        <span class="input-label"  >علاقات غير عادية بدرجة متوسطة.</span>
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="container"> ---
                                                                        <input type="radio" name="r1" class="minimal" value="3.5">
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="container">
                                                                        <input type="radio" name="r1" class="minimal" value="4" >
                                                                        <span class="input-label" > علاقات غير عادية بدرجة شديدة.</span>
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>
                                                                        ملاحظات :
                                                                    </label>
                                                                    <textarea class="remarquearea" name="remarque1" rows="4" style="width:323px" cols="56,5" ></textarea>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">

                                                        <div class="card card-warning">
                                                            <div class="card-header">
                                                                <h3 class="card-title" name="quest2"> التقليد</h3>
                                                                <input type="text" name="quest2" value="التقليد" hidden>

                                                            </div>
                                                            <!-- /.card-header -->
                                                            <div class="card-body">

                                                                <!-- radio -->
                                                                <div class="form-group">
                                                                    <label class="container">
                                                                        <input type="radio" name="r2" class="minimal" value="1">
                                                                        <span class="input-label" >  التقليد المناسب.</span>
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="container"> ---
                                                                        <input type="radio" name="r2" class="minimal" value="1.5">
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="container">
                                                                        <input type="radio" name="r2" class="minimal" value="2" >
                                                                        <span class="input-label" > التقليد غير العادي من الدرجة البسيطة.</span>
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="container"> ---
                                                                        <input type="radio" name="r2" class="minimal" value="2.5">
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="container">
                                                                        <input type="radio" name="r2" class="minimal" value="3" >
                                                                        <span class="input-label" >التقليد غير العادي من الدرجة المتوسطة.</span>
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="container"> ---
                                                                        <input type="radio" name="r2" class="minimal" value="3.5">
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="container">
                                                                        <input type="radio" name="r2" class="minimal" value="4" >
                                                                        <span class="input-label" >التقليد غير العادي من الدرجة الشديدة. </span>
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>
                                                                        ملاحظات :
                                                                    </label>
                                                                    <textarea class="remarquearea" name="remarque2" style="width:323px" cols="56,5" rows="4" cols="56,5"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <!-- general form elements -->
                                                            <div class="card card-danger">
                                                                <div class="card-header">
                                                                    <h3 class="card-title" name="quest3">الإستجابة الإنفعالية</h3>
                                                                    <input type="text" name="quest3" value="الإستجابة الإنفعالية" hidden>
                                                                </div>
                                                                <!-- /.card-header -->
                                                                <div class="card-body">

                                                                    <!-- radio -->
                                                                    <div class="form-group">
                                                                        <label class="container">
                                                                            <input type="radio" name="r3" class="minimal" value="1">
                                                                            <span class="input-label"> إستجابات إنفعالية مناسبة للمواقف و العمر.</span>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container"> ---
                                                                            <input type="radio" name="r3" class="minimal" value="1.5">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container">
                                                                            <input type="radio" name="r3" class="minimal" value="2" >
                                                                            <span class="input-label" >  إستجابات إنفعالية غير عادية من الدرجة البسيطة.</span>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container"> ---
                                                                            <input type="radio" name="r3" class="minimal" value="2.5">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container">
                                                                            <input type="radio" name="r3" class="minimal" value="3" >
                                                                            <span class="input-label" >إستجابات إنفعالية غير عادية من الدرجة المتوسطة.</span>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container"> ---
                                                                            <input type="radio" name="r3" class="minimal" value="3.5">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container">
                                                                            <input type="radio" name="r3" class="minimal" value="4" >
                                                                            <span class="input-label" >إستجابات إنفعالية غير عادية من الدرجة الشديدة.</span>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>
                                                                            ملاحظات :
                                                                        </label>
                                                                        <textarea class="remarquearea" name="remarque3" style="width:323px" cols="56,5" rows="4" cols="56,5"></textarea>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- general form elements -->

                                                        <div class="col-md-6">

                                                            <div class="card card-success">
                                                                <div class="card-header">
                                                                    <h3 class="card-title" name="quest4">إستخدام الجسم</h3>
                                                                    <input type="text" name="quest4" value="إستخدام الجسم" hidden>
                                                                </div>
                                                                <!-- /.card-header -->
                                                                <div class="card-body">

                                                                    <!-- radio -->
                                                                    <div class="form-group">
                                                                        <label class="container">
                                                                            <input type="radio" name="r4" class="minimal" value="1">
                                                                            <span class="input-label">  إستخدام الجسم بشكل مناسب لعمر الطفل.</span>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container"> ---
                                                                            <input type="radio" name="r4" class="minimal" value="1.5">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container">
                                                                            <input type="radio" name="r4" class="minimal" value="2" >
                                                                            <span class="input-label" > إستخدام غير عادي للجسم من الدرجة البسيطة.</span>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container"> ---
                                                                            <input type="radio" name="r4" class="minimal" value="2.5">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container">
                                                                            <input type="radio" name="r4" class="minimal" value="3" >
                                                                            <span class="input-label" >  إستخدام غير عادي للجسم من الدرجة المتوسطة.</span>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container"> ---
                                                                            <input type="radio" name="r4" class="minimal" value="3.5">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container">
                                                                            <input type="radio" name="r4" class="minimal" value="4" >
                                                                            <span class="input-label" > إستخدام غير عادي للجسم من الدرجة الشديدة.</span>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>
                                                                            ملاحظات :
                                                                        </label>
                                                                        <textarea class="remarquearea" name="remarque4" style="width:323px" cols="56,5" rows="4" cols="56,5"></textarea>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <!-- general form elements -->
                                                            <div class="card card-info">
                                                                <div class="card-header">
                                                                    <h3 class="card-title" name="quest5">إستخدام الأشياء</h3>
                                                                    <input type="text" name="quest5" value="إستخدام الأشياء" hidden>
                                                                </div>
                                                                <!-- /.card-header -->
                                                                <div class="card-body">

                                                                    <!-- radio -->
                                                                    <div class="form-group">
                                                                        <label class="container">
                                                                            <input type="radio" name="r5" class="minimal" value="1">
                                                                            <span class="input-label"  > الإستخدام المناسب و الإستمتاع بالألعاب و الأشياء الأخرى.</span>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container"> ---
                                                                            <input type="radio" name="r5" class="minimal" value="1.5">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container">
                                                                            <input type="radio" name="r5" class="minimal" value="2" >
                                                                            <span class="input-label">الإستخدام و الإستمتاع غير المناسب في الألعاب والأشياء الأخرى من الدرجة البسيطة. </span>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container"> ---
                                                                            <input type="radio" name="r5" class="minimal" value="2.5">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container">
                                                                            <input type="radio" name="r5" class="minimal" value="3" >
                                                                            <span class="input-label" > الإستخدام و الإستمتاع غير المناسب في الألعاب والأشياء الأخرى من الدرجة المتوسطة.</span>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container"> ---
                                                                            <input type="radio" name="r5" class="minimal" value="3.5">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container">
                                                                            <input type="radio" name="r5" class="minimal" value="4" >
                                                                            <span class="input-label"> الإستخدام و الإستمتاع غير المناسب في الألعاب والأشياء الأخرى من الدرجة الشديدة.</span>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>
                                                                            ملاحظات :
                                                                        </label>
                                                                        <textarea class="remarquearea" name="remarque5" style="width:323px" cols="56,5" rows="4" cols="56,5"></textarea>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- general form elements -->

                                                        <div class="col-md-6">

                                                            <div class="card card-warning">
                                                                <div class="card-header">
                                                                    <h3 class="card-title" name="quest6"> التكيف للتغير</h3>
                                                                    <input type="text" name="quest6" value=" التكيف للتغير" hidden>
                                                                </div>
                                                                <!-- /.card-header -->
                                                                <div class="card-body">
                                                                    <!-- radio -->
                                                                    <div class="form-group">
                                                                        <label class="container">
                                                                            <input type="radio" name="r6" class="minimal" value="1">
                                                                            <span class="input-label" >  الإستجابة للتغير مناسبة لعمر الطفل.</span>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container"> ---
                                                                            <input type="radio" name="r6" class="minimal" value="1.5">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container">
                                                                            <input type="radio" name="r6" class="minimal" value="2" >
                                                                            <span class="input-label" > تكيف غير مناسب بدرجة بسيطة للتغيير.</span>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container"> ---
                                                                            <input type="radio" name="r6" class="minimal" value="2.5">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container">
                                                                            <input type="radio" name="r6" class="minimal" value="3" >
                                                                            <span class="input-label" >   تكيف غير مناسب بدرجة متوسطة للتغيير.</span>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container"> ---
                                                                            <input type="radio" name="r6" class="minimal" value="3.5">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container">
                                                                            <input type="radio" name="r6" class="minimal" value="4" >
                                                                            <span class="input-label" > تكيف غير مناسب بدرجة شديدة للتغيير.</span>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>
                                                                            ملاحظات :
                                                                        </label>
                                                                        <textarea class="remarquearea" name="remarque6" style="width:323px" cols="56,5" rows="4" cols="56,5"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <!-- general form elements -->
                                                            <div class="card card-danger">
                                                                <div class="card-header">
                                                                    <h3 class="card-title" name="quest7">الإستجابة البصرية</h3>
                                                                    <input type="text" name="quest7" value=" الإستجابة البصرية" hidden>

                                                                </div>
                                                                <!-- /.card-header -->
                                                                <div class="card-body">

                                                                    <!-- radio -->
                                                                    <div class="form-group">
                                                                        <label class="container">
                                                                            <input type="radio" name="r7" class="minimal" value="1">
                                                                            <span class="input-label">إستجابة بصرية مناسبة للعمر. </span>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container"> ---
                                                                            <input type="radio" name="r7" class="minimal" value="1.5">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container">
                                                                            <input type="radio" name="r7" class="minimal" value="2" >
                                                                            <span class="input-label" > إستجابة بصرية غير عادية من الدرجة البسيطة.</span>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container"> ---
                                                                            <input type="radio" name="r7" class="minimal" value="2.5">
                                                                            <span class="checkmark" ></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container">
                                                                            <input type="radio" name="r7" class="minimal" value="3" >
                                                                            <span class="input-label" >   إستجابة بصرية غير عادية من الدرجة المتوسطة.</span>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container"> ---
                                                                            <input type="radio" name="r7" class="minimal" value="3.5">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container">
                                                                            <input type="radio" name="r7" class="minimal" value="4" >
                                                                            <span class="input-label"> إستجابة بصرية غير عادية من الدرجة الشديدة.</span>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>
                                                                            ملاحظات :
                                                                        </label>
                                                                        <textarea class="remarquearea" name="remarque7" style="width:323px" cols="56,5" rows="4" cols="56,5"></textarea>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- general form elements -->

                                                        <div class="col-md-6">

                                                            <div class="card card-success">
                                                                <div class="card-header">
                                                                    <h3 class="card-title" name="quest8">الإستجابة السمعية</h3>
                                                                    <input type="text" name="quest8" value="الإستجابة السمعية" hidden>
                                                                </div>
                                                                <!-- /.card-header -->
                                                                <div class="card-body">

                                                                    <!-- radio -->
                                                                    <div class="form-group">
                                                                        <label class="container">
                                                                            <input type="radio" name="r8" class="minimal" value="1">
                                                                            <span class="input-label" >  إستجابة سمعية مناسبة لعمر الطفل.</span>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container">
                                                                            <input type="radio" name="r8" class="minimal" value="1.5">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container">
                                                                            <input type="radio" name="r8" class="minimal" value="2" >
                                                                            <span class="input-label" > إستجابة سمعية غير عادية من الدرجة البسيطة.</span>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container"> ---
                                                                            <input type="radio" name="r8" class="minimal" value="2.5">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container">
                                                                            <input type="radio" name="r8" class="minimal" value="3" >
                                                                            <span class="input-label" > إستجابة سمعية غير عادية من الدرجة المتوسطة.</span>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container"> ---
                                                                            <input type="radio" name="r8" class="minimal" value="3.5">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container">
                                                                            <input type="radio" name="r8" class="minimal" value="4" >
                                                                            <span class="input-label" >   إستجابة سمعية غير عادية من الدرجة الشديدة.</span>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>
                                                                            ملاحظات :
                                                                        </label>
                                                                        <textarea class="remarquearea" name="remarque8" style="width:323px" cols="56,5" rows="4" cols="56,5"></textarea>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <!-- general form elements -->
                                                            <div class="card card-info">
                                                                <div class="card-header">
                                                                    <h3 class="card-title" name="quest9">إستجابات اللمس،الشم،التذوق و استخدامها</h3>
                                                                    <input type="text" name="quest9" value="إستجابات اللمس،الشم،التذوق و استخدامها" hidden>
                                                                </div>
                                                                <!-- /.card-header -->
                                                                <div class="card-body">

                                                                    <!-- radio -->
                                                                    <div class="form-group">
                                                                        <label class="container">
                                                                            <input type="radio" name="r9" class="minimal" value="1">
                                                                            <span class="input-label" >  الإستجابة و الإستخدام الطبيعي للتذوق،الشم و اللمس.</span>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container"> ---
                                                                            <input type="radio" name="r9" class="minimal" value="1.5">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container">
                                                                            <input type="radio" name="r9" class="minimal" value="2" >
                                                                            <span class="input-label" >الإستجابة و الإستخدام غير العادي للتذوق،الشم و اللمس بدرجة بسيطة.</span>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container"> ---
                                                                            <input type="radio" name="r9" class="minimal" value="2.5">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container">
                                                                            <input type="radio" name="r9" class="minimal" value="3" >
                                                                            <span class="input-label" > الإستجابة و الإستخدام غير العادي للتذوق،الشم و اللمس بدرجة متوسطة.</span>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container"> ---
                                                                            <input type="radio" name="r9" class="minimal" value="3.5">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container">
                                                                            <input type="radio" name="r9" class="minimal" value="4" >

                                                                            <span class="input-label" > الإستجابة و الإستخدام غير العادي للتذوق،الشم و اللمس بدرجة شديدة. </span>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>
                                                                            ملاحظات :
                                                                        </label>
                                                                        <textarea class="remarquearea" name="remarque9" style="width:323px" cols="56,5" rows="4" cols="56,5"></textarea>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- general form elements -->

                                                        <div class="col-md-6">

                                                            <div class="card card-warning">
                                                                <div class="card-header">
                                                                    <h3 class="card-title" name="quest10"> الخوف و العصبية</h3>
                                                                    <input type="text" name="quest10" value=" الخوف و العصبية" hidden>
                                                                </div>
                                                                <!-- /.card-header -->
                                                                <div class="card-body">
                                                                    <!-- radio -->
                                                                    <div class="form-group">
                                                                        <label class="container">
                                                                            <input type="radio" name="r10" class="minimal" value="1">
                                                                            <span class="input-label" > الخوف أو العصبية بدرجة عادية.</span>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container"> ---
                                                                            <input type="radio" name="r10" class="minimal" value="1.5">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container">
                                                                            <input type="radio" name="r10" class="minimal" value="2" >
                                                                            <span class="input-label" >  خوف أو عصبية غير عادية من الدرجة البسيطة.</span>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container"> ---
                                                                            <input type="radio" name="r10" class="minimal" value="2.5">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container">
                                                                            <input type="radio" name="r10" class="minimal" value="3" >
                                                                            <span class="input-label" >   خوف أو عصبية غير عادية من الدرجة المتوسطة. </span>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container"> ---
                                                                            <input type="radio" name="r10" class="minimal" value="3.5">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container">
                                                                            <input type="radio" name="r10" class="minimal" value="4" >
                                                                            <span class="input-label" > خوف أو عصبية غير عادية من الدرجة الشديدة.</span>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>
                                                                            ملاحظات :
                                                                        </label>
                                                                        <textarea class="remarquearea" name="remarque10" style="width:323px" cols="56,5" rows="4" cols="56,5"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <!-- general form elements -->
                                                            <div class="card card-danger">
                                                                <div class="card-header">
                                                                    <h3 class="card-title" name="quest11">التواصل اللفظي</h3>
                                                                    <input type="text" name="quest11" value="التواصل اللفظي" hidden>
                                                                </div>
                                                                <!-- /.card-header -->
                                                                <div class="card-body">

                                                                    <!-- radio -->
                                                                    <div class="form-group">
                                                                        <label class="container">
                                                                            <input type="radio" name="r11" class="minimal" value="1">
                                                                            <span class="input-label" >تواصل لفظي طبيعي مناسب لعمره الزمني و للمواقف التي يمر بها.</span>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container"> ---
                                                                            <input type="radio" name="r11" class="minimal" value="1.5">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container">
                                                                            <input type="radio" name="r11" class="minimal" value="2" >
                                                                            <span class="input-label" > تواصل لفظي غير عادي من الدرجة البسيطة.</span>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container"> ---
                                                                            <input type="radio" name="r11" class="minimal" value="2.5">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container">
                                                                            <input type="radio" name="r11" class="minimal" value="3" >
                                                                            <span class="input-label" >   تواصل لفظي غير عادي من الدرجة المتوسطة.</span>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container"> ---
                                                                            <input type="radio" name="r11" class="minimal" value="3.5">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container">
                                                                            <input type="radio" name="r11" class="minimal" value="4" >
                                                                            <span class="input-label" > تواصل لفظي غير عادي من الدرجة الشديدة.</span>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>
                                                                            ملاحظات :
                                                                        </label>
                                                                        <textarea class="remarquearea" name="remarque11"  style="width:323px" cols="56,5" rows="4" cols="56,5"></textarea>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- general form elements -->

                                                        <div class="col-md-6">

                                                            <div class="card card-success">
                                                                <div class="card-header">
                                                                    <h3 class="card-title" name="quest12">التواصل غير اللفظي</h3>
                                                                    <input type="text" name="quest12" value="التواصل غير اللفظي" hidden>
                                                                </div>
                                                                <!-- /.card-header -->
                                                                <div class="card-body">

                                                                    <!-- radio -->
                                                                    <div class="form-group">
                                                                        <label class="container">
                                                                            <input type="radio" name="r12" class="minimal" value="1">

                                                                            <span class="input-label" >   استخدام عادي للتواصل غير اللفظي، مناسب للمواقف وكذلك العمر الموجود فيه الطفل.</span>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container"> ---
                                                                            <input type="radio" name="r12" class="minimal" value="1.5">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container">
                                                                            <input type="radio" name="r12" class="minimal" value="2" >
                                                                            <span class="input-label" >   استخدام غير عادي للتواصل غير اللفظي بدرجة بسيطة.</span>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container"> ---
                                                                            <input type="radio" name="r12" class="minimal" value="2.5">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container">
                                                                            <input type="radio" name="r12" class="minimal" value="3" >
                                                                            <span class="input-label" > استخدام غير عادي للتواصل غير اللفظي بدرجة متوسطة.  </span>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container"> ---
                                                                            <input type="radio" name="r12" class="minimal" value="3.5">
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="container">
                                                                            <input type="radio" name="r12" class="minimal" value="4" >
                                                                            <span class="input-label" >  استخدام غير عادي للتواصل غير اللفظي بدرجة شديدة.</span>
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>
                                                                            ملاحظات :
                                                                        </label>
                                                                        <textarea class="remarquearea" name="remarque12" style="width:323px" cols="56,5" rows="4" cols="56,5"></textarea>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <!-- general form elements -->
                                                        <div class="card card-info">
                                                            <div class="card-header">
                                                                <h3 class="card-title" name="quest13">مستوى النشاط</h3>
                                                                <input type="text" name="quest13" value="مستوى النشاط" hidden>
                                                            </div>
                                                            <!-- /.card-header -->
                                                            <div class="card-body">

                                                                <!-- radio -->
                                                                <div class="form-group">
                                                                    <label class="container">
                                                                        <input type="radio" name="r13" class="minimal" value="1">
                                                                        <span class="input-label" >   مستوى النشاط طبيعي بالنسبة للعمر والظروف.</span>
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="container"> ---
                                                                        <input type="radio" name="r13" class="minimal" value="1.5">
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="container">
                                                                        <input type="radio" name="r13" class="minimal" value="2" >
                                                                        <span class="input-label" > مستوى النشاط غير عادي من الدرجة البسيطة.</span>
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="container"> ---
                                                                        <input type="radio" name="r13" class="minimal" value="2.5">
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="container">
                                                                        <input type="radio" name="r13" class="minimal" value="3" >
                                                                        <span class="input-label" > مستوى النشاط غير عادي من الدرجة المتوسطة.</span>
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="container"> ---
                                                                        <input type="radio" name="r13" class="minimal" value="3.5">
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="container">
                                                                        <input type="radio" name="r13" class="minimal" value="4" >
                                                                        <span class="input-label" >   مستوى النشاط غير عادي من الدرجة الشديدة.</span>
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>
                                                                        ملاحظات :
                                                                    </label>
                                                                    <textarea class="remarquearea" name="remarque13" style="width:323px" cols="56,5" rows="4" cols="56,5"></textarea>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- general form elements -->

                                                    <div class="col-md-6">

                                                        <div class="card card-warning">
                                                            <div class="card-header">
                                                                <h3 class="card-title" name="quest14">المستوى و الدرجة الخاصة بالإستجابة العقلية</h3>
                                                                <input type="text" name="quest14" value="المستوى و الدرجة الخاصة بالإستجابة العقلية" hidden>
                                                            </div>
                                                            <!-- /.card-header -->
                                                            <div class="card-body">
                                                                <!-- radio -->
                                                                <div class="form-group">
                                                                    <label class="container">
                                                                        <input type="radio" name="r14" class="minimal" value="1">
                                                                        <span class="input-label"> الذكاء طبيعي و القدرات العقلية عادية في مختلف المجالات.</span>
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="container"> ---
                                                                        <input type="radio" name="r14" class="minimal" value="1.5">
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="container">
                                                                        <input type="radio" name="r14" class="minimal" value="2" >
                                                                        <span class="input-label" >  وظائف عقلية غير عادية من الدرجة البسيطة.</span>
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="container"> ---
                                                                        <input type="radio" name="r14" class="minimal" value="2.5">
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="container">
                                                                        <input type="radio" name="r14" class="minimal" value="3" >
                                                                        <span class="input-label">  وظائف عقلية غير عادية من الدرجة المتوسطة.</span>
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="container"> ---
                                                                        <input type="radio" name="r14" class="minimal" value="3.5">
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="container">
                                                                        <input type="radio" name="r14" class="minimal" value="4" >
                                                                        <span class="input-label"> وظائف عقلية غير عادية من الدرجة الشديدة.</span>
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>
                                                                        ملاحظات :
                                                                    </label>
                                                                    <textarea class="remarquearea" name="remarque14" style="width:323px" cols="56,5" rows="4" cols="56,5"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <!-- general form elements -->
                                                        <div class="card card-danger">
                                                            <div class="card-header">
                                                                <h3 class="card-title" name="quest15">الإنطباع العام</h3>
                                                                <input type="text" name="quest15" value="الإنطباع العام" hidden>
                                                            </div>
                                                            <!-- /.card-header -->
                                                            <div class="card-body">

                                                                <!-- radio -->
                                                                <div class="form-group">
                                                                    <label class="container">
                                                                        <input type="radio" name="r15" class="minimal" value="1">
                                                                        <span class="input-label" >طبيعي.</span>
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="container"> ---
                                                                        <input type="radio" name="r15" class="minimal" value="1.5">
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="container">
                                                                        <input type="radio" name="r15" class="minimal" value="2" >
                                                                        <span class="input-label" >  توحد بسيط.</span>

                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="container"> ---
                                                                        <input type="radio" name="r15" class="minimal" value="2.5">
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="container">
                                                                        <input type="radio" name="r15" class="minimal" value="3" >
                                                                        <span class="input-label" >   توحد متوسط.</span>
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="container"> ---
                                                                        <input type="radio" name="r15" class="minimal" value="3.5">
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="container">
                                                                        <input type="radio" name="r15" class="minimal" value="4" >
                                                                        <span class="input-label" >   توحد شديد.</span>
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>
                                                                        ملاحظات :
                                                                    </label>
                                                                    <textarea class="remarquearea" style="width:323px" cols="56,5" rows="4" cols="56,5" name="remarque15"></textarea>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- general form elements -->

                                                    <div class="col-md-6">

                                                        <button type="submit" class="result" value="Submit">المجموع</button>
                                                        <input type="text" name="points" id="points" disabled />
                                                        <button type="submit" id="degree" value="Submit">عرض النتيجة</button>
                                                        <button type="submit" id="saveresult" class="saveresult" value="Submit"> حفظ</button>                                                    </div>
                                                </div>
                                                    <!-- /.content -->


                                            </section>
                                            <div class="modal fade" id="#degree1">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">النتيجة</h4>
                                                            <button type="button" class="exit" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            أعراض بسيطة من إضطراب طيف التوحد
                                                        </div>
                                                        <div class="modal-footer">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="#degree2">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">النتيجة</h4>
                                                            <button type="button" class="exit" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            أعراض متوسطة من إضطراف طيف التوحد
                                                        </div>
                                                        <div class="modal-footer">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="#degree3">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" >النتيجة</h4>
                                                            <button type="button" class="exit" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            أعراض شديدة من إضطراف طيف التوحد
                                                        </div>
                                                        <div class="modal-footer">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="#error">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" >خطأ</h4>
                                                            <button type="button" class="exit" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            يرجى الإجابة على جميع الأسئلة
                                                        </div>
                                                        <div class="modal-footer">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="#sein">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" >النتيجة</h4>
                                                            <button type="button" class="exit" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            لا توجد أعراض إضطراب التوحد
                                                        </div>
                                                        <div class="modal-footer">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


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

    <script >

        $(".minimal").click(function(event) {
            var total = 0;
            $(".minimal:checked").each(function() {
                total += parseFloat($(this).val());
            });

            if (total == 0) {
                $('#points').val('');
            } else {
                $('#points').val(total);
            }
        });

        $('#degree').click(function() {
            console.log("vcbxcvbxcvb");



            var points = $('#points').val();
            var birthday = new Date($('#birthday').val());
            /* var birthday = b.getFullYear();
            var d = new Date();
            var year = d.getFullYear(); */

            var ageDifMs = Date.now() - birthday;
            var ageDate = new Date(ageDifMs); // miliseconds from epoch

            var age = Math.abs(ageDate.getUTCFullYear() - 1970);

            console.log(points);

            if (age<13){
                if (points > 15 && points <= 29.5 ) {
                    $('#\\#degree1').modal('show');
                    document.getElementById("autismresult").value = "أعراض بسيطة من إضطراب طيف التوحد";
                }
                if (points >=30 && points <= 36.5) {
                    $('#\\#degree2').modal('show');
                    document.getElementById("autismresult").value = "أعراض متوسطة من إضطراب طيف التوحد";
                }
                if (points >= 37) {
                    $('#\\#degree3').modal('show');
                    document.getElementById("autismresult").value = "أعراض شديدة من إضطراب طيف التوحد";
                }
                if (points <15) {
                    $('#\\#error').modal('show');
                }
                if (points ==15) {
                    $('#\\#sein').modal('show');
                    document.getElementById("autismresult").value = "لا توجد أعراض إضطراب التوحد";

                }
            }
            else{
                if(age>=13){
                    if (points > 15 && points <= 27.5 ) {
                        $('#\\#degree1').modal('show');
                        document.getElementById("autismresult").value = "أعراض بسيطة من إضطراب طيف التوحد";

                    }
                    if (points >=28 && points <= 34.5) {
                        $('#\\#degree2').modal('show');
                        document.getElementById("autismresult").value = "أعراض متوسطة من إضطراب طيف التوحد";
                    }
                    if (points >= 35) {
                        $('#\\#degree3').modal('show');
                        document.getElementById("autismresult").value = "أعراض شديدة من إضطراب طيف التوحد";

                    }
                    if (points <15) {
                        $('#\\#error').modal('show');
                    }
                    if (points ==15) {
                        $('#\\#sein').modal('show');
                        document.getElementById("autismresult").value = "لا توجد أعراض إضطراب التوحد";

                    }
                }
            }


        });
        $('#saveresult').click(function() {
            submitForm();
        });
        function submitForm() {
            var responses =[];
            var questions =[];
            var remarques =[];
            //radio input remarque15
            $("input[type='radio']:checked").each(function () {
                var reponse=new Object();
                console.log($(this).siblings().text());
                reponse.value=$(this).val();
                reponse.name=$(this).attr("name");
                reponse.rText=$(this).siblings('.input-label').text();
                responses.push(reponse);
            });
            //infos inputs
            $(".card-header input").each(function () {
                var reponse=new Object();
                reponse.value=$(this).val();
                reponse.name=$(this).attr("name");
                questions.push(reponse);
            });

            //infos inputs
            $(".remarquearea").each(function () {
                var reponse=new Object();
                reponse.value=$(this).val();
                reponse.name=$(this).attr("name");
                remarques.push(reponse);
            });
            /* data.push($("input._token").val()); */
            console.log(questions);
            console.log(responses);
            console.log(remarques);
            sendData(responses, questions, remarques);
        }

        function sendData(responses, questions, remarques) {
            /* var token =  $('input[name="_token"]').val();
           $.ajaxSetup({
               beforeSend: function(xhr) {
                   xhr.setRequestHeader('_token', token);
               }
           }); */
            /* var jsonString=JSON.stringify(data);
            console.log(jsonString); */

            $.ajax({
                type:"POST",
                url:"/pagecarsspecialiste/diagnostics/store",
                data: {
                    responses : JSON.stringify(responses),
                    questions : JSON.stringify(questions),
                    remarques : JSON.stringify(remarques),
                    _token: "{{ csrf_token() }}",
                    enfant_id: $("#named").val(),
                    trait: $("#nametrait").val(),
                    date: $("#dateD").val(),
                    autismresult: $("#autismresult").val(),
                },

                cache:false,
                success: function () {
                    //window.location.replace("pagecarsspecialiste.diagnostics.index") ;
                    window.location='http://localhost:8000/pagecarsspecialiste/diagnostics/affiche/'+$("#named").val()
                },
                error: function (request,status,error) {
                    console.log(request);
                    console.log(error);
                },

            });}

    </script>

    <script>
        /* $('.saveresult').click(function (e) {
            e.preventDefault();
            submitForm();

        }); */
        /* function submitForm() {
            var data =[];
            //radio input
            $("input[type='radio']:checked").each(function () {
                var reponse=new Object();
                reponse.value=$(this).val();
                reponse.name=$(this).attr("name");
                reponse.text=$(this).siblings('.input-label').text();
                data.push(reponse);
            });
            //infos inputs
            $("input[type!='radio']").each(function () {
                var reponse=new Object();
                reponse.value=$(this).val();
                reponse.name=$(this).attr("name");
                data.push(reponse);
            });
            console.log(data);
            // sendData(data);
        }

        function sendData(data) {
            var jsonString=JSON.stringify(data);
            $.ajax({
                type:"POST",
                url:"/pagecarsspecialiste/diagnostics",
                @csrf


        data: {data : jsonString},
        cache:false,
        success: function () {
            alert("ok");

        },
        error: function (request,status,error) {
            console.log(request);
            console.log(error);
        }
    });}

*/



    </script>



    <script type="text/javascript">
        $("#nametrait").select2({
            placeholder: "اختر ",
            allowClear: true
        });
    </script>



    <!-- jQuery -->



                                    </div></div></div></div></div></div></div></section></div>
@endsection
