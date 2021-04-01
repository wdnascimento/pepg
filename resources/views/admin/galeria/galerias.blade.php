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
                    </div>

                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-5 ">
                    <div class="grid-container">
                        <div id="1" class="GALERIA GALERIA-A" >GALERIA A</div>
                        <div class="CONTROLE">CONTROLE<BR>INTERNO</div>
                        <div id="3" class="GALERIA GALERIA-C">GALERIA C</div>
                        <div id="2" class="GALERIA GALERIA-B">GALERIA B</div>
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
       .grid-container {
            display: grid;
            grid-template-columns: 1.1fr 1.1fr 1fr 1fr 1fr 1fr;
            grid-template-rows: 1fr 1fr 1fr;
            gap: 0px 0px;
            grid-template-areas:
                ". . GALERIA-B GALERIA-B . ."
                "GALERIA-A GALERIA-A CONTROLE CONTROLE GALERIA-C GALERIA-C"
                ". . . . . .";
            width: 100%;
        }

        .GALERIA{
            background-color: lightskyblue;
            justify-content: center;
            display: grid;
            align-items: center;
            font-weight: bold;
            font-size: 2ex;
            text-align: center;
            cursor: pointer;
        }

        .CONTROLE { 
            grid-area: CONTROLE; 
            background-color: red;
            width: 100%;
            height: 100%;
            display: grid;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            font-size: 2ex;
        }

        .GALERIA-A { 
            grid-area: GALERIA-A; 
            width: 100%;
            height: 100%;
            min-height: 25ex;
        }

        .GALERIA-B {
            grid-area: GALERIA-B; 
            width: 100%;
            height: 100%;
            min-height: 50ex;
        }

        .GALERIA-C { 
            grid-area: GALERIA-C;
            width: 100%;
            height: 100%;
            min-height: 25ex;
        }   

        .GALERIA:hover{
            background-color: blue;
            opacity: 0.8;
            transition: 0.3s;
            color: #ffffff;
        }

    </style>
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        $('.GALERIA').on('click',function(){
            window.location.href = 'galeria/'+this.id;
        });
            
       
    </script>
@stop
