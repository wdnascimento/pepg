<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Atendimento - PEPG</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Inline Styles for initial load -->
        <style>
            body {
                background-color: #f8f9fa;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                margin: 0;
                padding: 0;
            }

            html, body {
                height: 100vh;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
                padding: 2rem;
            }

            .title {
                font-size: 84px;
                font-weight: 700;
                margin: 0;
            }

            .subtitle {
                font-size: 24px;
                margin: 1rem 0;
                color: #666;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            #app {
                width: 100%;
                height: 100%;
            }
        </style>
    </head>

    <body>
        <div id="app">
            <tela-inicial url="{{ url('') }}"></tela-inicial>
        </div>
    </body>
</html>
