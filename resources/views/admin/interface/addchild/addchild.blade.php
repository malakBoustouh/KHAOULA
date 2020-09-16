@extends('layouts.admin')
@section('title','| تسجيل طفل')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">اضافة طفل</h1>
                </div><!-- /.col -->

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <form method="post" action="{{route('admin.enfants.store')}}" enctype="multipart/form-data">
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

                                    <img id="img" src="{{ asset('dist/img/child.png')}}" height=100 width=100><br>
                                    <input id="takephoto" type="button" value="اضافة صورة" onclick="document.getElementById('child').click();" />
                                    <input type="file"  style="display:none;" id="child" name="imageChild" />
                                    <div class="form-group">
                                        <label>اللقب :</label>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-child "></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="nom1">

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>الإسم :</label>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-child "></i></span>


                                            </div>
                                            <input type="text" class="form-control" name="nom">

                                        </div>
                                    </div>




                                    <div class="form-group">
                                        <label> الجنس :</label>
                                        <select class="form-control" name="sexe">
                                            <option sexe=" ذكر"> ذكر</option>
                                            <option sexe="أنثى"> أنثى</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>  تاریخ الميلاد :</label>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <input type="date" class="form-control ltr" name="dateNaissance" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask>
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
                                            <input type="text" class="form-control" name="lieuNaissannce">

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label> زمرة الدم :</label>
                                        <select class="form-control" name="groupage">
                                            <option groupage="+A"> +A</option>
                                            <option groupage="-A"> -A</option>
                                            <option groupage="+B"> +B</option>
                                            <option groupage="-B"> -B</option>
                                            <option groupage="+AB"> +AB</option>
                                            <option groupage="-AB"> -AB</option>
                                            <option groupage="+O"> +O</option>
                                            <option groupage="-O"> -O</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>الولاية  :</label>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-map-marker"></i></span>


                                            </div>
                                            <input type="text" class="form-control" name="wilaya">

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>البلدية  :</label>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-map-marker"></i></span>


                                            </div>
                                            <input type="text" class="form-control" name="commune">

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>العنوان  :</label>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-map-marker"></i></span>


                                            </div>
                                            <input type="text" class="form-control" name="domicile">

                                        </div>
                                    </div>
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

                                    <img id="father" src="{{ asset('dist/img/father.png')}}" height=100 width=100><br>
                                    <input id="fatherpic" type="button" value=  " صورة الأب" onclick="document.getElementById('fa').click();" />
                                    <input type="file" style="display:none;" id="fa" name="imageMother1"/>

                                    <img id="mother" src="{{asset('dist/img/mother.png')}}" height=100 width=100><br>
                                    <input id="motherpic" type="button" value=  " صورة الأم" onclick="document.getElementById('ma').click();" />
                                    <input type="file" style="display:none;" id="ma" name="imageMother2"/>
                                    <div class="form-group">

                                        <label>إسم الأب :</label>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-user"></i></span>


                                            </div>
                                            <input type="text" class="form-control"  name="prenom1">

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
                                                    <input type="text" class="form-control" name="niveauEduc1">

                                                </div>
                                            </div>

                                            <div class="form-group">

                                                <label>رقم الهاتف :</label>

                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-phone"></i></span>


                                                    </div>
                                                    <input type="text" class="form-control"  name="numTel1">

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>البريد الإلكتروني :</label>

                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                                    </div>
                                                    <input type="email" class="form-control" name="email1">

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>إسم الأم :</label>

                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="prenom2">

                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <label>المستوى الدراسي :</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-graduation-cap"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="niveauEduc2">

                                                </div>
                                            </div>

                                            <div class="form-group">

                                                <label>رقم الهاتف :</label>

                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="numTel2">

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>البريد الإلكتروني :</label>

                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>

                                                    </div>
                                                    <input type="email" class="form-control" name="email2">

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
                                                    <input type="date" class="form-control ltr" name="dateNaissance1" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask>
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
                                                        <input type="text" class="form-control" name="lieuTravail1">

                                                    </div>

                                                </div>
                                                <div class="form-group">
                                                    <label> كلمة المرور :</label>

                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" name="motpass1">

                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label>اللقب :</label>

                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" name="nom2">

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>  تاریخ الميلاد :</label>

                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                        </div>
                                                        <input type="date" class="form-control ltr" name="dateNaissance2" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask>
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
                                                            <input type="text" class="form-control" name="lieuTravail2">

                                                        </div>

                                                    </div>
                                                    <div class="form-group">
                                                        <label> كلمة المرور :</label>

                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fa fa-lock"></i></span>


                                                            </div>
                                                            <input type="text" class="form-control" name="motpass2">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-default">
                                        <button type="submit" class="btn btn-primary" >تسجيل</button>
                                    </div>
                                </div>

                            </div></div></div></div></section>



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



