@extends('layouts.master')
@section('title', $userToShow->name)

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
                'title' => $userToShow->name,
                'subtitle' => 'Usuário',
            ]) @endcomponent
        @endcomponent

        @component('material.cell', [
            'when' => ['default' => 12]
        ])
            @component('material.tabs', [
                'tabs' => [
                    [
                        'text' => 'Tab 1',
                        'isActive' => request()->query('tab') === 'item1' || request()->query('tab') === null,
                        'attrs' => [
                            'href' => '?tab=item1'
                        ],
                    ],
                    [
                        'text' => 'Tab 2',
                        'isActive' => request()->query('tab') === 'item2',
                        'attrs' => [
                            'href' => '?tab=item2'
                        ],
                    ],
                    [
                        'text' => 'Tab 3',
                        'isActive' => request()->query('tab') === 'item3',
                        'attrs' => [
                            'href' => '?tab=item3'
                        ],
                    ]
                ]
            ]) @endcomponent    
        @endcomponent

        @component('material.cell', [
            'when' => ['default' => 6]
        ])
            @component('material.list-two-line', [
                'modifiers' => ['mdc-list--non-interactive'],
                'items' => [
                    [
                        'icon' => 'mail_outline', 
                        'text' => 'E-mail', 
                        'secondaryText' => $userToShow->email, 
                    ],
                    [
                        'icon' => 'supervised_user_circle', 
                        'text' => 'Papel', 
                        'secondaryText' => $userToShow->role->name, 
                    ],
                    [
                        'icon' => 'event', 
                        'text' => 'Participa desde', 
                        'secondaryText' => $userToShow->created_at
                            ->formatLocalized('%B de %Y'), 
                    ]                    
                ]
            ]) @endcomponent
        @endcomponent
    @endcomponent

    {{-- FAB --}}
    @component('material.fab', [
        'icon' => 'edit',
        'label' => 'Editar usuário',
        'modifiers' => ['fab--fixed'],
        'attrs' => [
            'href' => url("/users/{$userToShow->id}/edit"),
            'title' => 'Editar usuário',
            'alt' => 'Editar usuário',
        ],
    ]) @endcomponent    
@endsection
