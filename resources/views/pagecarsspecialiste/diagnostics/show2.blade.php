@extends('layouts.specialistes')
@section('title','| ملف الطفل')
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
                                                    <b>العمر:</b> <a> {{$age}}{{"سنة"}}</a>
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
                                    <li class="nav-item"><a class="nav-link active" href="#diagnostic" data-toggle="tab">التشخيص</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#traite" data-toggle="tab" >إضافة حصة معالجة</a></li>


                                </ul>

                                <div class="card-body">

                                </div><!-- /.card-header -->

                                <div class="tab-content">
                                    <div class="active tab-pane" id="diagnostic">
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
                                                                    <tr   data-href="{{route('pagecarsspecialiste.diagnostics.show',$h->id)}}"  style="cursor: pointer;">
                                                                        <td>{{$h->date}}</td>
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
                                                 {{$diagnostics->render()}}
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="traite">
                                        <div class="card">
                                            <div class="card-body table-responsive p-0">
                                                <div class="card-header">
                                                    <h3 class="card-title">المعلومات</h3>
                                                </div>
                                                <form method="post" action="{{route('pagecarsspecialiste.diagnostics.store')}}" enctype="multipart/form-data">
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
                                                                        <select   class="form-control" style="width: 324.56px" id="named" name="enfant_id" >
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
                                                                        <select   style="width: 324.56px" id="nameid" name="enf_id" >
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
                </div></div> </section></div>

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
