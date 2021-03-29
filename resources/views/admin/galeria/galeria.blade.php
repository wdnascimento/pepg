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
                                <h1 class="w-100 text-center">PISO SUPERIOR</h1>
                                <div class="row ">
                                    <div class="col-3 p-3 bg-light-gray">
                                        <ul class="list-group justify-content text-dark">
                                            <li class="list-group-item d-flex justify-content-between align-items-center" id="x-210" >210 <span class="badge badge-primary badge-pill">0</span></li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center" id="x-209" >209 <span class="badge badge-primary badge-pill">0</span></li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center" id="x-208" >208 <span class="badge badge-primary badge-pill">0</span></li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center" id="x-207" >207 <span class="badge badge-primary badge-pill">0</span></li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center" id="x-206" >206 <span class="badge badge-primary badge-pill">0</span></li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center" id="x-205" >205 <span class="badge badge-primary badge-pill">0</span></li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center" id="x-204" >204 <span class="badge badge-primary badge-pill">0</span></li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center" id="x-203" >203 <span class="badge badge-primary badge-pill">0</span></li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center" id="x-202" >202 <span class="badge badge-primary badge-pill">0</span></li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center" id="x-201" >201 <span class="badge badge-primary badge-pill">0</span></li>
                                        </ul>
                                    </div>
                                    <div class="col-6" >
                                        <div class="row bg-light">
                                            <div class="col-6 p-3 ">
                                                <ul class="list-group">
                                                    <li class="list-group-item d-flex justify-content-between align-items-center" id="x-110" >110 <span class="badge badge-primary badge-pill">0</span></li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center" id="x-109" >109 <span class="badge badge-primary badge-pill">0</span></li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center" id="x-108" >108 <span class="badge badge-primary badge-pill">0</span></li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center" id="x-107" >107 <span class="badge badge-primary badge-pill">0</span></li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center" id="x-106" >106 <span class="badge badge-primary badge-pill">0</span></li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center" id="x-105" >105 <span class="badge badge-primary badge-pill">0</span></li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center" id="x-104" >104 <span class="badge badge-primary badge-pill">0</span></li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center" id="x-103" >103 <span class="badge badge-primary badge-pill">0</span></li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center" id="x-102" >102 <span class="badge badge-primary badge-pill">0</span></li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center" id="x-101" >101 <span class="badge badge-primary badge-pill">0</span></li>
                                                </ul>                                
                                            </div>
                                            <div class="col-6 p-3  ">
                                                <ul class="list-group">
                                                    <li class="list-group-item d-flex justify-content-between align-items-center" id="x-111" >111 <span class="badge badge-primary badge-pill">0</span></li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center" id="x-112" >112 <span class="badge badge-primary badge-pill">0</span></li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center" id="x-113" >113 <span class="badge badge-primary badge-pill">0</span></li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center" id="x-114" >114 <span class="badge badge-primary badge-pill">0</span></li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center" id="x-115" >115 <span class="badge badge-primary badge-pill">0</span></li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center" id="x-116" >116 <span class="badge badge-primary badge-pill">0</span></li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center" id="x-117" >117 <span class="badge badge-primary badge-pill">0</span></li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center" id="x-118" >118 <span class="badge badge-primary badge-pill">0</span></li>
                                                    <li class="list-group-item d-flex justify-content-center align-items-center">Chuveiros </li>
                                                    <li class="list-group-item d-flex justify-content-center align-items-center">Chuveiros </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3 p-3 text-dark">
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex justify-content-between align-items-center" id="x-211" >211 <span class="badge badge-primary badge-pill">0</span></li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center" id="x-212" >212 <span class="badge badge-primary badge-pill">0</span></li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center" id="x-213" >213 <span class="badge badge-primary badge-pill">0</span></li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center" id="x-214" >214 <span class="badge badge-primary badge-pill">0</span></li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center" id="x-215" >215 <span class="badge badge-primary badge-pill">0</span></li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center" id="x-216" >216 <span class="badge badge-primary badge-pill">0</span></li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center" id="x-217" >217 <span class="badge badge-primary badge-pill">0</span></li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center" id="x-218" >218 <span class="badge badge-primary badge-pill">0</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>           
                </div>
                <!-- /.card-body -->
              </div>


           </div>
       </div>
    </section>
@stop

@section('css')
    <style>
      

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
                        alert('{{$unidade["numero"]}}');
                   });   
                @endforeach
            @endif
        });
    </script>
@stop
