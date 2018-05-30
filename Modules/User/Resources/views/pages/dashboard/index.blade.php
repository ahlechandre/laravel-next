@extends('layouts.master')
@section('title', 'Dashboard')

@section('main')

  @component('material.layout-grid-with-inner')
    @component('material.cell', [
      'when' => ['default' => 12]
    ])
      <h1 class="mdc-typography--headline4">Dashboard</h1>      
    @endcomponent  
  @endcomponent
@endsection
