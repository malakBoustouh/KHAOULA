@extends('layouts.admin')
@section('title','  |تعديل معلومات المعالج')
@section('content')
    <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">تعديل معالج</h1>
                </div><!-- /.col -->

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-default">
                    <form  method="post" action="{{route('admin.traitants.update',$traitant->id_traitant)}}" enctype="multipart/form-data" >
                        @method('PUT')
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if($traitant->image)

                            <img id="traitant"  src="{{ asset('storage/traitants/'.$traitant->image) }}" height=100 width=100><br>

                            <input id="traitantpic" type="button" value=  "تغيير الصورة" onclick="document.getElementById('t').click();" />
                            <input type="file" style="display:none;" id="t" value="{{$traitant->image}}" name="image"/>
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
                                            <input type="text" class="form-control" name="prenom" value="{{$traitant->prenom}}" >

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>الإسم :</label>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-user"></i></span>

                                            </div>
                                            <input type="text" class="form-control" name="nom" value="{{$traitant->nom}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>  تاریخ الميلاد :</label>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <input type="text" class="form-control ltr" name="dateNaissance" value="{{$traitant->dateNaissance}}" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <div class="form-group">
                                        <label>العنوان  :</label>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-map-marker"></i></span>

                                            </div>
                                            <input type="text" class="form-control" name="address" value="{{$traitant->address}}">


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
                                            <input type="text" class="form-control" name="specialiste" value="{{$traitant->specialiste}}">

                                        </div>

                                    </div>
                                    <div class="form-group">

                                        <label>رقم الهاتف :</label>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-phone"></i></span>

                                            </div>
                                            <input type="text" class="form-control" name="numTel" value="{{$traitant->numTel}}">

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>البريد الإلكتروني :</label>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-envelope"></i></span>


                                            </div>
                                            <input type="email" class="form-control" name="email"value="{{$traitant->email}}">

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label> كلمة المرور :</label>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-lock"></i></span>


                                            </div>
                                            <input type="text" class="form-control" name="motpass" value="{{$traitant->motpass}}" >

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
                                {!! Html::linkRoute('admin.traitants.index', 'الغاء', array($traitant->id_traitant), array('class' => 'btn btn-danger btn-block')) !!}
                            </div>
                        </div>

                    </form>

                </div></div></section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
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



    <!-- jQuery -->


@endsection
