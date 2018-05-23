@extends('layouts.master')
@section('title', 'Dashboard')

@section('main')

  @component('material.layout-grid-with-inner')
    @component('material.cell', [
      'when' => ['default' => 12]
    ])
      @component('components.async-select', [
        'isMultiple' => true,
        'attrs' => [
          'id' => 'async-select'
        ],
        'textfield' => [
          'label' => 'Usuários',
          'icon' => 'search',
          'attrs' => [
            'type' => 'search',
            'id' => 'textfield-async-select',
          ],
          'modifiers' => [
            'async-select__textfield',
            'mdc-text-field--with-leading-icon'
          ],
        ]
      ]) @endcomponent    
    @endcomponent  
  @endcomponent
@endsection

@section('scripts')
<script>
  (function () {
    const page = function () {
      const asyncSelectEl = document.querySelector('#async-select');
      const component = new mdcn.AsyncSelect({
        element: asyncSelectEl,
        delay: 250,
        api: '/api/users',
        mapApiToResults: function (data, value) {

          if (!data.length) {

            return [
              {
                key: null,
                text: 'Nenhum resultado para "' + value + '"',
              }
            ]
          }

          return data.map(user => ({
            key: user.id,
            text: user.text,
          }))
        }
      });
      component.render();
    };

    window.addEventListener('load', page);
  })()
</script>
@endsection