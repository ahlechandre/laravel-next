<form action="{{ $action }}" method="{{ $method === 'get' ? 'get' : 'post' }}">
  {{-- CSRF Protection --}}
  @csrf
  {{-- Emula método HTTP --}}
  @method($method)

  @component('material.layout-grid-inner')
    {{-- Inputs --}}
    @foreach($inputs as $input)
      @component('material.cell', [
        'when' => $input['when']
      ])
        @component("material.{$input['material']}", $input['props']) @endcomponent
      @endcomponent
    @endforeach

    {{-- Cancelar --}}
    @component('material.cell', [
      'when' => [
        'desktop' => 6,
        'tablet' => 4,
        'phone' => 2,
      ]
    ])
      @if ($cancel ?? false)
        @component('material.button-link', $cancel) @endcomponent    
      @endif
    @endcomponent

    {{-- Submeter --}}
    @component('material.cell', [
      'modifiers' => ['mdc-layout-grid--align-right'],
      'when' => [
        'desktop' => 6,
        'tablet' => 4,
        'phone' => 2,
      ]
    ])
      @component('material.button', $submit) @endcomponent
    @endcomponent

  @endcomponent
</form>