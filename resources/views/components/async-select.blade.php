<div {{ setAttributes($attrs ?? []) }} class="async-select{{ $isMultiple ? ' async-select--multiple' : ''}}">  
  @component('material.textfield-box', $textfield) @endcomponent
  <div class="async-select__chips"></div>
  <div class="async-select__results"></div>
</div>

{{--
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
--}}

{{-- Inicialização --}}
{{-- 
  const asyncSelectEl = document.querySelector('#async-select');
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