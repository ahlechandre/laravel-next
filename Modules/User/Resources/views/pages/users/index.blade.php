@extends('layouts.master')
@section('title', 'Usuários')

@section('main')
    {{-- Top App Bar Surface --}}
    @component('components.top-app-bar-surface')
        @component('material.layout-grid-with-inner')
            @component('material.cell', [
                'when' => ['default' => 12]
            ])
                @component('material.breadcrumbs', [
                    'items' => [
                        [
                        'text' => 'Dashboard',
                        'url' => url('/dashboard'),
                        ],
                        [
                            'text' => 'Usuários',
                        ],
                    ]
                ]) @endcomponent
            @endcomponent
            
        @endcomponent
    
    @endcomponent

    {{-- Conteúdo --}}
    @component('material.layout-grid-with-inner', [
        'modifiers' => ['layout-grid--dense']
    ])

        @component('material.cell', [
            'when' => ['default' => 12]
        ])
            @component('components.paginable', [
            'collection' => $users,
            'title' => 'Usuários recentes',
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
