@extends('layouts.master')
@section('title', 'Usuários')

@section('main')

    {{-- Conteúdo --}}
    @component('material.layout-grid-with-inner', [
        'modifiers' => ['layout-grid--dense']
    ])
        {{-- Títulos --}}
        @component('material.cell', [
            'when' => ['default' => 12]
        ])
            @component('components.typography', [
                'title' => 'Usuários',
                'subtitle' => 'Lista de usuários mais recentes no sistema.',
            ]) @endcomponent
        @endcomponent

        {{-- Lista de recursos --}}
        @component('material.cell', [
            'when' => ['default' => 12]
        ])
            @component('components.paginable', [
            'collection' => $users,
            'items' => $users->map(function ($userToShow) {
                return [
                    'icon' => 'person',
                    'meta' => [
                        'icon' => 'arrow_forward',
                    ],
                    'text' => $userToShow->name,
                    'secondaryText' => $userToShow->created_at
                        ->diffForHumans(),
                    'attrs' => [
                        'href' => url("/users/{$userToShow->id}"),
                    ],
                ];
            }),
            ]) @endcomponent
        @endcomponent  
    @endcomponent

    {{-- FAB --}}
    @component('material.fab', [
        'icon' => 'add',
        'label' => 'Novo usuário',
        'modifiers' => ['fab--fixed'],
        'attrs' => [
            'href' => url('/users/create'),
            'title' => 'Novo usuário',
            'alt' => 'Novo usuário',
        ],
    ]) @endcomponent

@endsection
