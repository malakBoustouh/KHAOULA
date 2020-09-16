@extends('layouts.specialistes')

@section('title','| تشخيص')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    {{-- <form method="post" action="{{route('pagecarsspecialiste.diagnostics.update',$diagnostic->id)}}" enctype="multipart/form-data">--}}
    {{-- @method('PUT')--}}

   {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
        {{-- @csrf--}}
    @csrf
             <!-- Main content -->
             <section class="content">
                 <div class="container-fluid">
                     <!-- left column -->
                     <!-- general form elements -->
                     <div class="card card-primary">
                         <div class="card-header">
                             <h3 class="card-title">البيانات</h3>
                         </div>

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
                                     <input type="hidden" name="id" id="idDiagnostic" value="{{$diagnostic->id}}">
                                     <div class="form-group" >
                                         <label> الإسم :</label>
                                         <div class="input-group">
                                             <div class="input-group-prepend">
                                                 <span class="input-group-text"><i class="fa fa-child"></i></span>
                                             </div>

                                             <select   class="form-control" style="width: 470px" id="named" name="enfant_id" >
                                                 <option  value="{{$enfant->id_enfant}}"  selected readonly>{{$enfant->nom}}</option>

                                             </select>

                                         </div>
                                     </div>
                                     <div class="form-group">

                                         <label>تاريخ الميلاد  :</label>

                                         <div class="input-group">
                                             <div class="input-group-prepend">
                                                 <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                             </div>
                                             <select   class="form-control" style="width: 466.5px" id="birthday" name="enfa_id"   >

                                                 <option value="{{$enfant->id_enfant}}" selected readonly>{{$enfant->dateNaissance}}</option>

                                             </select>

                                         </div>
                                     </div>
                                     <div class="form-group">

                                         <label> المشرفة  :</label>

                                         <div class="input-group">
                                             <div class="input-group-prepend">
                                                 <span class="input-group-text"><i class="fa fa-user"></i></span>
                                             </div>

                                             <select   style="width: 468px" id="nametrait" name="speciale_id" >
                                                 <option  value="{{$carsspecialiste->id_carsspecialiste}}" selected readonly>{{$carsspecialiste->nom}} {{$carsspecialiste->prenom}}</option>
                                             </select>

                                         </div>
                                     </div>

                                 </div>
                                 <div class="col-md-6">
                                     <div class="form-group">

                                         <label> اللقب  :</label>

                                         <div class="input-group">
                                             <div class="input-group-prepend">
                                                 <span class="input-group-text"><i class="fa fa-child"></i></span>
                                             </div>
                                             <select   style="width: 470px" id="nameid" name="enf_id" >
                                                 <option value="{{$enfant->id_enfant}}" selected readonly>{{$enfant->prenom}}</option>
                                             </select>

                                         </div>
                                     </div>
                                     <div class="form-group">

                                         <label> تاريخ تطبيق المقياس  :</label>

                                         <div class="input-group">
                                             <div class="input-group-prepend">
                                                 <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                             </div>
                                             <input type="date" class="form-control" value="{{$diagnostic->dateDiagnostic}}" name="date">

                                         </div>
                                     </div>
                                     <div class="form-group">

                                         <label > النتيجة  :</label>

                                         <div class="input-group">
                                             <div class="input-group-prepend">
                                                 <span class="input-group-text"><i class="fa fa-commenting-o" ></i></span>
                                             </div>
                                             <input type="text" readonly class="form-control"  id="autismresult"  name="autismresult" value="{{$diagnostic->niveau}}" >
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
                                     <h3 class="card-title">العلاقات مع الآخرين</h3>
                                 </div>
                                 <!-- /.card-header -->
                                 <div class="card-body">

                                     <!-- radio -->
                                     <div class="form-group">
                                         <label class="container">
                                             <input type="radio" name="r1" class="minimal" {{ ($detail13->numResponses=="1")? "checked" : "" }} value="1">
                                             لا يوجد أي دلالة أو صعوبة في التعامل مع الآخرين.
                                             <span class="checkmark"></span>
                                         </label>
                                     </div>

                                     <div class="form-group">
                                         <label class="container"> ---
                                             <input type="radio" name="r1" class="minimal"  {{ ($detail13->numResponses=="1.5")? "checked" : "" }}  value="1.5">
                                             <span class="checkmark"></span>
                                         </label>
                                     </div>

                                     <div class="form-group">
                                         <label class="container">
                                             <input type="radio" name="r1" class="minimal" {{ ($detail13->numResponses=="2")? "checked" : "" }} value="2" >
                                             علاقات غير عادية بدرجة بسيطة.
                                             <span class="checkmark"></span>
                                         </label>
                                     </div>

                                     <div class="form-group">
                                         <label class="container"> ---
                                             <input type="radio" name="r1" class="minimal" {{ ($detail13->numResponses=="2.5")? "checked" : "" }} value="2.5">
                                             <span class="checkmark"></span>
                                         </label>
                                     </div>

                                     <div class="form-group">
                                         <label class="container">
                                             <input type="radio" name="r1" class="minimal" {{ ($detail13->numResponses=="3")? "checked" : "" }} value="3" >
                                             علاقات غير عادية بدرجة متوسطة.
                                             <span class="checkmark"></span>
                                         </label>
                                     </div>

                                     <div class="form-group">
                                         <label class="container"> ---
                                             <input type="radio" name="r1" class="minimal" {{ ($detail13->numResponses=="3.5")? "checked" : "" }} value="3.5">
                                             <span class="checkmark"></span>
                                         </label>
                                     </div>

                                     <div class="form-group">
                                         <label class="container">
                                             <input type="radio" name="r1" class="minimal" {{ ($detail13->numResponses=="4")? "checked" : "" }} value="4" >
                                             علاقات غير عادية بدرجة شديدة.
                                             <span class="checkmark"></span>
                                         </label>
                                     </div>

                                     <div class="form-group">
                                         <label>
                                             ملاحظات :
                                         </label>
                                         <textarea class="remarquearea" rows="4" cols="56,5"></textarea>
                                     </div>

                                 </div>
                             </div>
                         </div>

                         <div class="col-md-6">

                             <div class="card card-warning">
                                 <div class="card-header">
                                     <h3 class="card-title"> التقليد</h3>
                                 </div>
                                 <!-- /.card-header -->
                                 <div class="card-body">

                                     <!-- radio -->
                                     <div class="form-group">
                                         <label class="container">
                                             <input type="radio" name="r2" {{ ($detail14->numResponses=="1")? "checked" : "" }} class="minimal" value="1">
                                             التقليد المناسب.
                                             <span class="checkmark"></span>
                                         </label>
                                     </div>

                                     <div class="form-group">
                                         <label class="container"> ---
                                             <input type="radio" name="r2" {{ ($detail14->numResponses=="1.5")? "checked" : "" }} class="minimal" value="1.5">
                                             <span class="checkmark"></span>
                                         </label>
                                     </div>

                                     <div class="form-group">
                                         <label class="container">
                                             <input type="radio" name="r2" {{ ($detail14->numResponses=="2")? "checked" : "" }} class="minimal" value="2" >
                                             التقليد غير العادي من الدرجة البسيطة.
                                             <span class="checkmark"></span>
                                         </label>
                                     </div>

                                     <div class="form-group">
                                         <label class="container"> ---
                                             <input type="radio" name="r2" class="minimal" {{ ($detail14->numResponses=="2.5")? "checked" : "" }} value="2.5">
                                             <span class="checkmark"></span>
                                         </label>
                                     </div>

                                     <div class="form-group">
                                         <label class="container">
                                             <input type="radio" name="r2" class="minimal" {{ ($detail14->numResponses=="3")? "checked" : "" }} value="3" >
                                             التقليد غير العادي من الدرجة المتوسطة.
                                             <span class="checkmark"></span>
                                         </label>
                                     </div>

                                     <div class="form-group">
                                         <label class="container"> ---
                                             <input type="radio" name="r2" class="minimal" {{ ($detail14->numResponses=="3.5")? "checked" : "" }} value="3.5">
                                             <span class="checkmark"></span>
                                         </label>
                                     </div>

                                     <div class="form-group">
                                         <label class="container">
                                             <input type="radio" name="r2" class="minimal" {{ ($detail14->numResponses=="4")? "checked" : "" }} value="4" >
                                             التقليد غير العادي من الدرجة الشديدة.
                                             <span class="checkmark"></span>
                                         </label>
                                     </div>

                                     <div class="form-group">
                                         <label>
                                             ملاحظات :
                                         </label>
                                         <textarea class="remarquearea" rows="4" cols="56,5"></textarea>
                                     </div>
                                 </div>
                             </div>
                         </div>


                         <div class="row">

                             <div class="col-md-6">
                                 <!-- general form elements -->
                                 <div class="card card-danger">
                                     <div class="card-header">
                                         <h3 class="card-title">الإستجابة الإنفعالية</h3>
                                     </div>
                                     <!-- /.card-header -->
                                     <div class="card-body">

                                         <!-- radio -->
                                         <div class="form-group">
                                             <label class="container">
                                                 <input type="radio" name="r3" class="minimal"  {{ ($detail12->numResponses=="1")? "checked" : "" }} value="1">
                                                 إستجابات إنفعالية مناسبة للمواقف و العمر.
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container"> ---
                                                 <input type="radio" name="r3" class="minimal" {{ ($detail12->numResponses=="1.5")? "checked" : "" }}  value="1.5">
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container">
                                                 <input type="radio" name="r3" class="minimal" {{ ($detail12->numResponses=="2")? "checked" : "" }} value="2" >
                                                 إستجابات إنفعالية غير عادية من الدرجة البسيطة.
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container"> ---
                                                 <input type="radio" name="r3" class="minimal" {{ ($detail12->numResponses=="2.5")? "checked" : "" }} value="2.5">
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container">
                                                 <input type="radio" name="r3" {{ ($detail12->numResponses=="3")? "checked" : "" }} class="minimal" value="3" >
                                                 إستجابات إنفعالية غير عادية من الدرجة المتوسطة.
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container"> ---
                                                 <input type="radio" name="r3" class="minimal" {{ ($detail12->numResponses=="3.5")? "checked" : "" }} value="3.5">
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container">
                                                 <input type="radio" name="r3" class="minimal" {{ ($detail12->numResponses=="4")? "checked" : "" }} value="4" >
                                                 إستجابات إنفعالية غير عادية من الدرجة الشديدة.
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label>
                                                 ملاحظات :
                                             </label>
                                             <textarea class="remarquearea" rows="4" cols="56,5"></textarea>
                                         </div>

                                     </div>
                                 </div>
                             </div>
                             <!-- general form elements -->

                             <div class="col-md-6">

                                 <div class="card card-success">
                                     <div class="card-header">
                                         <h3 class="card-title">إستخدام الجسم</h3>
                                     </div>
                                     <!-- /.card-header -->
                                     <div class="card-body">

                                         <!-- radio -->
                                         <div class="form-group">
                                             <label class="container">
                                                 <input type="radio" name="r4" class="minimal" {{ ($detail11->numResponses=="1")? "checked" : "" }} value="1">
                                                 إستخدام الجسم بشكل مناسب لعمر الطفل.
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container"> ---
                                                 <input type="radio" name="r4" class="minimal" {{ ($detail11->numResponses=="1.5")? "checked" : "" }} value="1.5">
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container">
                                                 <input type="radio" name="r4" class="minimal" {{ ($detail11->numResponses=="2")? "checked" : "" }} value="2" >
                                                 إستخدام غير عادي للجسم من الدرجة البسيطة.
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container"> ---
                                                 <input type="radio" name="r4" class="minimal" {{ ($detail11->numResponses=="2.5")? "checked" : "" }} value="2.5">
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container">
                                                 <input type="radio" name="r4" class="minimal" {{ ($detail11->numResponses=="3")? "checked" : "" }} value="3" >
                                                 إستخدام غير عادي للجسم من الدرجة المتوسطة.
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container"> ---
                                                 <input type="radio" name="r4" class="minimal" {{ ($detail11->numResponses=="3.5")? "checked" : "" }} value="3.5">
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container">
                                                 <input type="radio" name="r4" class="minimal" {{ ($detail11->numResponses=="4")? "checked" : "" }} value="4" >
                                                 إستخدام غير عادي للجسم من الدرجة الشديدة.
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label>
                                                 ملاحظات :
                                             </label>
                                             <textarea class="remarquearea" rows="4" cols="56,5"></textarea>
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
                                         <h3 class="card-title">إستخدام الأشياء</h3>
                                     </div>
                                     <!-- /.card-header -->
                                     <div class="card-body">

                                         <!-- radio -->
                                         <div class="form-group">
                                             <label class="container">
                                                 <input type="radio" name="r5" class="minimal" {{ ($detail10->numResponses=="1")? "checked" : "" }} value="1">
                                                 الإستخدام المناسب و الإستمتاع بالألعاب و الأشياء الأخرى.
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container"> ---
                                                 <input type="radio" name="r5" class="minimal" {{ ($detail10->numResponses=="1.5")? "checked" : "" }} value="1.5">
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container">
                                                 <input type="radio" name="r5" class="minimal" {{ ($detail10->numResponses=="2")? "checked" : "" }} value="2" >
                                                 الإستخدام و الإستمتاع غير المناسب في الألعاب والأشياء الأخرى من الدرجة البسيطة.
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container"> ---
                                                 <input type="radio" name="r5" class="minimal" {{ ($detail10->numResponses=="2.5")? "checked" : "" }} value="2.5">
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container">
                                                 <input type="radio" name="r5" class="minimal" {{ ($detail10->numResponses=="3")? "checked" : "" }} value="3" >
                                                 الإستخدام و الإستمتاع غير المناسب في الألعاب والأشياء الأخرى من الدرجة المتوسطة.
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container"> ---
                                                 <input type="radio" name="r5" class="minimal" {{ ($detail10->numResponses=="3.5")? "checked" : "" }} value="3.5">
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container">
                                                 <input type="radio" name="r5" class="minimal" {{ ($detail10->numResponses=="4")? "checked" : "" }} value="4" >
                                                 الإستخدام و الإستمتاع غير المناسب في الألعاب والأشياء الأخرى من الدرجة الشديدة.
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label>
                                                 ملاحظات :
                                             </label>
                                             <textarea class="remarquearea" rows="4" cols="56,5"></textarea>
                                         </div>

                                     </div>
                                 </div>
                             </div>
                             <!-- general form elements -->

                             <div class="col-md-6">

                                 <div class="card card-warning">
                                     <div class="card-header">
                                         <h3 class="card-title"> التكيف للتغير</h3>
                                     </div>
                                     <!-- /.card-header -->
                                     <div class="card-body">
                                         <!-- radio -->
                                         <div class="form-group">
                                             <label class="container">
                                                 <input type="radio" name="r6" class="minimal" {{ ($detail9->numResponses=="1")? "checked" : "" }} value="1">
                                                 الإستجابة للتغير مناسبة لعمر الطفل.
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container"> ---
                                                 <input type="radio" name="r6" class="minimal" {{ ($detail9->numResponses=="1.5")? "checked" : "" }} value="1.5">
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container">
                                                 <input type="radio" name="r6" class="minimal" {{ ($detail9->numResponses=="2")? "checked" : "" }} value="2" >
                                                 تكيف غير مناسب بدرجة بسيطة للتغيير.
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container"> ---
                                                 <input type="radio" name="r6" class="minimal"  {{ ($detail9->numResponses=="2.5")? "checked" : "" }} value="2.5">
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container">
                                                 <input type="radio" name="r6" class="minimal" {{ ($detail9->numResponses=="3")? "checked" : "" }} value="3" >
                                                 تكيف غير مناسب بدرجة متوسطة للتغيير.
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container"> ---
                                                 <input type="radio" name="r6" class="minimal" {{ ($detail9->numResponses=="3.5")? "checked" : "" }} value="3.5">
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container">
                                                 <input type="radio" name="r6" class="minimal" {{ ($detail9->numResponses=="4")? "checked" : "" }} value="4" >
                                                 تكيف غير مناسب بدرجة شديدة للتغيير.
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label>
                                                 ملاحظات :
                                             </label>
                                             <textarea class="remarquearea" rows="4" cols="56,5"></textarea>
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
                                         <h3 class="card-title">الإستجابة البصرية</h3>
                                     </div>
                                     <!-- /.card-header -->
                                     <div class="card-body">

                                         <!-- radio -->
                                         <div class="form-group">
                                             <label class="container">
                                                 <input type="radio" name="r7" class="minimal" {{ ($detail7->numResponses=="1")? "checked" : "" }} value="1">
                                                 إستجابة بصرية مناسبة للعمر.
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container"> ---
                                                 <input type="radio" name="r7" class="minimal" {{ ($detail8->numResponses=="1.5")? "checked" : "" }} value="1.5">
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container">
                                                 <input type="radio" name="r7" class="minimal" {{ ($detail8->numResponses=="2")? "checked" : "" }} value="2" >
                                                 إستجابة بصرية غير عادية من الدرجة البسيطة.
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container"> ---
                                                 <input type="radio" name="r7" class="minimal" {{ ($detail8->numResponses=="2.5")? "checked" : "" }} value="2.5">
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container">
                                                 <input type="radio" name="r7" class="minimal" {{ ($detail8->numResponses=="3")? "checked" : "" }} value="3" >
                                                 إستجابة بصرية غير عادية من الدرجة المتوسطة.
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container"> ---
                                                 <input type="radio" name="r7" class="minimal" {{ ($detail8->numResponses=="3.5")? "checked" : "" }} value="3.5">
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container">
                                                 <input type="radio" name="r7" class="minimal" {{ ($detail8->numResponses=="4")? "checked" : "" }} value="4" >
                                                 إستجابة بصرية غير عادية من الدرجة الشديدة.
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label>
                                                 ملاحظات :
                                             </label>
                                             <textarea class="remarquearea" rows="4" cols="56,5"></textarea>
                                         </div>

                                     </div>
                                 </div>
                             </div>
                             <!-- general form elements -->

                             <div class="col-md-6">

                                 <div class="card card-success">
                                     <div class="card-header">
                                         <h3 class="card-title">الإستجابة السمعية</h3>
                                     </div>
                                     <!-- /.card-header -->
                                     <div class="card-body">

                                         <!-- radio -->
                                         <div class="form-group">
                                             <label class="container">
                                                 <input type="radio" name="r8" class="minimal" {{ ($detail7->numResponses=="1")? "checked" : "" }} value="1">
                                                 إستجابة سمعية مناسبة لعمر الطفل.
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container"> ---
                                                 <input type="radio" name="r8" class="minimal" {{ ($detail7->numResponses=="1.5")? "checked" : "" }} value="1.5">
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container">
                                                 <input type="radio" name="r8" class="minimal" {{ ($detail7->numResponses=="2")? "checked" : "" }} value="2" >
                                                 إستجابة سمعية غير عادية من الدرجة البسيطة.
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container"> ---
                                                 <input type="radio" name="r8" class="minimal" {{ ($detail7->numResponses=="2.5")? "checked" : "" }} value="2.5">
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container">
                                                 <input type="radio" name="r8" class="minimal" {{ ($detail7->numResponses=="3")? "checked" : "" }} value="3" >
                                                 إستجابة سمعية غير عادية من الدرجة المتوسطة.
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container"> ---
                                                 <input type="radio" name="r8" class="minimal" {{ ($detail7->numResponses=="3.5")? "checked" : "" }} value="3.5">
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container">
                                                 <input type="radio" name="r8" class="minimal" {{ ($detail7->numResponses=="4")? "checked" : "" }} value="4" >
                                                 إستجابة سمعية غير عادية من الدرجة الشديدة.
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label>
                                                 ملاحظات :
                                             </label>
                                             <textarea class="remarquearea" rows="4" cols="56,5"></textarea>
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
                                         <h3 class="card-title">إستجابات اللمس،الشم،التذوق و استخدامها</h3>
                                     </div>
                                     <!-- /.card-header -->
                                     <div class="card-body">

                                         <!-- radio -->
                                         <div class="form-group">
                                             <label class="container">
                                                 <input type="radio" name="r9" {{ ($detail6->numResponses=="1")? "checked" : "" }} class="minimal" value="1">
                                                 الإستجابة و الإستخدام الطبيعي للتذوق،الشم و اللمس.
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container"> ---
                                                 <input type="radio" name="r9" {{ ($detail6->numResponses=="1.5")? "checked" : "" }} class="minimal" value="1.5">
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container">
                                                 <input type="radio" name="r9" class="minimal" {{ ($detail6->numResponses=="2")? "checked" : "" }} value="2" >
                                                 الإستجابة و الإستخدام غير العادي للتذوق،الشم و اللمس
                                                 بدرجة بسيطة.
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container"> ---
                                                 <input type="radio" name="r9" class="minimal" {{ ($detail6->numResponses=="2.5")? "checked" : "" }} value="2.5">
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container">
                                                 <input type="radio" name="r9" class="minimal" {{ ($detail6->numResponses=="3")? "checked" : "" }} value="3" >
                                                 الإستجابة و الإستخدام غير العادي للتذوق،الشم و اللمس
                                                 بدرجة متوسطة.
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container"> ---
                                                 <input type="radio" name="r9" class="minimal" {{ ($detail6->numResponses=="3.5")? "checked" : "" }} value="3.5">
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container">
                                                 <input type="radio" name="r9" class="minimal" {{ ($detail6->numResponses=="4")? "checked" : "" }} value="4" >
                                                 الإستجابة و الإستخدام غير العادي للتذوق،الشم و اللمس
                                                 بدرجة شديدة.
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label>
                                                 ملاحظات :
                                             </label>
                                             <textarea class="remarquearea" rows="4" cols="56,5"></textarea>
                                         </div>

                                     </div>
                                 </div>
                             </div>
                             <!-- general form elements -->

                             <div class="col-md-6">

                                 <div class="card card-warning">
                                     <div class="card-header">
                                         <h3 class="card-title"> الخوف و العصبية</h3>
                                     </div>
                                     <!-- /.card-header -->
                                     <div class="card-body">
                                         <!-- radio -->
                                         <div class="form-group">
                                             <label class="container">
                                                 <input type="radio" name="r10" class="minimal" {{ ($detail5->numResponses=="1")? "checked" : "" }} value="1">
                                                 الخوف أو العصبية بدرجة عادية.
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container"> ---
                                                 <input type="radio" name="r10" class="minimal" {{ ($detail5->numResponses=="1.5")? "checked" : "" }} value="1.5">
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container">
                                                 <input type="radio" name="r10" class="minimal" {{ ($detail5->numResponses=="2")? "checked" : "" }} value="2" >
                                                 خوف أو عصبية غير عادية من الدرجة البسيطة.
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container"> ---
                                                 <input type="radio" name="r10" class="minimal" {{ ($detail5->numResponses=="2.5")? "checked" : "" }} value="2.5">
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container">
                                                 <input type="radio" name="r10" class="minimal" {{ ($detail5->numResponses=="3")? "checked" : "" }} value="3" >
                                                 خوف أو عصبية غير عادية من الدرجة المتوسطة.
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container"> ---
                                                 <input type="radio" name="r10" class="minimal" {{ ($detail5->numResponses=="3.5")? "checked" : "" }} value="3.5">
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container">
                                                 <input type="radio" name="r10" class="minimal" {{ ($detail5->numResponses=="4")? "checked" : "" }} value="4" >
                                                 خوف أو عصبية غير عادية من الدرجة الشديدة.
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label>
                                                 ملاحظات :
                                             </label>
                                             <textarea class="remarquearea" rows="4" cols="56,5"></textarea>
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
                                         <h3 class="card-title">التواصل اللفظي</h3>
                                     </div>
                                     <!-- /.card-header -->
                                     <div class="card-body">

                                         <!-- radio -->
                                         <div class="form-group">
                                             <label class="container">
                                                 <input type="radio" name="r11" class="minimal" {{ ($detail4->numResponses=="1")? "checked" : "" }} value="1">
                                                 تواصل لفظي طبيعي مناسب لعمره الزمني و للمواقف
                                                 التي يمر بها.
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container"> ---
                                                 <input type="radio" name="r11" class="minimal" {{ ($detail4->numResponses=="1.5")? "checked" : "" }} value="1.5">
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container">
                                                 <input type="radio" name="r11" class="minimal" {{ ($detail4->numResponses=="2")? "checked" : "" }} value="2" >
                                                 تواصل لفظي غير عادي من الدرجة البسيطة.
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container"> ---
                                                 <input type="radio" name="r11" class="minimal" {{ ($detail4->numResponses=="2.5")? "checked" : "" }} value="2.5">
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container">
                                                 <input type="radio" name="r11" class="minimal" {{ ($detail4->numResponses=="3")? "checked" : "" }} value="3" >
                                                 تواصل لفظي غير عادي من الدرجة المتوسطة.
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container"> ---
                                                 <input type="radio" name="r11" class="minimal" {{ ($detail4->numResponses=="3.5")? "checked" : "" }} value="3.5">
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container">
                                                 <input type="radio" name="r11" class="minimal" {{ ($detail4->numResponses=="4")? "checked" : "" }} value="4" >
                                                 تواصل لفظي غير عادي من الدرجة الشديدة.
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label>
                                                 ملاحظات :
                                             </label>
                                             <textarea class="remarquearea" rows="4" cols="56,5"></textarea>
                                         </div>

                                     </div>
                                 </div>
                             </div>
                             <!-- general form elements -->

                             <div class="col-md-6">

                                 <div class="card card-success">
                                     <div class="card-header">
                                         <h3 class="card-title">التواصل غير اللفظي</h3>
                                     </div>
                                     <!-- /.card-header -->
                                     <div class="card-body">

                                         <!-- radio -->
                                         <div class="form-group">
                                             <label class="container">
                                                 <input type="radio" name="r12" class="minimal" {{ ($detail3->numResponses=="1")? "checked" : "" }} value="1">
                                                 استخدام عادي للتواصل غير اللفظي، مناسب للمواقف
                                                 وكذلك العمر الموجود فيه الطفل.
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container"> ---
                                                 <input type="radio" name="r12" class="minimal" {{ ($detail3->numResponses=="1.5")? "checked" : "" }} value="1.5">
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container">
                                                 <input type="radio" name="r12" class="minimal" {{ ($detail3->numResponses=="2")? "checked" : "" }} value="2" >
                                                 استخدام غير عادي للتواصل غير اللفظي بدرجة
                                                 بسيطة.
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container"> ---
                                                 <input type="radio" name="r12" class="minimal" {{ ($detail3->numResponses=="2.5")? "checked" : "" }} value="2.5">
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container">
                                                 <input type="radio" name="r12" class="minimal" {{ ($detail3->numResponses=="3")? "checked" : "" }} value="3" >
                                                 استخدام غير عادي للتواصل غير اللفظي بدرجة
                                                 متوسطة.
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container"> ---
                                                 <input type="radio" name="r12" class="minimal" {{ ($detail3->numResponses=="3.5")? "checked" : "" }} value="3.5">
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label class="container">
                                                 <input type="radio" name="r12" class="minimal" {{ ($detail3->numResponses=="4")? "checked" : "" }} value="4" >
                                                 استخدام غير عادي للتواصل غير اللفظي بدرجة
                                                 شديدة.
                                                 <span class="checkmark"></span>
                                             </label>
                                         </div>

                                         <div class="form-group">
                                             <label>
                                                 ملاحظات :
                                             </label>
                                             <textarea class="remarquearea" rows="4" cols="56,5"></textarea>
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
                                     <h3 class="card-title">مستوى النشاط</h3>
                                 </div>
                                 <!-- /.card-header -->
                                 <div class="card-body">

                                     <!-- radio -->
                                     <div class="form-group">
                                         <label class="container">
                                             <input type="radio" name="r13" class="minimal" {{ ($detail2->numResponses=="1")? "checked" : "" }} value="1">
                                             مستوى النشاط طبيعي بالنسبة للعمر والظروف.
                                             <span class="checkmark"></span>
                                         </label>
                                     </div>

                                     <div class="form-group">
                                         <label class="container"> ---
                                             <input type="radio" name="r13" class="minimal" {{ ($detail2->numResponses=="1.5")? "checked" : "" }} value="1.5">
                                             <span class="checkmark"></span>
                                         </label>
                                     </div>

                                     <div class="form-group">
                                         <label class="container">
                                             <input type="radio" name="r13" class="minimal" {{ ($detail2->numResponses=="2")? "checked" : "" }} value="2" >
                                             مستوى النشاط غير عادي من الدرجة البسيطة.
                                             <span class="checkmark"></span>
                                         </label>
                                     </div>

                                     <div class="form-group">
                                         <label class="container"> ---
                                             <input type="radio" name="r13" class="minimal" {{ ($detail2->numResponses=="2.5")? "checked" : "" }} value="2.5">
                                             <span class="checkmark"></span>
                                         </label>
                                     </div>

                                     <div class="form-group">
                                         <label class="container">
                                             <input type="radio" name="r13" class="minimal" {{ ($detail2->numResponses=="3")? "checked" : "" }} value="3" >
                                             مستوى النشاط غير عادي من الدرجة المتوسطة.
                                             <span class="checkmark"></span>
                                         </label>
                                     </div>

                                     <div class="form-group">
                                         <label class="container"> ---
                                             <input type="radio" name="r13" class="minimal" {{ ($detail2->numResponses=="3.5")? "checked" : "" }} value="3.5">
                                             <span class="checkmark"></span>
                                         </label>
                                     </div>

                                     <div class="form-group">
                                         <label class="container">
                                             <input type="radio" name="r13" class="minimal" {{ ($detail2->numResponses=="4")? "checked" : "" }} value="4" >
                                             مستوى النشاط غير عادي من الدرجة الشديدة.
                                             <span class="checkmark"></span>
                                         </label>
                                     </div>

                                     <div class="form-group">
                                         <label>
                                             ملاحظات :
                                         </label>
                                         <textarea class="remarquearea" rows="4" cols="56,5"></textarea>
                                     </div>

                                 </div>
                             </div>
                         </div>
                         <!-- general form elements -->

                         <div class="col-md-6">

                             <div class="card card-warning">
                                 <div class="card-header">
                                     <h3 class="card-title">المستوى و الدرجة الخاصة بالإستجابة العقلية</h3>
                                 </div>
                                 <!-- /.card-header -->
                                 <div class="card-body">
                                     <!-- radio -->
                                     <div class="form-group">
                                         <label class="container">
                                             <input type="radio" name="r14" class="minimal" {{ ($detail1->numResponses=="1")? "checked" : "" }} value="1">
                                             الذكاء طبيعي و القدرات العقلية عادية في مختلف المجالات.
                                             <span class="checkmark"></span>
                                         </label>
                                     </div>

                                     <div class="form-group">
                                         <label class="container"> ---
                                             <input type="radio" name="r14" class="minimal" {{ ($detail1->numResponses=="1.5")? "checked" : "" }} value="1.5">
                                             <span class="checkmark"></span>
                                         </label>
                                     </div>

                                     <div class="form-group">
                                         <label class="container">
                                             <input type="radio" name="r14" class="minimal" {{ ($detail1->numResponses=="2")? "checked" : "" }} value="2" >
                                             وظائف عقلية غير عادية من الدرجة البسيطة.
                                             <span class="checkmark"></span>
                                         </label>
                                     </div>

                                     <div class="form-group">
                                         <label class="container"> ---
                                             <input type="radio" name="r14" class="minimal" {{ ($detail1->numResponses=="2.5")? "checked" : "" }} value="2.5">
                                             <span class="checkmark"></span>
                                         </label>
                                     </div>

                                     <div class="form-group">
                                         <label class="container">
                                             <input type="radio" name="r14" class="minimal" {{ ($detail1->numResponses=="3")? "checked" : "" }} value="3" >
                                             وظائف عقلية غير عادية من الدرجة المتوسطة.
                                             <span class="checkmark"></span>
                                         </label>
                                     </div>

                                     <div class="form-group">
                                         <label class="container"> ---
                                             <input type="radio" name="r14" class="minimal" {{ ($detail1->numResponses=="3.5")? "checked" : "" }} value="3.5">
                                             <span class="checkmark"></span>
                                         </label>
                                     </div>

                                     <div class="form-group">
                                         <label class="container">
                                             <input type="radio" name="r14" class="minimal" {{ ($detail1->numResponses=="4")? "checked" : "" }} value="4" >
                                             وظائف عقلية غير عادية من الدرجة الشديدة.
                                             <span class="checkmark"></span>
                                         </label>
                                     </div>

                                     <div class="form-group">
                                         <label>
                                             ملاحظات :
                                         </label>
                                         <textarea class="remarquearea" rows="4" cols="56,5"></textarea>
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
                                     <h3 class="card-title">الإنطباع العام</h3>
                                 </div>
                                 <!-- /.card-header -->
                                 <div class="card-body">

                                     <!-- radio -->
                                     <div class="form-group">
                                         <label class="container">
                                             <input type="radio" name="r15" class="minimal" {{ ($detail0->numResponses=="1")? "checked" : "" }} value="1">
                                             طبيعي.
                                             <span class="checkmark"></span>
                                         </label>
                                     </div>

                                     <div class="form-group">
                                         <label class="container"> ---
                                             <input type="radio" name="r15" class="minimal" {{ ($detail0->numResponses=="1.5")? "checked" : "" }} value="1.5">
                                             <span class="checkmark"></span>
                                         </label>
                                     </div>

                                     <div class="form-group">
                                         <label class="container">
                                             <input type="radio" name="r15" class="minimal" {{ ($detail0->numResponses=="2")? "checked" : "" }} value="2" >
                                             توحد بسيط.
                                             <span class="checkmark"></span>
                                         </label>
                                     </div>

                                     <div class="form-group">
                                         <label class="container"> ---
                                             <input type="radio" name="r15" class="minimal" {{ ($detail0->numResponses=="2.5")? "checked" : "" }} value="2.5">
                                             <span class="checkmark"></span>
                                         </label>
                                     </div>

                                     <div class="form-group">
                                         <label class="container">
                                             <input type="radio" name="r15" class="minimal" {{ ($detail0->numResponses=="3")? "checked" : "" }} value="3" >
                                             توحد متوسط.
                                             <span class="checkmark"></span>
                                         </label>
                                     </div>

                                     <div class="form-group">
                                         <label class="container"> ---
                                             <input type="radio" name="r15" class="minimal" {{ ($detail0->numResponses=="3.5")? "checked" : "" }} value="3.5">
                                             <span class="checkmark"></span>
                                         </label>
                                     </div>

                                     <div class="form-group">
                                         <label class="container">
                                             <input type="radio" name="r15" class="minimal" {{ ($detail0->numResponses=="4")? "checked" : "" }} value="4" >
                                             توحد شديد.
                                             <span class="checkmark"></span>
                                         </label>
                                     </div>

                                     <div class="form-group">
                                         <label>
                                             ملاحظات :
                                         </label>
                                         <textarea class="remarquearea" rows="4" cols="56,5" name="remarque">{{$diagnostic->remarque}}</textarea>
                                     </div>

                                 </div>
                             </div>
                         </div>
                         <!-- general form elements -->


                         <div class="col-md-6">

                             <button type="submit" class="result" value="Submit"  >المجموع</button>
                             <input type="text" name="points" value="{{$sumResponses}}" id="points" disabled />
                             <button type="submit" id="degree" value="Submit">عرض النتيجة</button>
                             <button type="submit" class="saveresult" value="Submit"> حفظ</button>
                             {!! Html::linkRoute('pagecarsspecialiste.diagnostics.show', 'الغاء', array($diagnostic->id), array('class' => 'btn btn-danger btn-block','style'=>"width: 158px;padding: 15px 32px;font-size: 19px;text-align: center; margin-right: 185px;margin-top:2px ;  height:  48px;")) !!}


                         </div>
                     </div>
                 </div>

             </section>

             <!-- /.content -->
       {{-- </form>--}}
    </div>

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
             url:"/pagecarsspecialiste/update/"+ $("#idDiagnostic").val(),
             //"/pagecarsspecialiste/diagnostics/update"+ $("#idDiagnostic").val(),
             data: {
                 responses : JSON.stringify(responses),
                 questions : JSON.stringify(questions),
                 remarques : JSON.stringify(remarques),
                 _token: "{{ csrf_token() }}",
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




 <!-- select-->



@endsection
