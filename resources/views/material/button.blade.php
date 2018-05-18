<button {{ setAttributes($attrs ?? null) }} class="mdc-button button{{ setModifiers($attrs ?? null) }}">
  @if ($icon)
    <i class="material-icons mdc-button__icon">{{ $icon }}</i>
  @endif
  
  {{ $text }}
</button>

{{-- 
  @component('material.button', [
    'text' => 'Add a item',
    'icon' => 'add',
    'attrs' => [
      'href' => url('/new')
    ],
  ]) @endcomponent
 --}}
