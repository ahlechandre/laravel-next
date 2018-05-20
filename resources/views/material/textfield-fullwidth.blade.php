<div class="mdc-text-field mdc-text-field--fullwidth{{ setModifiers($modifiers ?? null) }}">
  <input {{ setAttributes($attrs ?? null) }} class="mdc-text-field__input" placeholder="{{ $label }}">
  <div class="mdc-line-ripple"></div>
</div>

{{-- 
  @component('material.textfield', [
    'label' => 'Label textfield',
    'attrs' => [
      'name' => 'textfield-name',
      'id' => 'textfield-id',
      'required' => '',
    ],
  ]) @endcomponent
 --}}