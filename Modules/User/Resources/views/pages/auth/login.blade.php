@extends('layouts.default')
@section('title', 'Login')

@section('main')
  @component('components.page', [
    'modifiers' => ['page-login']
  ])
    <div class="ra-page-login__surface">
      @component('material.layout-grid-with-inner', [
        'attrs' => [
          'style' => 'max-width: 400px'
        ]
      ])

        @component('material.cell', [
          'when' => [
            'default' => 12
          ],
        ])
          <h1 class="mdc-typography--headline4">Log In</h1>
          <h1 class="mdc-typography--headline5">Log In</h1>
        @endcomponent
        
      @endcomponent        
    </div>

    @component('material.layout-grid-with-inner', [
      'attrs' => [
        'style' => 'max-width: 400px'
      ]
    ])

      @component('material.cell', [
        'when' => [
          'default' => 12
        ],
      ])        
        @component('material.card', [
          'title' => 'Log In',
          'subtitle' => 'Ir para o Sistema',
          'actions' => [
            [
              'type' => 'button',
              'props' => [
                'text' => 'Esqueceu sua senha?',
                'attrs' => [
                  'disabled' => true,
                ],
              ],
            ],
          ],
        ])
          @component('components.form', [
            'action' => url('/login'),
            'method' => 'post',
            'inputs' => [
              [
                'when' => [
                  'default' => 12,
                ],
                'material' => 'textfield-outlined',
                'props' => [
                  'label' => 'E-mail',
                  'icon' => 'mail_outline',
                  'attrs' => [
                    'type' => 'email',
                    'name' => 'email',
                    'required' => '',
                    'id' => 'textfield-email',
                  ],
                  'helperText' => [
                    'isValidation' => true,
                    'isPersistent' => $errors->has('auth'),
                    'message' => $errors->get('auth')[0] ?? null,
                  ],
                  'modifiers' => ['mdc-text-field--with-trailing-icon'],
                ],
              ],
              [
                'when' => [
                  'default' => 12,
                ],
                'material' => 'textfield-outlined',
                'props' => [
                  'label' => 'Senha',
                  'icon' => 'vpn_key',
                  'attrs' => [
                    'type' => 'password',
                    'required' => '',
                    'name' => 'password',
                    'id' => 'textfield-password',
                  ],
                  'modifiers' => ['mdc-text-field--with-trailing-icon'] 
                ],
              ],
              [
                'when' => [
                  'default' => 12,
                ],
                'material' => 'checkbox',
                'props' => [
                  'label' => 'Lembrar-me',
                  'attrs' => [
                    'name' => 'remember_me',
                    'id' => 'checkbox-remember-me',
                    'checked' => '',
                  ],
                ],
              ],            
            ],
            'submit' => [
              'text' => 'Entrar',
              'modifiers' => ['mdc-button--raised'],
              'attrs' => [
                'type' => 'submit'
              ],
            ],        
          ]) @endcomponent
        @endcomponent

      @endcomponent
    @endcomponent
  
  @endcomponent
@endsection 