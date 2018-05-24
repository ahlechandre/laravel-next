import fetch from 'cross-fetch'
import { getHeaders } from '../api'
import { linearProgressGlobal } from '../linear-progress'

class AsyncSelect {
  /**
   * @var {Object}
   */
  static constants = {
    MATERIAL_ICON_CANCEL: 'cancel',
    QUERY_PARAM: 'q'
  }

  /**
   * @var {Object}
   */
  static classes = {
    IS_MULTIPLE: 'async-select--multiple',
    TEXTFIELD: 'async-select__textfield',
    RESULTS: 'async-select__results',
    LIST: 'async-select-list',
    LIST_ITEM: 'async-select-list-item',
    LIST_ITEM_SELECTED: 'async-select-list-item--selected',
    MDC_LIST: 'mdc-list',
    MDC_LIST_ITEM: 'mdc-list-item',
    CHIPS: 'async-select__chips',
    MDC_CHIP: 'mdc-chip',
    MDC_CHIP_TEXT: 'mdc-chip__text',
    MDC_CHIP_ICON: 'mdc-chip__icon',
    MDC_CHIP_ICON_TRAILING: 'mdc-chip__icon--trailing',
    MATERIAL_ICONS: 'material-icons',
    INPUT: 'async-select__input',
  }

  /**
   * @var {Object}
   */
  static datasets = {
    KEY: 'asyncSelectKey',
  }
  
  /**
   * Remove todos os nós filhos do elemento indicado.
   * 
   * @param {HTMLElement} element
   * @return {undefined}
   */
  static clear(element) {
    while (element.firstChild) {
      element.removeChild(element.firstChild)
    }
  }
  
  /**
   * Retarda a chamada do callback no delay indicado.
   * 
   * @param {Function} callback 
   * @param {number} delay 
   * @param {Function} beforeSetTimeout 
   * @param {number} delay 
   */
  static debounce(callback, delay, beforeSetTimeout) {
    let timer = null

    return event => {

      if (typeof beforeSetTimeout === 'function') {
        beforeSetTimeout(event)
      }
      clearTimeout(timer)
      timer = setTimeout(
        () => callback(event.target.value), 
        delay
      )
    }
  } 
  
  /**
   * Cria um elemento HTML baseado nas opções passadas.
   * 
   * @param {Object} options
   * @return {HTMLElement} 
   */
  static create(options) {
    const element = document.createElement(options.tag)
    
    // Define as classes do elemento.
    if (options.classes) {
      options.classes.map(
        className => element.classList.add(className)
      )  
    }

    // Define os datasets do elemento.
    if (options.datasets) {
      options.datasets.map(
        dataset => element.dataset[dataset.name] = dataset.value
      )  
    }

    // Define os atributos do elemento.
    if (options.attributes) {
      options.attributes.map(
        attr => element.setAttribute(attr.name, attr.value)
      )  
    }
    
    // Define o conteúdo do elemento.
    if (options.text) {
      element.textContent = options.text
    }

    return element
  }

  /**
   * 
   * @param {Object} props
   * @param {HTMLElement} props.element
   * @param {function} props.mapApiToResults
   * @param {string} props.api
   * @param {string} props.queryParam
   * @param {string} props.inputName
   * @param {Object} props.validate
   * @param {Function} props.validate.check
   * @param {string} props.validate.message
   * @param {undefined|number} props.delay
   * @return {undefined}
   */
  constructor(props) {

    if (!props.element) {
      throw new Error('Please, provide an element (`.async-select`)')
    }
    const textfield = props.element
      .querySelector(`.${
        AsyncSelect.classes['TEXTFIELD']
      }`)
    const results = props.element
      .querySelector(`.${
        AsyncSelect.classes['RESULTS']    
      }`)
    const chips = props.element
      .querySelector(`.${AsyncSelect.classes['CHIPS']}`)
    const isMultiple = props.element
      .classList
      .contains(AsyncSelect.classes['IS_MULTIPLE'])
    
    // Define o estado inicial do componente.
    this.state = {
      element: props.element,
      mapApiToResults: props.mapApiToResults,
      api: props.api,
      delay: props.delay || 250,
      queryParam: props.queryParam,
      inputName: props.inputName,
      validate: props.validate,
      isMultiple,
      query: null,
      init: {
        method: 'GET',
        headers: {
          ...getHeaders(),
          Accept: 'application/json',
        }
      },
      elements: {
        textfield,
        results,
        chips,
      },
    }

    if (!this.state.mapApiToResults) {
      throw new Error('Please, provide a mapApiToResults callback')
    }
    
    if (!this.state.api) {
      throw new Error('Please, provide an API')
    }

    if (!this.state.elements.textfield) {
      throw new Error('Please, provide a textfield element (`.async-select > .async-select__textfield`)')
    }

    if (!this.state.elements.results) {
      throw new Error('Please, provide a results element (`.async-select > .async-select__results`)')
    }
    
    if (!this.state.elements.chips) {
      throw new Error('Please, provide a chips element (`.async-select > .async-select__chips`)')
    }
    // Faz o bind de todos os callbacks.
    this.onSearch = this.onSearch.bind(this)
    this.onSearchSuccess = this.onSearchSuccess.bind(this)
    this.onSearchResultSelect = this.onSearchResultSelect.bind(this)
    this.onCancelChip = this.onCancelChip.bind(this)
    this.componentWillSearch = this.componentWillSearch.bind(this)
    this.onComponentKeyDown = this.onComponentKeyDown.bind(this)
  }

  /**
   * 
   * @return {undefined}
   */
  updateSelected() {
    const items = this.state
      .elements
      .results
      .querySelectorAll(`.${
        AsyncSelect.classes.LIST_ITEM        
      }`)
    const chips = this.state
      .elements
      .chips
      .querySelectorAll('input')
    
    for (let i = 0; i < items.length; i++) {
      const key = items[i].dataset[AsyncSelect.datasets.KEY]
      const isSelected = this.state
        .elements
        .chips
        .querySelector(`input[value="${key}"]`)

      if (isSelected) {
        items[i].classList.add(AsyncSelect.classes.LIST_ITEM_SELECTED)
      } else {
        items[i].classList.remove(AsyncSelect.classes.LIST_ITEM_SELECTED)
      }
    } 
  }

  /**
   * Lida com o evento de cancelamento de um chip removendo-o do DOM.
   * 
   * @param {Event} event 
   * @return {undefined}
   */
  onCancelChip(event) {
    // Acessa o chip que, no DOM, é o parente do ícone 
    // de cancelamento clicado no evento.
    const chip = event.target.parentNode
    // Remove todos os seus nós filhos.
    AsyncSelect.clear(chip)
    // Acessa o parente do chip para removê-lo.
    const chipParent = chip.parentNode
    chipParent.removeChild(chip)
    // Realiza validação.
    this.checkValidity() 
    // Atualiza lista de selecionados.
    this.updateSelected()
  }

  /**
   * Adiciona um chip e seu input no DOM.
   * 
   * @param {string} text 
   * @param {string} value
   * @return {undefined} 
   */
  addChip(text, value) {
    // Criando o componente de chip para o item selecionado.
    const chip = AsyncSelect.create({
      tag: 'div',
      classes: [
        AsyncSelect.classes['MDC_CHIP'],
      ],
    })
    // Criando o elemento de texto do chip.
    const chipText = AsyncSelect.create({
      tag: 'div',
      text,
      classes: [
        AsyncSelect.classes['MDC_CHIP_TEXT'],
      ],
    })  
    // Adiciona o texto no chip. 
    chip.appendChild(chipText)
    // Criando o botão para remover o chip.
    const chipCancel = AsyncSelect.create({
      tag: 'i',
      text: AsyncSelect.constants['MATERIAL_ICON_CANCEL'],
      classes: [
        AsyncSelect.classes['MATERIAL_ICONS'],
        AsyncSelect.classes['MDC_CHIP_ICON'],
        AsyncSelect.classes['MDC_CHIP_ICON_TRAILING']
      ],
      attributes: [
        {
          name: 'role',
          value: 'button',
        },
        {
          name: 'tabindex',
          value: '0',
        }
      ]
    })
    chipCancel.addEventListener('click', this.onCancelChip)
    // Adiciona o ícone de remoção no chip.
    chip.appendChild(chipCancel)
    // Criando input referente ao chip.
    const input = AsyncSelect.create({
      tag: 'input',
      attributes: [
        {
          name: 'type',
          value: 'hidden',
        },
        {
          name: 'name',
          value: this.state.inputName,
        }, 
        {
          name: 'value',
          value,
        },    
      ]
    })
    // Adiciona o input escondido no chip.
    chip.appendChild(input)    
    // Adicionando elementos no DOM.
    this.state.elements.chips.appendChild(chip)
    // Realiza validação.
    this.checkValidity()
  }

  /**
   * Indica se um determinado chip (com input) já existe no DOM.
   * 
   * @param {string} value 
   * @return {boolean}
   */
  shouldaddChip(value) {
    // Seleciona todos os elementos de input dentro dos chips.
    const inputElements = this.state
      .elements
      .chips
      .querySelectorAll('input')
    
    for (let i = 0; i < inputElements.length; i++) {

      // Verifica se o input já existe.
      if (inputElements[i].value === value) {
        return false
      }
    }

    return true
  }

  /**
   * Define o comportamento do componente quando o usuário
   * seleciona um resultado de busca.
   * 
   * @param {Event} event 
   * @return {undefined}
   */
  onSearchResultSelect(event) {
    // Define o texto do chip.
    const text = event.target.textContent
    // Define o valor do input a ser criado.
    const value = event.target
      .dataset[AsyncSelect.datasets['KEY']]

    // Verifica se o chip deve ser adicionado ao DOM.
    if (this.shouldaddChip(value)) {

      // Se o componente não for múltiplo, apenas um item
      // deve ser mostrado por vez.
      if (!this.state.isMultiple) {
        AsyncSelect.clear(this.state.elements.chips)
      }

      // Mostra o chip referente ao resultado selecionado.
      this.addChip(text, value)
      // Remove o foco da lista de resultado.
      this.state.element.focus()
      // Atualiza lista de selecionados.
      this.updateSelected()      
    }
  }

  /**
   * Renderiza a lista de resultados com base nos dados 
   * da API, em caso de sucesso.
   * 
   * @param {array<Object>} data
   * @param {string} query
   * @return {undefined}
   */
  onSearchSuccess(data, query) {
    // Desativa a barra de progresso.
    linearProgressGlobal.setInactive()

    // Mapeia o resultado da API para resultados no componente.
    this.state = {
      ...this.state,
      results: this.state.mapApiToResults(data, query),      
    }
    // Cria um elemento para listar os resultados.
    const list = AsyncSelect.create({
      tag: 'ul',
      classes: [
        AsyncSelect.classes['LIST'],
        AsyncSelect.classes['MDC_LIST'],
      ],
      attributes: [
        {
          name: 'role',
          value: 'menu',
        },
        {
          name: 'aria-hidden',
          value: 'true',
        },
        {
          name: 'tabindex',
          value: '-1',
        }
      ]
    })

    for (let i = 0; i < this.state.results.length; i++) {
      // Cria o elemento para um resultado de busca.
      const item = AsyncSelect.create({
        tag: 'li',
        text: this.state.results[i]['text'],
        classes: [
          AsyncSelect.classes['LIST_ITEM'],
          AsyncSelect.classes['MDC_LIST_ITEM'],
        ],
        attributes: [
          {
            name: 'tabindex',
            value: '-1',
          }
        ],
        datasets: [
          {
            name: AsyncSelect.datasets['KEY'],
            value: this.state.results[i]['key'],
          }
        ]
      })
      // Adiciona o resultado à lista de resultados.
      list.appendChild(item)

      // Verifica se a key do resultado é válida para adicionar
      // evento.
      if (this.state.results[i]['key']) {
        // Adiciona o evento de click no item para o usuário 
        // conseguir selecioná-lo.
        item.addEventListener('click', this.onSearchResultSelect)
      }
    }
    // Limpa os resultados de busca antes de adicionar a nova lista.
    AsyncSelect.clear(this.state.elements.results)
    // Adiciona a nova lista de resultados no DOM.
    this.state.elements.results.appendChild(list)
    // Atualiza os itens selecionados.
    this.updateSelected()
  }

  /**
   * Realiza uma chamada assíncrona em busca do valor digitado.
   * 
   * @param {string} query
   * @return {undefined}
   */
  onSearch(query) {

    if (!query || !query.trim() || this.state.query === query) {
      return
    } 

    // Armazena a query atual.
    this.state.query = query
    // Ativa a barra de progresso linear.
    linearProgressGlobal.setActive()
    // Define a query string com o valor da busca.
    let params = new URLSearchParams('')
    params.set(
      this.state.queryParam || AsyncSelect.constants.QUERY_PARAM, 
      query
    )
    // Realiza uma chamada assíncrona à API indicada.
    fetch(`${this.state.api}?${params.toString()}`, this.state.init)
      .then(response => response.json())
      .then(json => this.onSearchSuccess(json, query))
      .catch(error => console.error(error))
  }
  
  /**
   * 
   * @return {boolean}
   */
  checkValidity() {

    // Se não existe regra de validação.
    if (!this.state.validate) {
      return true
    }
    const inputSearch = this.state
      .elements
      .textfield
      .querySelector('input')
    let inputs = this.state
      .elements
      .chips
      .querySelectorAll('input')

    if (!this.state.validate.check(inputs)) {
      inputSearch.setCustomValidity(
        this.state.validate.message || 'Campo inválido'
      )

      return false
    }

    inputSearch.setCustomValidity('')

    return true
  }
  
  /**
   * 
   * @param {Event} event
   * @return {undefined}
   */
  componentWillSearch(event) {
    let timer = null

    return event => {
      // Usando tab.
      const preventedKeys = [9, 13, 16, 37, 38, 39, 40]

      if (!preventedKeys.includes(event.keyCode)) {
        // Limpa os resultados de busca.
        AsyncSelect.clear(this.state.elements.results)
      }
      clearTimeout(timer)
      timer = setTimeout(
        () => this.onSearch(event.target.value), 
        this.state.delay
      )
    }
  }
  
  /**
   * 
   * @param {Event} event
   * @return {undefined}
   */
  onComponentKeyDown(event) {
    let input = this.state
      .elements
      .textfield
      .querySelector('input')
    const active = document.activeElement
    const results = this.state
      .elements
      .results

    // Escaping.
    if (event.keyCode === 27) {
      event.preventDefault()      
      input.value = ''
      input.focus()
    }

    // Enter em item de resultado.
    if (event.keyCode === 13) {
      const isResultItem = results.contains(active)

      if (!isResultItem) {
        const isChip = this.state
          .elements
          .chips
          .contains(active)

        if (!isChip) {
          return
        }
      }
      event.preventDefault()
      // Enter em "remover" chip ou em resultado.
      active.click()        
    }

    // Seta para baixo.
    if (event.keyCode === 40) {

      // Seta para baixo com o input focado.
      if (input === active) {
        // Foca no primeiro item de resultado.
        const firstItem = this.state.elements.results.querySelector(`.${
          AsyncSelect.classes.LIST_ITEM
        }`)
  
        if (firstItem) {
          firstItem.focus()
        }

        return
      }
      
      // Seta para baixo com um item focado.
      if (results.contains(active)) {
        
        // Se existir próximo item, foque.
        if (active.nextSibling) {
          event.preventDefault()
          active.nextSibling.focus()
        }

        return
      }
    }

    // Seta para cima nos resultados.
    if (event.keyCode === 38 && results.contains(active)) {

      // Se existir resultado anterior, foque.
      if (active.previousSibling) {
        event.preventDefault()
        active.previousSibling.focus()
      }

      return
    }
  }

  /**
   * Determina o comportamento para o evento de busca.
   * 
   * @return {undefined}
   */
  render() {
    // Mostra o resultado da busca ao focar no input.
    const input = this.state
      .elements
      .textfield
      .querySelector('input')

    // Busca ao digitar.
    input.addEventListener('keyup', this.componentWillSearch())
    this.state.element.addEventListener('keydown', this.onComponentKeyDown)

    if (!input.form) {
      input.form.addEventListener('submit', event => {

        if (!this.checkValidity()) {
          input.focus()
          event.preventDefault()
        }
      })
    }

    return this
  }
}

export default AsyncSelect