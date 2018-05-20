<div class="text-field mdc-text-field mdc-text-field--outlined{{ setModifiers($modifiers ?? null) }}">
  @if ($icon ?? false)
  <i class="material-icons mdc-text-field__icon" tabindex="0" role="button">{{ $icon }}</i>  
  @endif
  <input {{ setAttributes($attrs ?? null) }} class="mdc-text-field__input">
  <label class="mdc-floating-label" for="{{ $attrs['id'] ?? null }}">{{ $label }}</label>
  
  <div class="mdc-notched-outline">
    <svg>
      <path class="mdc-notched-outline__path"/>
    </svg>
  </div>
  <div class="mdc-notched-outline__idle"></div>
</div>
