@extends('adminlte::page')

@section('title', config('admin.title'))

@section('content_header')
    @include('admin.layouts.header')
@stop

@section('content')
    <section class="content" >
       <div class="row">
           <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="card-title">{{$params['subtitulo']}}</h3>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{ route($params['main_route'].'.galerias')}}" class="btn btn-primary btn-xs"><span class="fas fa-arrow-left"></span>  Voltar</a>
                        </div>
                    </div>

                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-5 ">
                    <div class="container-fluid">
                        <h1 class="w-100 text-center">{{$data['titulo']}}</h1>
                        <div class="row">
                            <div class="col-12 bg-dark">
                                <div class="row ">
                                    <div class="col-3 p-3 bg-light-gray">
                                        <ul class="list-group justify-content text-dark">
                                            <li class="list-group-item d-flex justify-content-between align-items-center cursor" id="x-210" >210 <span class="badge badge-primary badge-pill">0</span></li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center cursor" id="x-209" >209 <span class="badge badge-primary badge-pill">0</span></li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center cursor" id="x-208" >208 <span class="badge badge-primary badge-pill">0</span></li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center cursor" id="x-207" >207 <span class="badge badge-primary badge-pill">0</span></li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center cursor" id="x-206" >206 <span class="badge badge-primary badge-pill">0</span></li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center cursor" id="x-205" >205 <span class="badge badge-primary badge-pill">0</span></li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center cursor" id="x-204" >204 <span class="badge badge-primary badge-pill">0</span></li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center cursor" id="x-203" >203 <span class="badge badge-primary badge-pill">0</span></li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center cursor" id="x-202" >202 <span class="badge badge-primary badge-pill">0</span></li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center cursor" id="x-201" >201 <span class="badge badge-primary badge-pill">0</span></li>
                                        </ul>
                                    </div>
                                    <div class="col-6" >
                                        <div class="row bg-secondary">
                                            <h1 class="w-100 m-0 p-3 text-center d-flex justify-content-between">
                                                <i class="fas fa-arrow-alt-circle-down"></i> PISO INFERIOR <i class="fas fa-arrow-alt-circle-down"></i>
                                            </h1>
                                            <div class="col-6 p-3 ">
                                                <ul class="list-group text-dark">
                                                    <li class="list-group-item d-flex justify-content-between align-items-center cursor" id="x-110" >110 <span class="badge badge-primary badge-pill">0</span></li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center cursor" id="x-109" >109 <span class="badge badge-primary badge-pill">0</span></li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center cursor" id="x-108" >108 <span class="badge badge-primary badge-pill">0</span></li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center cursor" id="x-107" >107 <span class="badge badge-primary badge-pill">0</span></li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center cursor" id="x-106" >106 <span class="badge badge-primary badge-pill">0</span></li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center cursor" id="x-105" >105 <span class="badge badge-primary badge-pill">0</span></li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center cursor" id="x-104" >104 <span class="badge badge-primary badge-pill">0</span></li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center cursor" id="x-103" >103 <span class="badge badge-primary badge-pill">0</span></li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center cursor" id="x-102" >102 <span class="badge badge-primary badge-pill">0</span></li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center cursor" id="x-101" >101 <span class="badge badge-primary badge-pill">0</span></li>
                                                </ul>                                
                                            </div>
                                            <div class="col-6 p-3  ">
                                                <ul class="list-group text-dark">
                                                    <li class="list-group-item d-flex justify-content-between align-items-center cursor" id="x-111" >111 <span class="badge badge-primary badge-pill">0</span></li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center cursor" id="x-112" >112 <span class="badge badge-primary badge-pill">0</span></li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center cursor" id="x-113" >113 <span class="badge badge-primary badge-pill">0</span></li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center cursor" id="x-114" >114 <span class="badge badge-primary badge-pill">0</span></li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center cursor" id="x-115" >115 <span class="badge badge-primary badge-pill">0</span></li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center cursor" id="x-116" >116 <span class="badge badge-primary badge-pill">0</span></li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center cursor" id="x-117" >117 <span class="badge badge-primary badge-pill">0</span></li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center cursor" id="x-118" >118 <span class="badge badge-primary badge-pill">0</span></li>
                                                    <li class="list-group-item d-flex justify-content-center align-items-center">Chuveiros </li>
                                                    <li class="list-group-item d-flex justify-content-center align-items-center">Chuveiros </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3 p-3 text-dark">
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex justify-content-between align-items-center cursor" id="x-211" >211 <span class="badge badge-primary badge-pill">0</span></li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center cursor" id="x-212" >212 <span class="badge badge-primary badge-pill">0</span></li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center cursor" id="x-213" >213 <span class="badge badge-primary badge-pill">0</span></li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center cursor" id="x-214" >214 <span class="badge badge-primary badge-pill">0</span></li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center cursor" id="x-215" >215 <span class="badge badge-primary badge-pill">0</span></li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center cursor" id="x-216" >216 <span class="badge badge-primary badge-pill">0</span></li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center cursor" id="x-217" >217 <span class="badge badge-primary badge-pill">0</span></li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center cursor" id="x-218" >218 <span class="badge badge-primary badge-pill">0</span></li>
                                            <li class="list-group-item d-flex justify-content-center align-items-center">Chuveiros </li>
                                            <li class="list-group-item d-flex justify-content-center align-items-center">Chuveiros </li>
                                        </ul>
                                    </div>
                                    <h1 class="w-100 px-5 py-2 text-center d-flex justify-content-between">
                                        <i class="fas fa-arrow-alt-circle-left"></i> PISO SUPERIOR <i class="fas fa-arrow-alt-circle-right"></i>
                                    </h1>
                                </div>
                            </div>
                            <div class="col-12">
                                <h3 class="pt-4 p-3 text-center">Total de presos alojados: {{$data['total_presos']}} presos</h3>
                            </div>
                        </div>
                    </div>           
                </div>
                <!-- /.card-body -->
              </div>


           </div>
       </div>
       <div id="myModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Presos do Cubículo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
              </div>
              <div id="presos" class="modal-body">
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send message</button>
              </div>


            </div>
        </div>
      </div>
    </section>
@stop

@section('css')
    <style>
      .cursor{
          cursor: pointer;
      }
      .cursor:hover{
        background-color: lightslategrey;
        opacity: 0.8;
        transition: 0.3s;
        color: #ffffff;
      }

    </style>
    {{-- <link rel="stylesheet" href="{{asset('css/admin_custom.css') }}"> --}}
@stop

@section('js')
    <script>
        $(document).ready(function(){
            @if(isset($data) && $data["unidade"] != NULL)
               
                @foreach($data["unidade"] as $unidade)
                   $('#x-{{$unidade["numero"]}} span').html("{{count($unidade['presos'])}}");
                   $('#x-{{$unidade["numero"]}}').on('click',function(){
                        $('#exampleModalLabel').html("Presos do Cubículo {{$unidade["numero"]}}");
                        $('#myModal').data('id','{{$unidade["id"]}}');
                        $('#myModal').modal('show');
                   });   
                @endforeach
            @endif
        });

        $('#myModal').on('show.bs.modal', function (e) {
            getPresoPorCubículo($('#myModal').data('id'));
        });
        function getPresoPorCubículo(id){
            $.ajax({
                url : "{{route('admin.preso.por_cubiculo') }}",
                type : 'get',
                data : {
                    id : id
                },
                dataType : 'json'
                ,
                beforeSend : function(){
                    $("#presos").html("Buscando...");
                }
            })
            .done(function(res){
                const result = JSON.parse(JSON.stringify(res));
                if(result){
                    var html = `<table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Prontuário</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Artigos</th>
                                </tr>
                            </thead>
                            <tbody>` ;

                    result[0].presos.forEach(function(i,v){
                        html+=`
                                <tr>
                                    <th scope="row">
                                        <img src="http://www.spr.depen.pr.gov.br/centralvagas/exibirFoto.jpg?numProntuario=`+i.prontuario+`&idImagem=1" alt="">
                                    </th>
                                    <td> `+i.prontuario+`</td>
                                    <td> `+i.nome +`</td>
                                    <td> `+i.artigos +`</td>
                                </tr>`;
                    });

                    html+= `</tbody>
                                </table>`;
                
                }
                $("#presos").html(html);
            })
            .fail(function(jqXHR, textStatus, msg){
                alert(msg);
            });
        }
       


    </script>
@stop
