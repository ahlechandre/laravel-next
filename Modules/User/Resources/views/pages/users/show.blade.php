@extends('layouts.master')
@section('title', "Usuários / {$userToShow->name}")

@section('main')

    @component('material.layout-grid-with-inner')
        
        @component('material.cell', [
        'when' => ['default' => 12]
        ])
            {{ $userToShow->name }}
        @endcomponent
    @endcomponent
@endsection