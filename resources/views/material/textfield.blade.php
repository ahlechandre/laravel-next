<div class="mdc-text-field">
  <input {{ setAttributes($attrs ?? null) }} class="mdc-text-field__input{{ setModifiers($modifiers ?? null) }}">
  <label class="mdc-floating-label" for="{{ $attrs['id'] ?? null }}">{{ $label }}</label>
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