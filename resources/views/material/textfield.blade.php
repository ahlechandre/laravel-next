<div class="text-field mdc-text-field{{ setModifiers($modifiers ?? null) }}">
  <input {{ setAttributes($attrs ?? null) }} class="mdc-text-field__input">
  <label class="mdc-floating-label" for="{{ $attrs['id'] ?? null }}">{{ $label }}</label>
  <div class="mdc-line-ripple"></div>
</div>

@if ($helperText ?? false)
  @component('material.textfield-helper-text', [
    'isPersistent' => $helperText['isPersistent'] ?? false,
    'isValidation' => $helperText['isValidation'] ?? false,
    'message' => $helperText['message'],
  ]) @endcomponent
@endif

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