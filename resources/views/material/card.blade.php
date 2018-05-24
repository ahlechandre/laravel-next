<div class="card mdc-card">
  {{-- Primary --}}
  <div class="card__primary">
    <h2 class="card__title mdc-typography--headline6">{{ $title }}</h2>
    <h3 class="card__subtitle mdc-typography--subtitle2">{{ $subtitle }}</h3>
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