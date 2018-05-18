@extends('layouts.default')
@section('title', 'Login')

@section('main')
  @component('material.layout-grid-with-inner')

    @component('material.cell', [
      'when' => [
        'default' => 12
      ],
      'modifiers' => ['mdc-layout-grid__cell--align-right']
    ])
      @component('components.async-select', [
        'label' => 'Usuários',
        'isMultiple' => true,
        'api' => url('/api/users'),
        'delay' => 250,
        'inputName' => 'users[]',
        'attrs' => [
          'id' => 'async-select-users',
        ],
      ]) @endcomponent

    @endcomponent
  @endcomponent
@endsection 