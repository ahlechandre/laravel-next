@extends('layouts.master')
@section('title', 'Dashboard')

@section('main')

  @component('material.layout-grid-with-inner')
    @component('material.cell', [
      'when' => ['default' => 12]
    ])

      @component('components.form', [
        'method' => 'post',
        'action' => url('/dashboard'),
        'inputs' => [
          [
            'when' => [
              'default' => 12,
            ],
            'material' => 'textfield-outlined',
            'props' => [
              'label' => 'Nome',
              'attrs' => [
                'type' => 'text',
                'id' => 'textfield-name',
                'name' => 'name',
                'required' => '',
              ],
            ],
          ],
          [
            'when' => ['default' => 12],
            'material' => 'autocomplete',
            'props' => [
              'isMultiple' => true,
              'attrs' => [
                'id' => 'async-select-users',
              ],
              'textfield' => [
                'label' => 'Selecione os usuários',
                'icon' => 'group',
                'attrs' => [
                  'type' => 'text',
                  'autocomplete' => 'off', 
                  'id' => 'async-select-textfield-users', 
                ]
              ]
            ],
          ],
        ],
        'cancel' => [
          'text' => 'Cancelar',
          'attrs' => [
            'href' => url('/'),
          ],
        ],
        'submit' => [
          'text' => 'Salvar',
          'icon' => 'check',
          'attrs' => [
            'type' => 'submit',
          ],
        ],
      ]) @endcomponent
      
    @endcomponent  
  @endcomponent
@endsection

@section('scripts')
<script>
  (function () {
    const page = function () {
      const asyncSelectEl = document.querySelector('#async-select-users');

      const component = new mdcn.MDCAutocomplete({
        element: asyncSelectEl,
        delay: 250,
        api: '/api/users',
        validate: {
          check: function (inputs) {
            return inputs.length;
          },
          message: 'Por favor, preencha este campo.' 
        },
        queryParam: 'id',
        inputName: 'users[]',
        mapApiToResults: function (data, query) {

          if (!data.length) {

            return [
              {
                key: null,
                text: 'Nenhum resultado para "' + query + '"',
              }
            ]
          }
          
          return data.map(user => ({
            key: user.id,
            text: user.name,
          }))
        }
      });
      component.render();
    };

    window.addEventListener('load', page);
  })()
</script>
@endsection