@extends('layouts.traitants')
@section('title','| قائمة الأطفال')
@section('content')
    <br>
    <br>

    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <table class="table table-bordered table-striped" >
                <tr>
                    <th width="5%">الرقم</th>
                    <th width="10%">الصورة </th>
                    <th width = "55px"> اللقب</th>
                    <th  width = "55px">الاسم</th>
                    <th  width = "55px">الجنس</th>

                </tr>

                @if(count($enfants))
                    @foreach($enfants as $c)
                        <tr class="ui-widget-content"  data-href="{{route('pagetraitant.show2',$c->id_enfant)}}" style="cursor: pointer;">


                            <td  >{{$c->id_enfant}}</td>

                            <td><img src="{{ asset('storage/enfants/'.$c->image) }}"  style="border-radius: 8px; display: block;
                                     margin-left: auto;
                                     margin-right: auto;  border: 2px solid #ddd;
                                     " width="50" />
                            <td id="txt">{{ $c->prenom}}</td>
                            <td >{{ $c->nom}}</td>
                            <td>{{ $c->sexe}}</td>

                        <!--العملية-->
                    @endforeach


                @else
                    <tr><td colspan="5">لا يوجد طفل</td></tr>
                @endif
            </table>

            {{$enfants->render()}}

        </div>

    </section>
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
    <script type="text/javascript">
        $("tr").not(':first').hover(
            function () {
                $(this).css("background","rgba(195,120,53,0.28)");
            },
            function () {
                $(this).css("background","");
            }

        );

    </script>
    <script type="text/javascript">
        function passvalues(){
            var idenf=document.getElementById("idEnfant").value;
            localStorage.setItem("idenfvalue",idenf);
            return false;
        }
    </script>
@endsection
