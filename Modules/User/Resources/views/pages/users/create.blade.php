@extends('layouts.master')
@section('title', 'Novo usuário')

@section('main')
  @component('material.layout-grid-with-inner', [
      'modifiers' => ['layout-grid--dense']
  ])
    
    @component('material.cell', [
      'when' => ['default' => 12]
    ])
        @component('components.form-with-card', [
            'title' => 'Novo usuário',
            'subtitle' => 'Adicione um novo usuário que poderá manter os recursos de acordo com o seu papel.',
            'form' => [
                'action' => url('/users'),
                'method' => 'post',
                'cancel' => [
                    'text' => 'Cancelar',
                    'attrs' => [
                        'href' => url('/users'),
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
                                'value' => old('name'),
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
                            'options' => $roles->map(function ($role) {
                                return [
                                    'text' => $role->name,
                                    'attrs' => [
                                        'value' => $role->id,
                                        'selected' => old('role_id') == $role->id
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
                            'desktop' => 6,
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
                                'value' => old('email')
                            ],
                        ]
                    ],
                    [
                        'material' => 'textfield',
                        'when' => [
                            'desktop' => 6,
                            'tablet' => 8,
                        ],
                        'validation' => $errors->get('password')[0] ?? null,
                        'props' => [
                            'label' => 'Senha',
                            'attrs' => [
                                'id' => 'textfield-user-password',
                                'type' => 'password',
                                'name' => 'password',
                                'required' => '',
                            ],
                        ]
                    ]                           
                ],
            ],
        ]) @endcomponent
    @endcomponent

  @endcomponent
@endsection
