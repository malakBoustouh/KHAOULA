@extends('layouts.admin')
@section('title',' | عرض المعلومات الشخصية ')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Style -->
    @include('partials._zoom')
    <!-- /.Style -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#child" data-toggle="tab">البيانات الشخصية</a></li>
                                </ul>
                                <div class="tab-content">

                                    <div class="active tab-pane" id="child">
                                        <div class="post">
                                            <div class="text-center">
                                                @if($traitant->image)
                                                    <input type="checkbox" id="zoomCheck">
                                                    <label for="zoomCheck">
                                                        <img src="{{ asset('storage/traitants/'.$traitant->image) }}" class="profile-user-img img-fluid img-circle">
                                                    </label>
                                                @else
                                                    <img class="profile-user-img img-fluid img-circle"
                                                         src="{{ asset('dist/img/teacher.png')}}"
                                                         alt="صورة معالج">
                                                @endif
                                            </div>
                                            <br>
                                            <h3 class="profile-username text-center childname">{{$traitant->nom}} {{$traitant->prenom}}</h3>
                                            <ul class="list-group list-group-unbordered mb-3">
                                                <li class="list-group-item">
                                                    <b>العمر:</b> <a>{{$calculeAgeTrt}} {{"سنة"}}</a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b> البريد الالكتروني:</b> <a>{{$traitant->numTel}}</a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b> رقم الهاتف:</b> <a>{{$traitant->email}}</a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b> التخصص:</b> <a>{{$traitant->specialiste}}</a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b> العنوان:</b> <a>{{$traitant->address}}</a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b> رقم السري:</b> <a>{{$traitant->motpass}}</a>
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
                    <div class="col-md-4" >

                        <div class="col-md-12">
                            <div class=" card-primary">
                                <div class="card bg-light mb-3" style="max-width: 18rem;margin-right: 70px;">
                                    <div class="card-header">
                                        <div class="well">
                                            <div class="form-group" >
                                                <dl class="dl-horizontal" >
                                                    <dt >بتاريخ :</dt>
                                                    <dd>{{ date('M j, Y h:ia', strtotime($traitant->created_at)) }}</dd>
                                                </dl>
                                            </div>

                                            <dl class="dl-horizontal" >
                                                <dt>اخر تعديل:</dt>
                                                <dd >{{ date('M j, Y h:ia', strtotime($traitant->updated_at)) }}</dd>
                                            </dl>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    {!! Html::linkRoute('admin.traitants.edit', 'تعديل', array($traitant->id_traitant), array('class' => 'btn btn-primary btn-block')) !!}
                                                </div>
                                                <div class="col-sm-6">
                                                    {!! Html::linkRoute('admin.traitants.destroy', 'حذف', array($traitant->id_traitant), array('class' => 'btn btn-danger btn-block')) !!}
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                {!! Html::linkRoute('admin.traitants.index', 'رجوع>>',[], array('class' => 'btn btn-default btn-block btn-h1-spacing')) !!}
                                            </div>

                                        </div>

                                    </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                </div></div></section>



    </div>

@endsection
