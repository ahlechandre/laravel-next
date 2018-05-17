<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">    
    <title>{{ config('app.name') }} @if (View::hasSection('title')) / @yield('title') @endif
    </title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  </head>
  <body class="mdc-typography ra-body">
    @yield('toolbar')
    <div class="ra-body__content">
      @yield('drawer')

      <main class="ra-body__main">
        @yield('main')
      </main>

      @if (session('status')) 
        <div class="ra-flash-message" data-ra-time-out="3000">
          {{ session('status') }}
        </div>
      @endif
      
    </div>

    <script src="{{ asset('js/material-components-web.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
  </body>
</html>
