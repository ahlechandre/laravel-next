@extends('layouts.form', [
    'topAppBarTitle' => 'App / Novo usuário',
    'topAppBarMenu' => [
        'icon' => 'arrow_back',
        'attrs' => [
            'href' => url('/users'), 
        ]
    ]
])
@section('title', 'Novo usuário')

@section('main')

  @component('material.layout-grid-with-inner')
    
    @component('material.cell', [
      'when' => ['default' => 12]
    ])
        @component('components.form-with-card', [
            'title' => 'Novo usuário',
            'subtitle' => 'Adicione um novo usuário ao sistema',
            'form' => [
                'action' => url('/users'),
                'method' => 'post',
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
                        'material' => 'textfield-box',
                        'when' => ['default' => 12],
                        'props' => [
                            'label' => 'Nome',
                            'icon' => 'person_identity',
                            'attrs' => [
                                'id' => 'textfield-user-name',
                                'type' => 'text',
                                'name' => 'name',
                                'required' => '',
                            ],
                            'modifiers' => ['mdc-text-field--with-leading-icon']
                        ]
                    ],
                    [
                        'material' => 'select',
                        'when' => ['default' => 12],
                        'props' => [
                            'label' => 'Papel',
                            'icon' => 'add',
                            'attrs' => [
                                'id' => 'textfield-user-role',
                                'name' => 'role',
                                'required' => '',
                            ],
                            'options' => $roles->map(function ($role) {
                                return [
                                    'text' => $role->name,
                                    'attrs' => [
                                        'value' => $role->id,
                                    ],
                                ];
                            })->prepend([
                                'text' => 'Selecione o papel do usuário',
                                'attrs' => [
                                    'value' => '',
                                    'disabled' => '',
                                    'selected' => '',
                                ],
                            ]),
                        ]
                    ],                
                    [
                        'material' => 'textfield-box',
                        'when' => ['default' => 12],
                        'props' => [
                            'label' => 'E-mail',
                            'icon' => 'email',
                            'attrs' => [
                                'id' => 'textfield-user-email',
                                'type' => 'email',
                                'name' => 'email',
                                'required' => '',
                            ],
                            'modifiers' => [
                                'mdc-text-field--with-leading-icon',
                            ]        
                        ]
                    ],
                    [
                        'material' => 'textfield-box',
                        'when' => ['default' => 12],
                        'props' => [
                            'label' => 'Senha',
                            'icon' => 'vpn_key',
                            'attrs' => [
                                'id' => 'textfield-user-password',
                                'type' => 'password',
                                'name' => 'password',
                                'required' => '',
                            ],
                            'modifiers' => [
                                'mdc-text-field--with-leading-icon',
                            ],
                        ]
                    ]                           
                ],
            ],
        ]) @endcomponent
    @endcomponent

  @endcomponent
@endsection
