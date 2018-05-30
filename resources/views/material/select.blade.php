<div class="select mdc-select mdc-select--box">
  <select class="mdc-select__native-control" {{ setAttributes($attrs ?? null) }}>
    @foreach ($options as $option)
      <option {{ setAttributes($option['attrs'] ?? null) }}>
        {{ $option['text'] }}
      </option>
    @endforeach
  </select>
  <label class="mdc-floating-label mdc-floating-label--float-above">{{ $label }}</label>
  <div class="mdc-line-ripple"></div>
</div>

@if ($helperText ?? false)
  @component('material.textfield-helper-text', [
    'isPersistent' => $helperText['isPersistent'] ?? false,
    'isValidation' => $helperText['isValidation'] ?? false,
    'message' => $helperText['message'],
  ]) @endcomponent
@endif

{{-- @component('material.select', [
  'label' => 'My select',
  'attrs' => [
    'name' => 'select-name',
    'id' => 'select-id',
  ],
  'labelModifiers' => ['mdc-floating-label--float-above'],
  'options' => [
    [
      'text' => 'select an option',
      'attrs' => [
        'value' => '',
        'disabled' => '',
        'selected' => '',
      ],
    ],
    [
      'text' => 'option 1',
      'attrs' => [
        'value' => 1,
      ],
    ],
    [
      'text' => 'option 2',
      'attrs' => [
        'value' => 2,
      ],
    ],
  ],
]) @endcomponent --}}