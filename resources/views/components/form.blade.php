<form action="{{ $action }}" method="{{ $method === 'get' ? 'get' : 'post' }}">
  @if ($method !== 'get')
    {{-- CSRF Protection --}}
    @csrf  
    {{-- Emula método HTTP --}}
    @method($method)
  @endif

  @component('material.layout-grid-inner')
    {{-- Inputs --}}
    @foreach($inputs as $input)
      @component('material.cell', [
        'when' => $input['when']
      ])
        @component(
          "material.{$input['material']}",
          (
            isset($input['validation']) && $input['validation'] ? array_merge(
              $input['props'],
              [
                'helperText' => [
                    'isValidation' => true,
                    'isPersistent' => true,
                    'message' => $input['validation'],
                ],
              ]
            ) : $input['props']
          )
        ) @endcomponent
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
          'desktop' => isset($cancel) ? 6 : 12,
          'tablet' => 4,
          'phone' => 2,
        ],
        'modifiers' => ['mdc-layout-grid--align-right'],
      ])
        @component('material.button', $submit) @endcomponent
      @endcomponent    
    @endif

  @endcomponent
</form>