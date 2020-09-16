@extends('layouts.admin')
@section('title','| تسجيل مشخص')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">اضافة مشخص</h1>
                </div><!-- /.col -->

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-default">
                    <form method="post" action="{{route('admin.carsSpecialistes.store')}}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <!-- /.card-header -->
                        <div class="card-body">

                            <img id="traitant" src="{{ asset('dist/img/teacher.png')}}" height=100 width=100><br>
                            <input id="traitantpic" type="button" value=  " صورة المشخص" onclick="document.getElementById('t').click();" />
                            <input type="file" style="display:none;" id="t" name="imagespecialiste"/>
                            <div class="row">
                                <div class="col-md-6">


                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>اللقب :</label>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-user"></i></span>

                                            </div>
                                            <input type="text" class="form-control" name="nom">

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>الإسم :</label>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="prenom">

                                        </div>
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
                                        <label>العنوان  :</label>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="address">

                                        </div>
                                    </div>

                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>التخصص :</label>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-briefcase"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="specialite">

                                        </div>

                                    </div>
                                    <div class="form-group">

                                        <label>رقم الهاتف :</label>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="numTel">

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>البريد الإلكتروني :</label>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-envelope"></i></span>

                                            </div>
                                            <input type="email" class="form-control" name="email">

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label> كلمة المرور :</label>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-lock"></i></span>

                                            </div>
                                            <input type="text" class="form-control" name="motpass">

                                        </div>
                                    </div>




                                </div>
                                <!-- /.col (right) -->

                            </div>
                            <!-- /.row -->
                        </div><!-- /.container-fluid -->

                        <div class="card card-default">
                            <button type="submit" class="btn btn-primary" >تسجيل</button>
                        </div>
                    </form>

                </div>
            </div>
        </section>
        <script>
            window.addEventListener('load', function() {
                document.querySelector('#t').addEventListener('change', function() {
                    if (this.files && this.files[0]) {
                        var img = document.querySelector('#traitant');
                        img.src = URL.createObjectURL(this.files[0]);
                        img.onload = imageIsLoaded;
                    }
                });
            });
        </script>
        <!-- /.content -->
    </div>

    <!-- ./wrapper -->

    <!-- jQuery -->

@endsection
