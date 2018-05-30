@extends('layouts.master')
@section('title', 'Usuários')

@section('main')

  @component('material.layout-grid-with-inner')
    @component('material.cell', [
      'when' => ['default' => 12]
    ])
      @foreach ($users as $userToShow)
          {{ $userToShow->name }}
      @endforeach
    @endcomponent  
  @endcomponent
@endsection
