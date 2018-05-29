<div {{ setAttributes($attrs ?? []) }} class="mdc-autocomplete{{ $isMultiple ? ' mdc-autocomplete--multiple' : ''}}" tabindex="0">  
  <div class="mdc-autocomplete__data">
    @component('material.textfield', array_merge(
      [
        'modifiers' => [
          'mdc-autocomplete__textfield',
          'mdc-text-field--with-leading-icon'
        ],
      ],
      $textfield)
    ) @endcomponent
    <div class="mdc-autocomplete__results"></div>  
  </div>
  <div class="mdc-autocomplete__chips">
    @if ($values ?? false)
      @foreach($values as $value)
        <div class="mdc-chip">
          <div class="mdc-chip__text">
            {{ $value['text'] }}
          </div>
          
          <i class="material-icons mdc-chip__icon mdc-chip__icon--trailing"
            role="button" 
            tabindex="0">cancel</i>

          <input type="hidden" name="{{ $inputName }}" value="{{ $value['key'] }}">
        </div>
      @endforeach
    @endif
  </div>
</div>

{{--
  @component('components.autocomplete', [
    'isMultiple' => true,
    'attrs' => [
      'id' => 'mdc-autocomplete'
    ],
    'textfield' => [
      'label' => 'Usuários',
      'icon' => 'search',
      'attrs' => [
        'type' => 'search',
        'id' => 'textfield-mdc-autocomplete',
      ],
      'modifiers' => [
        'mdc-autocomplete__textfield',
        'mdc-text-field--with-leading-icon'
      ],
    ]
  ]) @endcomponent
--}}
{{-- Inicialização --}}
{{-- 
    const autocompleteEl = document.querySelector('#async-select-users');

    const component = new mdcn.MDCAutocomplete({
      element: autocompleteEl,
      delay: 250,
      api: '/api/users',
      validate: {
        check: function (inputs) {
          return inputs.length;
        },
        message: 'Por favor, preencha este campo.' 
      },
      queryParam: 'id',
      inputName: 'users[]',
      mapApiToResults: function (data, query) {
        
        console.log(data, query)

        if (!data.length) {

          return [
            {
              key: null,
              text: 'Nenhum resultado para "' + query + '"',
            }
          ]
        }
        
        return data.map(user => ({
          key: user.id,
          text: user.name,
        }))
      }
    });
    component.render();
 --}}