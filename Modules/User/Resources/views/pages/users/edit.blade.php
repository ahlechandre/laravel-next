@extends('layouts.master')
@section('title', "{$userToEdit->name} / Editar")

@section('main')
    @component('material.layout-grid-with-inner', [
        'modifiers' => ['layout-grid--dense']
    ])        
        @component('material.cell', [
        'when' => ['default' => 12]
        ])
            @component('components.form-with-card', [
                'title' => $userToEdit->name,
                'subtitle' => 'Atualize as informações pessoais e de papel do usuário.',
                'form' => [
                    'action' => url("/users/{$userToEdit->id}"),
                    'method' => 'put',
                    'cancel' => [
                        'text' => 'Cancelar',
                        'attrs' => [
                            'href' => url("/users/{$userToEdit->id}"),
                        ],
                    ],
                    'submit' => [
                        'text' => 'Salvar',
                        'icon' => 'check',
                        'attrs' => [
                            'type' => 'submit',
                        ],
                        'modifiers' => ['mdc-button--unelevated']
                    ],
                    'inputs' => [
                        [
                            'material' => 'textfield',
                            'when' => [
                                'desktop' => 6,
                                'tablet' => 8,
                            ],
                            'validation' => $errors->get('name')[0] ?? null,
                            'props' => [
                                'label' => 'Nome',
                                'attrs' => [
                                    'id' => 'textfield-user-name',
                                    'type' => 'text',
                                    'name' => 'name',
                                    'required' => '',
                                    'value' => $userToEdit->name,
                                ],
                            ]
                        ],
                        [
                            'material' => 'select',
                            'when' => [
                                'desktop' => 6,
                                'tablet' => 8,
                            ],
                            'validation' => $errors->get('role_id')[0] ?? null,
                            'props' => [
                                'label' => 'Papel',
                                'attrs' => [
                                    'id' => 'textfield-user-role',
                                    'name' => 'role_id',
                                    'required' => '',
                                ],
                                'options' => $roles->map(function ($role) use ($userToEdit) {
                                    return [
                                        'text' => $role->name,
                                        'attrs' => [
                                            'value' => $role->id,
                                            'selected' => $role->id === $userToEdit->role_id
                                        ],
                                    ];
                                })->prepend([
                                    'text' => '',
                                    'attrs' => [
                                        'value' => '',
                                        'disabled' => '',
                                        'selected' => '',
                                    ],
                                ]),
                            ]
                        ],                
                        [
                            'material' => 'textfield',
                            'when' => [
                                'desktop' => 12,
                                'tablet' => 8,
                            ],
                            'validation' => $errors->get('email')[0] ?? null,
                            'props' => [
                                'label' => 'E-mail',
                                'attrs' => [
                                    'id' => 'textfield-user-email',
                                    'type' => 'email',
                                    'name' => 'email',
                                    'required' => '',
                                    'value' => $userToEdit->email,
                                ],
                            ]
                        ],
                    ],
                ],
            ]) @endcomponent
        @endcomponent

    @endcomponent
@endsection
