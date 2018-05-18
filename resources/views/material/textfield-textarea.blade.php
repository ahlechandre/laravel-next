<div class="mdc-text-field mdc-text-field--textarea">
  <textarea {{ setAttributes($attrs ?? null) }} class="mdc-text-field__input">{{ $attrs['value'] ?? null }}</textarea>
  <label for="{{ $attrs['id'] ?? null }}" class="mdc-floating-label">{{ $label }}</label>
</div>

{{-- 
  @component('material.textfield-textarea', [
    'label' => 'My textarea',
    'attrs' => [
      'name' => 'textarea-name',
      'id' => 'textarea-id',
      'value' => 'content here',
    ],
  ]) @endcomponent
 --}}
