<div {{ setAttributes($attrs ?? []) }} class="mdc-autocomplete{{ $isMultiple ? ' mdc-autocomplete--multiple' : ''}}" tabindex="0">  
  <div class="mdc-autocomplete__data">
    @component('material.textfield-outlined', array_merge(
      [
        'modifiers' => [
          'mdc-autocomplete__textfield',
          'mdc-text-field--with-leading-icon'
        ],
      ],
      $textfield)
    ) @endcomponent
    <div class="mdc-autocomplete__results"></div>  
  </div>
  <div class="mdc-autocomplete__chips"></div>
</div>

{{--
  @component('components.autocomplete', [
    'isMultiple' => true,
    'attrs' => [
      'id' => 'mdc-autocomplete'
    ],
    'textfield' => [
      'label' => 'Usuários',
      'icon' => 'search',
      'attrs' => [
        'type' => 'search',
        'id' => 'textfield-mdc-autocomplete',
      ],
      'modifiers' => [
        'mdc-autocomplete__textfield',
        'mdc-text-field--with-leading-icon'
      ],
    ]
  ]) @endcomponent
--}}

{{-- Inicialização --}}
{{-- 
  const asyncSelectEl = document.querySelector('#mdc-autocomplete');
  const component = new mdcn.AsyncSelect({
    element: asyncSelectEl,
    delay: 250,
    api: '/api/users',
    mapApiToResults: function (data) {
      return data.map(user => ({
        key: user.id,
        text: user.text,
      }))
    }
  });
  component.render();
 --}}