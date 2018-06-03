<header class="top-app-bar top-app-bar--with-search mdc-top-app-bar{{ setModifiers($modifiers ?? null) }}">
    {{-- Search Row --}}
    <div class="mdc-top-app-bar__row top-app-bar__row top-app-bar__row--search">
        {{-- Start Section --}}
        <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
          <div class="text-field text-field--top-app-bar-search mdc-text-field mdc-text-field--with-trailing-icon mdc-text-field--fullwidth">
            <input type="text" 
              name="q" 
              autocomplete="off" 
              placeholder="Buscar" 
              class="mdc-text-field__input text-field__input top-app-bar__input-search">
          </div>
        </section>
        {{-- End Section --}}
        <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end" role="toolbar">
            {{-- Close Button --}}
            <a href="#" 
                class="material-icons mdc-top-app-bar__action-item top-app-bar__action-close-search"
                aria-label="Fechar" 
                alt="Fechar">close</a>
        </section>
    </div>
  
    {{-- Menu Row --}}
    <div class="mdc-top-app-bar__row top-app-bar__row">
        {{-- Start Section --}}
        <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
            <a class="material-icons mdc-top-app-bar__navigation-icon"
                {{ setAttributes($menu['attrs']) }}>{{ $menu['icon'] }}</a>
            <span class="mdc-top-app-bar__title">{{ $title }}</span>
        </section>
        {{-- End Section --}}
        <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end" role="toolbar">    
            @foreach($actions as $action)
                <a class="material-icons mdc-top-app-bar__action-item"
                    {{ setAttributes($action['attrs']) }}>{{ $action['icon'] }}</a>
            @endforeach
            {{-- Search Open Button --}}
            <a href="#" 
                class="material-icons mdc-top-app-bar__action-item top-app-bar__action-open-search"
                aria-label="Search"
                alt="Search">search</a>
        </section>
    </div>
  </header>