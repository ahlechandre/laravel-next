@extends('layouts.default')
@section('title', 'Login')

@section('main')
  @component('components.page', [
    'modifiers' => ['page-login']
  ])
    @component('material.layout-grid-with-inner')

      @component('material.cell', [
        'when' => [
          'default' => 12
        ],
        'modifiers' => ['mdc-layout-grid__cell--align-middle']
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
                'material' => 'textfield',
                'props' => [
                  'label' => 'E-mail',
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
                ],
              ],
              [
                'when' => [
                  'default' => 12,
                ],
                'material' => 'textfield',
                'props' => [
                  'label' => 'Senha',
                  'attrs' => [
                    'type' => 'password',
                    'required' => '',
                    'name' => 'password',
                    'id' => 'textfield-password',
                  ],
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
                    'checked' => true,
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