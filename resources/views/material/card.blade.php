<div class="card mdc-card{{ setModifiers($modifiers ?? null) }}">
  {{-- Primary --}}
  <div class="card__primary">
    @if ($title ?? false)
      <h2 class="card__title mdc-typography--headline6">{{ $title }}</h2>
    @endif
    @if ($subtitle ?? false)
      <h3 class="card__subtitle mdc-typography--subtitle2">{{ $subtitle }}</h3>    
    @endif
  </div>

  {{-- Content --}}
  <div class="card__body">
    {{ $slot }}
  </div>

  {{-- Actions --}}
  @if ($actions ?? false)
    <div class="mdc-card__actions">
      <div class="mdc-card__action-buttons">
        @foreach ($actions as $action)
          @component("material.{$action['type']}", $action['props']) @endcomponent
        @endforeach
      </div>
    </div>
  @endif

</div>