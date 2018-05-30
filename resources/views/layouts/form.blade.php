<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- CSRF Protection --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">    
    <title>{{ config('app.name') }} @if (View::hasSection('title')) / @yield('title') @endif
    </title>
    {{-- Material icons --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    {{-- MDC + App --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  </head>
  <body class="mdc-typography">
    {{-- Progresso linear --}}
    <div role="progressbar" class="mdc-linear-progress mdc-linear-progress--indeterminate linear-progress linear-progress--global">
      <div class="mdc-linear-progress__buffering-dots"></div>
      <div class="mdc-linear-progress__buffer"></div>
      <div class="mdc-linear-progress__bar mdc-linear-progress__primary-bar">
        <span class="mdc-linear-progress__bar-inner"></span>
      </div>
      <div class="mdc-linear-progress__bar mdc-linear-progress__secondary-bar">
        <span class="mdc-linear-progress__bar-inner"></span>
      </div>
    </div>

    {{-- Barra de navegação --}}
    @component('material.top-app-bar', [
      'modifiers' => ['mdc-top-app-bar--fixed'],
      'title' => $topAppBarTitle ?? 'App',
      'actions' => $topAppBarActions ?? [],
      'menu' => $topAppBarMenu ?? [
        'icon' => 'menu',
        'attrs' => [
          'href' => '#', 
          'id' => 'top-app-bar-menu',
        ]
      ]
    ]) @endcomponent

    {{-- Conteúdo da página --}}
    <main class="mdc-top-app-bar--fixed-adjust">
      <div class="layout-grid-surface"></div>

      @component('material.layout-grid', [
        'modifiers' => ['layout-grid--with-form'],
      ])
        @yield('main')
      @endcomponent
    </main>

    {{-- Snackbars --}}
    @if (session('snackbar')) 
      @component('material.snackbar', [
        'message' => session('snackbar'),
        'actionText' => 'OK',
      ]) @endcomponent
    @endif
    
    {{-- MDC --}}
    <script src="{{ asset('js/material-components-web.js') }}"></script>
    {{-- App --}}
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- Scripts injetados por páginas --}}
    @yield('scripts')
  </body>
</html>
