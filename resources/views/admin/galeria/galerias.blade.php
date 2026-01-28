@extends('adminlte::page')

@section('title', config('admin.title'))

@section('content_header')
@include('admin.layouts.header')
@stop

@section('content')

<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header with-border">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="card-title">{{$params['subtitulo']}}</h3>
                        </div>
                    </div>
                </div>

                <!-- GALERIAS PRINCIPAIS -->
                <div class="card-body">
                    <h4 class="text-center font-weight-bold mb-4">
                        <i class="fas fa-bars mr-2"></i>GALERIAS
                    </h4>
                    <div class="row px-2">
                        <div id="1" class="galeria galeria-lg rounded col-md-3 col-sm-6 p-3 bg-primary text-center text-white">
                            <div>
                                <i class="fas fa-bars mb-2" style="font-size: 2rem;"></i>
                                <br>
                                <strong>GALERIA 01</strong>
                            </div>
                        </div>

                        <div id="2" class="galeria galeria-lg rounded col-md-3 col-sm-6 p-3 bg-info text-center text-white">
                            <div>
                                <i class="fas fa-bars mb-2" style="font-size: 2rem;"></i>
                                <br>
                                <strong>GALERIA 02</strong>
                            </div>
                        </div>

                        <div id="3" class="galeria galeria-lg rounded col-md-3 col-sm-6 p-3 bg-success text-center text-white">
                            <div>
                                <i class="fas fa-bars mb-2" style="font-size: 2rem;"></i>
                                <br>
                                <strong>GALERIA 03</strong>
                            </div>
                        </div>

                        <div id="4" class="galeria galeria-lg rounded col-md-3 col-sm-6 p-3 bg-warning text-center text-dark">
                            <div>
                                <i class="fas fa-bars mb-2" style="font-size: 2rem;"></i>
                                <br>
                                <strong>GALERIA 04</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ISOLAMENTOS -->
                <div class="card-body border-top">
                    <h4 class="text-center font-weight-bold mb-4">
                        <i class="fas fa-lock mr-2"></i>ISOLAMENTOS
                    </h4>
                    <div class="row px-5 justify-content-center">
                        <div id="5" class="galeria galeria-sm rounded col-lg-1 col-md-2 col-sm-4 col-6 p-2 bg-danger text-center text-white mx-2">
                            <div>
                                <i class="fas fa-lock mb-2" style="font-size: 1.5rem;"></i>
                                <br>
                                <strong style="font-size: 0.85rem;">ISO 05</strong>
                            </div>
                        </div>

                        <div id="6" class="galeria galeria-sm rounded col-lg-1 col-md-2 col-sm-4 col-6 p-2 bg-danger text-center text-white mx-2">
                            <div>
                                <i class="fas fa-lock mb-2" style="font-size: 1.5rem;"></i>
                                <br>
                                <strong style="font-size: 0.85rem;">ISO 06</strong>
                            </div>
                        </div>

                        <div id="7" class="galeria galeria-sm rounded col-lg-1 col-md-2 col-sm-4 col-6 p-2 bg-danger text-center text-white mx-2">
                            <div>
                                <i class="fas fa-lock mb-2" style="font-size: 1.5rem;"></i>
                                <br>
                                <strong style="font-size: 0.85rem;">ISO 07</strong>
                            </div>
                        </div>

                        <div id="8" class="galeria galeria-sm rounded col-lg-1 col-md-2 col-sm-4 col-6 p-2 bg-danger text-center text-white mx-2">
                            <div>
                                <i class="fas fa-lock mb-2" style="font-size: 1.5rem;"></i>
                                <br>
                                <strong style="font-size: 0.85rem;">ISO 08</strong>
                            </div>
                        </div>

                        <div id="9" class="galeria galeria-sm rounded col-lg-1 col-md-2 col-sm-4 col-6 p-2 bg-danger text-center text-white mx-2">
                            <div>
                                <i class="fas fa-lock mb-2" style="font-size: 1.5rem;"></i>
                                <br>
                                <strong style="font-size: 0.85rem;">ISO 09</strong>
                            </div>
                        </div>

                        <div id="10" class="galeria galeria-sm rounded col-lg-1 col-md-2 col-sm-4 col-6 p-2 bg-danger text-center text-white mx-2">
                            <div>
                                <i class="fas fa-lock mb-2" style="font-size: 1.5rem;"></i>
                                <br>
                                <strong style="font-size: 0.85rem;">ISO 10</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('css')
<style>
    .galeria {
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: bold;
        cursor: pointer;
        border: 3px solid #fff;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .galeria-lg {
        min-height: 180px;
        margin-bottom: 15px;
    }

    .galeria-sm {
        min-height: 120px;
        margin-bottom: 15px;
    }

    .galeria:hover {
        opacity: 0.85;
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    }

    .galeria:active {
        transform: translateY(-2px);
    }

    /* Cores diferenciadas para melhor visual */
    .bg-primary { background-color: #007bff !important; }
    .bg-info { background-color: #17a2b8 !important; }
    .bg-success { background-color: #28a745 !important; }
    .bg-warning { background-color: #ffc107 !important; }
    .bg-danger { background-color: #dc3545 !important; }
</style>
@stop

@section('js')
<script>
    $('.galeria').on('click', function() {
        window.location.href = 'galeria/' + this.id;
    });
</script>
@stop
