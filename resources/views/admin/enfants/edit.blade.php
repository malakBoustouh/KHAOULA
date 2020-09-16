@extends('layouts.admin')
@section('title','|تعديل بيانات الطفل')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">تعديل بيانات الطفل</h1>
                </div><!-- /.col -->

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <form  method="post" action="{{route('admin.enfants.update',$enfant->id_enfant)}}" enctype="multipart/form-data" >
            @method('PUT')
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <section class="content">
                <div class="container-fluid">

                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">بيانات الطفل</h3>
                                </div>

                                <!-- /.card-header -->
                                <div class="card-body">

                                    @if($enfant->id_enfant == $parentt->enfant_id)
                                        <div class="form-group">

                                            @if($enfant->image)
                                                <img id="img" src="{{ asset('storage/enfants/'.$enfant->image) }}" height=100 width=100><br>
                                                <input id="takephoto" type="button" value="تغيير الصورة" onclick="document.getElementById('child').click();" />
                                                <input type="file"  style="display:none;" id="child" name="imageChild" />
                                            @endif
                                        </div>


                                        <div class="form-group">
                                            <label>اللقب :</label>

                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-child "></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="prenomEnf" value="{{$enfant->prenom}}" >

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>الإسم :</label>

                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-child "></i></span>


                                                </div>
                                                <input type="text" class="form-control" name="nomEnf" value="{{$enfant->nom}}">

                                            </div>
                                        </div>




                                        <div class="form-group">
                                            <label> الجنس :</label>


                                            <select class="form-control" name="sexe" >
                                                <option selected>{{$enfant->sexe}}</option>
                                                @if($enfant->sexe=="أنثى")
                                                    <option sexe=" ذكر"> ذكر</option>
                                                @else
                                                    <option sexe="أنثى"> أنثى</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>  تاریخ الميلاد :</label>

                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                </div>
                                                <input type="date" class="form-control ltr" name="dateNaissance" value="{{$enfant->dateNaissance}}" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask>
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                        <div class="form-group">
                                            <label>مكان الميلاد :</label>

                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-map-marker"></i>
                                                    </span>


                                                </div>
                                                <input type="text" class="form-control" name="lieuNaissannce" value="{{$enfant->lieuNaissannce}}" >

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label> زمرة الدم :</label>
                                            <select class="form-control" name="groupage" value="{{$enfant->groupage}}">
                                                <option  selected>{{$enfant->groupage}}</option>

                                                @if($enfant->groupage=="+A")
                                                    <option groupage="-A"> -A</option>
                                                    <option groupage="+B"> +B</option>
                                                    <option groupage="-B"> -B</option>
                                                    <option groupage="+AB"> +AB</option>
                                                    <option groupage="-AB"> -AB</option>
                                                    <option groupage="+O"> +O</option>
                                                    <option groupage="-O"> -O</option>
                                                @elseif($enfant->groupage=="+B")
                                                    <option groupage="+A"> +A</option>
                                                    <option groupage="-A"> -A</option>
                                                    <option groupage="-B"> -B</option>
                                                    <option groupage="+AB"> +AB</option>
                                                    <option groupage="-AB"> -AB</option>
                                                    <option groupage="+O"> +O</option>
                                                    <option groupage="-O"> -O</option>
                                                @elseif($enfant->groupage=="+AB")
                                                    <option groupage="-A"> -A</option>
                                                    <option groupage="+B"> +B</option>
                                                    <option groupage="-B"> -B</option>
                                                    <option groupage="+A"> +A</option>
                                                    <option groupage="-AB"> -AB</option>
                                                    <option groupage="+O"> +O</option>
                                                    <option groupage="-O"> -O</option>
                                                @elseif($enfant->groupage=="+O")
                                                    <option groupage="-A"> -A</option>
                                                    <option groupage="+B"> +B</option>
                                                    <option groupage="-B"> -B</option>
                                                    <option groupage="+AB"> +AB</option>
                                                    <option groupage="-AB"> -AB</option>
                                                    <option groupage="+A"> +A</option>
                                                    <option groupage="-O"> -O</option>
                                                @elseif($enfant->groupage=="-A")
                                                    <option groupage="+A"> +A</option>
                                                    <option groupage="+B"> +B</option>
                                                    <option groupage="-B"> -B</option>
                                                    <option groupage="+AB"> +AB</option>
                                                    <option groupage="-AB"> -AB</option>
                                                    <option groupage="+O"> +O</option>
                                                    <option groupage="-O"> -O</option>
                                                @elseif($enfant->groupage=="-B")
                                                    <option groupage="-A"> -A</option>
                                                    <option groupage="+B"> +B</option>
                                                    <option groupage="+A"> +A</option>
                                                    <option groupage="+AB"> +AB</option>
                                                    <option groupage="-AB"> -AB</option>
                                                    <option groupage="+O"> +O</option>
                                                    <option groupage="-O"> -O</option>
                                                @elseif($enfant->groupage=="-AB")
                                                    <option groupage="-A"> -A</option>
                                                    <option groupage="+B"> +B</option>
                                                    <option groupage="-B"> -B</option>
                                                    <option groupage="+AB"> +AB</option>
                                                    <option groupage="+A"> +A</option>
                                                    <option groupage="+O"> +O</option>
                                                    <option groupage="-O"> -O</option>
                                                @elseif($enfant->groupage=="-O")
                                                    <option groupage="-A"> -A</option>
                                                    <option groupage="+B"> +B</option>
                                                    <option groupage="-B"> -B</option>
                                                    <option groupage="+AB"> +AB</option>
                                                    <option groupage="-AB"> -AB</option>
                                                    <option groupage="+O"> +O</option>
                                                    <option groupage="+A"> +A</option>
                                                @endif

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>الولاية  :</label>

                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-map-marker"></i></span>


                                                </div>
                                                <input type="text" class="form-control" name="wilaya" value="{{$enfant->wilaya}}">

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>البلدية  :</label>

                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-map-marker"></i></span>


                                                </div>
                                                <input type="text" class="form-control" name="commune" value="{{$enfant->commune}}">

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>العنوان  :</label>

                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-map-marker"></i></span>


                                                </div>
                                                <input type="text" class="form-control" name="domicile" value="{{$enfant->domicile}}">

                                            </div>
                                        </div>
                                    @endif

                                </div>

                            </div>
                            <!-- /.col (right) -->
                        </div>
                        <!-- /.row -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">بيانات الأولياء</h3>
                                </div>


                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="form-group">
                                        @if($parentt->img)
                                        <img id="father" src="{{ asset('storage/familles/'.$parentt->img) }}" height=100 width=100><br>
                                        <input id="fatherpic" type="button" value=  " صورة الأب" onclick="document.getElementById('fa').click();" />
                                        <input type="file" style="display:none;" id="fa"  name="imageMother1"/>
                                             @endif

                                            @if($parent->img)
                                        <img id="mother" src="{{ asset('storage/familles/'.$parent->img) }}" height=100 width=100><br>
                                        <input id="motherpic" type="button" value=  " صورة الأم" onclick="document.getElementById('ma').click();" />
                                        <input type="file" style="display:none;" id="ma"  name="imageMother2"/>
                                  @endif
                                    </div>
                                    <div class="form-group">
                                        <label>إسم الأب :</label>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-user"></i></span>


                                            </div>
                                            <input type="text" class="form-control"  name="prenomp1" value="{{$parentt->prenomp}}">
                                            <input type="text" class="form-control"  name="nomp1" value="{{$enfant->prenom}}" hidden>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label>المستوى الدراسي :</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-graduation-cap"></i></span>

                                                    </div>
                                                    <input type="text" class="form-control"  name="niveauEducp1" value="{{$parentt->niveauEduc}}">

                                                </div>
                                            </div>

                                            <div class="form-group">

                                                <label>رقم الهاتف :</label>

                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-phone"></i></span>


                                                    </div>
                                                    <input type="text" class="form-control"   name="numTelp1" value="{{$parentt->numTel}}">

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>البريد الإلكتروني :</label>

                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                                    </div>
                                                    <input type="email" class="form-control"  name="emailp1" value="{{$parentt->email}}">

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>إسم الأم :</label>

                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="prenomp2"  value="{{$parent->prenomp}}">

                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <label>المستوى الدراسي :</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-graduation-cap"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control"  name="niveauEducp2" value="{{$parent->niveauEduc}}">

                                                </div>
                                            </div>

                                            <div class="form-group">

                                                <label>رقم الهاتف :</label>

                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control"  name="numTelp2" value="{{$parent->numTel}}">

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>البريد الإلكتروني :</label>

                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>

                                                    </div>
                                                    <input type="email" class="form-control" name="emailp2"  value="{{$parent->email}}">

                                                </div>
                                            </div>


                                        </div>
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label>  تاریخ الميلاد :</label>

                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                    <input type="date" class="form-control ltr"  name="dateNaissancep1" value="{{$parentt->dateNaissancep}}" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask>
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label>عنوان العمل :</label>

                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-map-marker"></i></span>

                                                        </div>
                                                        <input type="text" class="form-control"  name="lieuTravailp1" value="{{$parentt->lieuTravail}}">

                                                    </div>

                                                </div>
                                                <div class="form-group">
                                                    <label> كلمة المرور :</label>

                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" name="motpassp1" value="{{$parentt->motpass}}" >

                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label>اللقب :</label>

                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control"  name="nomp2" value="{{$parent->nomp}}">

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>  تاریخ الميلاد :</label>

                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                        <input type="date" class="form-control ltr"  name="dateNaissancep2" value="{{$parent->dateNaissancep}}" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask>
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label>عنوان العمل :</label>

                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control"  name="lieuTravailp2" value="{{$parent->lieuTravail}}">

                                                        </div>

                                                    </div>
                                                    <div class="form-group">
                                                        <label> كلمة المرور :</label>

                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fa fa-lock"></i></span>


                                                            </div>
                                                            <input type="text" class="form-control"  name="motpassp2" value="{{$parent->motpass}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="card card-default">
                                                <button type="submit" class="btn btn-success btn-block"  >حفظ</button>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            {!! Html::linkRoute('admin.enfants.index', 'الغاء', array($parentt->id_parentt), array('class' => 'btn btn-danger btn-block')) !!}
                                        </div>
                                    </div>

                                </div>


                            </div></div></div>

                </div></section>



            <!-- /.content -->



            <!-- ./wrapper -->
            <script>
                window.addEventListener('load', function() {
                    document.querySelector('#child').addEventListener('change', function() {
                        if (this.files && this.files[0]) {
                            var img = document.querySelector('#img');
                            img.src = URL.createObjectURL(this.files[0]);
                            img.onload = imageIsLoaded;
                        }
                    });
                });
                window.addEventListener('load', function() {
                    document.querySelector('#ma').addEventListener('change', function() {
                        if (this.files && this.files[0]) {
                            var img = document.querySelector('#mother');
                            img.src = URL.createObjectURL(this.files[0]);
                            img.onload = imageIsLoaded;
                        }
                    });
                });
                window.addEventListener('load', function() {
                    document.querySelector('#fa').addEventListener('change', function() {
                        if (this.files && this.files[0]) {
                            var img = document.querySelector('#father');
                            img.src = URL.createObjectURL(this.files[0]);
                            img.onload = imageIsLoaded;
                        }
                    });
                });
            </script>
        </form></div>
    <!-- jQuery -->

@endsection



