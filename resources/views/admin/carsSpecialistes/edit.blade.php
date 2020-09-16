@extends('layouts.admin')
@section('title','  |تعديل بيانات المشخص')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">تعديل بيانات المشخص</h1>
                </div><!-- /.col -->

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-default">
                    <form method="post" action="{{route('admin.carsSpecialistes.update',$carsspecialiste->id_carsspecialiste)}}" enctype="multipart/form-data">
                        @method('PUT')
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <!-- /.card-header -->
                        <div class="card-body">

                            @if($carsspecialiste->image)

                                <img id="traitant"  src="{{ asset('storage/specialistes/'.$carsspecialiste->image) }}" height=100 width=100><br>

                                <input id="traitantpic" type="button" value=  "تغيير الصورة" onclick="document.getElementById('t').click();" />
                                <input type="file" style="display:none;" id="t" value="{{$carsspecialiste->image}}" name="image"/>
                            @endif

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
                                            <input type="text" class="form-control" value="{{$carsspecialiste->nom}}" name="nom">

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>الإسم :</label>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                            </div>
                                            <input type="text" class="form-control" value="{{$carsspecialiste->prenom}}" name="prenom">

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>  تاریخ الميلاد :</label>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <input type="date" class="form-control ltr" value="{{$carsspecialiste->dateNaissance}}" name="dateNaissance" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <div class="form-group">
                                        <label>العنوان  :</label>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
                                            </div>
                                            <input type="text" class="form-control" value="{{$carsspecialiste->address}}" name="address">

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
                                            <input type="text" class="form-control" value="{{$carsspecialiste->specialite}}" name="specialite">

                                        </div>

                                    </div>
                                    <div class="form-group">

                                        <label>رقم الهاتف :</label>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                            </div>
                                            <input type="text" class="form-control" value="{{$carsspecialiste->numTel}}" name="numTel">

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>البريد الإلكتروني :</label>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-envelope"></i></span>

                                            </div>
                                            <input type="email" class="form-control" name="email" value="{{$carsspecialiste->email}}">

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label> كلمة المرور :</label>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-lock"></i></span>

                                            </div>
                                            <input type="text" class="form-control" name="motpass" value="{{$carsspecialiste->motpass}}">

                                        </div>
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
                                {!! Html::linkRoute('admin.carsSpecialistes.index', 'الغاء', array($carsspecialiste->id_carsspecialiste), array('class' => 'btn btn-danger btn-block')) !!}
                            </div>
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



@endsection
