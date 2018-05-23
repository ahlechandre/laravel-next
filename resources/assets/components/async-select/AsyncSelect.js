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
    MDC_LIST: 'mdc-list',
    MDC_LIST_ITEM: 'mdc-list-item',
    CHIPS: 'async-select__chips',
    MDC_CHIP: 'mdc-chip',
    MDC_CHIP_TEXT: 'mdc-chip__text',
    MDC_CHIP_ICON: 'mdc-chip__icon',
    MDC_CHIP_ICON_TRAILING: 'mdc-chip__icon--trailing',
    MATERIAL_ICONS: 'material-icons',
    INPUT: 'async-select__input',
    FOCUSED: 'async-select--focused',
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
        beforeSetTimeout()
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
    this.onChipCancel = this.onChipCancel.bind(this)
    this.onFocus = this.onFocus.bind(this)
    this.onLostFocus = this.onLostFocus.bind(this)
  }

  /**
   * Lida com o evento de cancelamento de um chip removendo-o do DOM.
   * 
   * @param {Event} event 
   * @return {undefined}
   */
  onChipCancel(event) {
    // Acessa o chip que, no DOM, é o parente do ícone 
    // de cancelamento clicado no evento.
    const chip = event.target.parentNode
    // Remove todos os seus nós filhos.
    AsyncSelect.clear(chip)
    // Acessa o parente do chip para removê-lo.
    const chipParent = chip.parentNode
    chipParent.removeChild(chip)
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
    chipCancel.addEventListener('click', this.onChipCancel)
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
  }

  /**
   * Indica se um determinado chip (com input) já existe no DOM.
   * 
   * @param {string} value 
   * @return {boolean}
   */
  shouldAddChip(value) {
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
    if (this.shouldAddChip(value)) {

      // Se o componente não for múltiplo, apenas um item
      // deve ser mostrado por vez.
      if (!this.state.isMultiple) {
        AsyncSelect.clear(this.state.elements.chips)
      }

      // Mostra o chip referente ao resultado selecionado.
      this.addChip(text, value)
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
   * Define o comportamento do componente quando o input está sob foco.
   * 
   * @param {Event} event
   * @return {undefined}
   */
  onFocus(event) {
    // Adiciona a classe de componente focado.
    this.state.element.classList.add(
      AsyncSelect.classes['FOCUSED']
    )
  }

  /**
   * Define o comportamento do componente quando o input perde foco.
   * 
   * @param {Event} event
   * @return {undefined}
   */
  onLostFocus(event) {
    // Adiciona remove a classe de componente focado.
    this.state.element.classList.remove(
      AsyncSelect.classes['FOCUSED']
    )
  }

  /**
   * Determina o comportamento para o evento de busca.
   * 
   * @return {undefined}
   */
  render() {    
    // Busca ao digitar.
    this.state.elements.textfield.addEventListener(
      'keyup', 
      AsyncSelect.debounce(
        this.onSearch, 
        this.state.delay,
        // Limpa os resultados de busca antes de definir
        // o timeout da busca.
        () => AsyncSelect.clear(this.state.elements.results)
      )
    )
    // Mostra o resultado da busca ao focar no input.
    const input = this.state
      .elements
      .textfield
      .querySelector('input')
    input.addEventListener('focus', this.onFocus)
    input.addEventListener('blur', this.onLostFocus)
    
    if (!input.form) {
      return this
    }
    
    // Aplica regras de validação ao submeter o formulário.
    input.form.addEventListener('submit', event => {
      console.log('submete!')

      if (!input.value.trim()) {
        input.setCustomValidity('PREENCHA SÁ PORRA MACACO')
        return
      }

      console.log('valido!')
      input.setCustomValidity('')
    })

    return this
  }
}

export default AsyncSelect
