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
    @if ($cancel ?? false)
      @component('material.cell', [
        'when' => [
          'desktop' => 6,
          'tablet' => 4,
          'phone' => 2,
        ]
      ])
          @component('material.button-link', $cancel) @endcomponent    
      @endcomponent
    @endif

    {{-- Submeter --}}
    @if ($submit ?? false)
      @component('material.cell', [
        'when' => [
          'desktop' => 6,
          'tablet' => 4,
          'phone' => 2,
        ]
      ])
        @component('material.button', $submit) @endcomponent
      @endcomponent    
    @endif

  @endcomponent
</form>