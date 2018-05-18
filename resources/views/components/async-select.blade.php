<div class="async-select{{ $isMultiple ? ' async-select--multiple' : ''}}" data-async-select-delay="{{ $delay }}" data-async-select-api="{{ $api }}" data-async-select-input-name="{{ $inputName }}">  

  @component('material.textfield', [
    'label' => $label, 
    'attrs' => $attrs,
    'modifiers' => ['async-select__textfield'], 
  ]) @endcomponent
  <div class="async-select__chips"></div>
  <div class="async-select__results"></div>
</div>

{{-- @component('components.async-select', [
  'label' => 'Usuários',
  'isMultiple' => true,
  'api' => url('/api'),
  'delay' => 250,
  'attrs' => [
    'name' => 'users[]',
    'value' => 'value',
  ],
  'textfieldAttrs' => [
    'id' => 'async-select-users',
  ],
]) @endcomponent --}}