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
                        <div class="GALERIA-A">GALERIA A</div>
                        <div class="CONTROLE">CONTROLE<BR>INTERNO</div>
                        <div class="GALERIA-C">GALERIA C</div>
                        <div class="GALERIA-B">GALERIA B</div>
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

        .GALERIA-A { 
            grid-area: GALERIA-B;
            background-color: lightskyblue;
            width: 100%;
            height: 100%;
            min-height: 350px;
            grid-area: GALERIA-A; 
            background-color: lightskyblue;
            justify-content: center;
            display: grid;
            align-items: center;
            font-weight: bold;
            font-size: 2em;
        }

        .CONTROLE { 
            grid-area: CONTROLE; 
            background-color: red;
            width: 100%;
            height: 100%;
            justify-content: center;
            display: grid;
            align-items: center;
            font-weight: bold;
            font-size: 2em;
            text-align: center;
            
        }

        .GALERIA-C { 
            grid-area: GALERIA-C;
            background-color: lightskyblue;
            width: 100%;
            height: 100%;
            min-width: 350px;
            justify-content: center;
            display: grid;
            align-items: center;
            font-weight: bold;
            font-size: 2em;
        
        }

        .GALERIA-B {
            width: 100%;
            height: 100%;
            min-width: 350px;
            grid-area: GALERIA-B; 
            background-color: lightskyblue;
            justify-content: center;
            display: grid;
            align-items: center;
            font-weight: bold;
            font-size: 2em;
        }


    </style>
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
      
    </script>
@stop
