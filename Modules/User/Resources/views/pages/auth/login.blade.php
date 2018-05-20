@extends('layouts.default')
@section('title', 'Login')

@section('main')
  @component('material.layout-grid-with-inner', [
    'attrs' => [
      'style' => 'max-width: 500px'
    ]
  ])

    @component('material.cell', [
      'when' => [
        'default' => 12
      ],
      'modifiers' => ['mdc-layout-grid__cell--align-right']
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
                'desktop' => 12,
              ],
              'material' => 'textfield-outlined',
              'props' => [
                'label' => 'E-mail',
                'icon' => 'mail_outline',
                'attrs' => [
                  'type' => 'email',
                  'id' => 'textfield-email',
                ],
                'modifiers' => ['mdc-text-field--with-trailing-icon'],
              ],
            ],
            [
              'when' => [
                'desktop' => 12,
              ],
              'material' => 'textfield-outlined',
              'props' => [
                'label' => 'Senha',
                'icon' => 'vpn_key',
                'attrs' => [
                  'type' => 'password',
                  'id' => 'textfield-password',
                ],
                'modifiers' => ['mdc-text-field--with-trailing-icon'] 
              ],
            ],
            [
              'when' => [
                'desktop' => 12,
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
@endsection 