import fetch from 'cross-fetch'

class AsyncSelect {
  static constants = {
    'MATERIAL_ICON_CANCEL': 'cancel'
  }

  static classes = {
    'IS_MULTIPLE': 'async-select--multiple',
    'TEXTFIELD': 'async-select__textfield',
    'RESULTS': 'async-select__results',
    'LIST': 'async-select-list',
    'LIST_ITEM': 'async-select-list-item',
    'MDC_LIST': 'mdc-list',
    'MDC_LIST_ITEM': 'mdc-list-item',
    'CHIPS': 'async-select__chips',
    'MDC_CHIP': 'mdc-chip',
    'MDC_CHIP_TEXT': 'mdc-chip__text',
    'MDC_CHIP_ICON': 'mdc-chip__icon',
    'MDC_CHIP_ICON_TRAILING': 'mdc-chip__icon--trailing',
    'MATERIAL_ICONS': 'material-icons',
    'INPUT': 'async-select__input',
  }

  static datasets = {
    'INPUT_NAME': 'asyncSelectInputName',
    'DELAY': 'asyncSelectDelay',
    'API': 'asyncSelectApi',
    'ITEM_VALUE': 'asyncSelectItemValue',
  }

  /**
   * 
   * @return {undefined}
   */
  constructor(props) {
    this.state = {
      element: props.element,
    }
    this.onSearch = this.onSearch.bind(this)
    this.renderResults = this.renderResults.bind(this)
    this.onResultClick = this.onResultClick.bind(this)
    this.onCancelItem = this.onCancelItem.bind(this)
  }

  /**
   * 
   * @param {Event} event 
   */
  onCancelItem(event) {
    const chipElement = event.target.parentNode

    while(chipElement.firstChild) {
      chipElement.removeChild(
        chipElement.firstChild
      )
    }

    chipElement.parentNode.removeChild(
      chipElement
    )
  }
  /**
   * 
   * @param {string} text 
   */
  showChip(text, value) {
    // Criando o componente de chip para o item selecionado.
    const chipElement = document.createElement('div')
    chipElement.classList.add(
      AsyncSelect.classes['MDC_CHIP']
    )
    const chipTextElement = document.createElement('div')
    chipTextElement.classList.add(
      AsyncSelect.classes['MDC_CHIP_TEXT']
    )
    chipTextElement.textContent = text
    chipElement.appendChild(chipTextElement)
    // Criando o botão para remover o chip.
    const chipCancelElement = document.createElement('i')
    chipCancelElement.classList.add(
      AsyncSelect.classes['MATERIAL_ICONS']
    )
    chipCancelElement.classList.add(
      AsyncSelect.classes['MDC_CHIP_ICON']
    )
    chipCancelElement.classList.add(
      AsyncSelect.classes['MDC_CHIP_ICON_TRAILING']
    )
    chipCancelElement.setAttribute('role', 'button')
    chipCancelElement.setAttribute('tabindex', '0')
    chipCancelElement.textContent = AsyncSelect.constants['MATERIAL_ICON_CANCEL']
    chipCancelElement.addEventListener('click', this.onCancelItem)
    chipElement.appendChild(chipCancelElement)
    // Criando input (hidden) referente ao item selecionado.
    const inputElement = document.createElement('input')
    inputElement.setAttribute('type', 'hidden')
    inputElement.setAttribute('name', this.state.inputName)
    inputElement.setAttribute('value', value)
    chipElement.appendChild(inputElement)    
    // Adicionando elementos no DOM.
    this.state.chipsElement.appendChild(chipElement)
  }

  shouldAddChip(value) {
    const inputElements = this.state
      .chipsElement
      .querySelectorAll('input')
    
    for (let i = 0; i < inputElements.length; i++) {

      if (inputElements[i].value === value) {
        return false
      }
    }

    return true
  }

  /**
   * @return {undefined}
   */
  clearChips() {
    const chipsElement = this.state.chipsElement
    
    while (chipsElement.firstChild) {
      chipsElement.removeChild(
        chipsElement.firstChild
      )
    }
  }

  /**
   * 
   * @param {Event} event 
   */
  onResultClick(event) {
    const text = event.target.textContent
    const value = event.target
      .dataset[AsyncSelect.datasets['ITEM_VALUE']]

    if (this.shouldAddChip(value)) {

      if (!this.state.isMultiple) {
        this.clearChips()
      }

      this.showChip(text, value)      
    }
  }

  /**
   * 
   * @param {string} className
   * @return {null|HTMLElement}
   */
  getElement(className) {
    return this.state.element.querySelector(`.${className}`)
  }

  /**
   * 
   * @return {boolean}
   */
  isMultiple() {
    return this.state
      .element
      .classList
      .contains(AsyncSelect.classes['IS_MULTIPLE'])
  }

  /**
   * 
   * @param {array<Object>} results
   * @return {undefined}
   */
  renderResults(results) {
    const listElement = document.createElement('ul')
    listElement.classList.add(
      AsyncSelect.classes['LIST']
    )
    listElement.classList.add(
      AsyncSelect.classes['MDC_LIST']
    )

    for (let i = 0; i < results.length; i++) {
      const itemElement = document.createElement('li')
      itemElement.textContent = results[i]['name']
      itemElement.dataset[
        AsyncSelect.datasets['ITEM_VALUE']
      ] = results[i]['id']
      itemElement.classList.add(
        AsyncSelect.classes['LIST_ITEM']
      )
      itemElement.classList.add(
        AsyncSelect.classes['MDC_LIST_ITEM']
      )
      itemElement.addEventListener('click', this.onResultClick)
      listElement.appendChild(itemElement)
    }
    this.state.resultsElement.appendChild(listElement)
  }

  /**
   * 
   * @param {array<Object>} results 
   * @return {undefined} 
   */
  showResults(results) {
    fetch(this.state.api)
      .then(response => response.json())
      .then(this.renderResults)
      .catch(error => console.error(error))
  }

  /**
   * @return {undefined}
   */
  clearResults() {
    const resultsElement = this.state.resultsElement
    
    while (resultsElement.firstChild) {
      resultsElement.removeChild(
        resultsElement.firstChild
      )
    }
  }

  /**
   * 
   * @param {string} value
   * @return {undefined}
   */
  onSearch(value) {

    if (!value.trim()) {
      return
    } 
    this.showResults()
  }
  
  /**
   * 
   * @param {*} nextState
   * @return {undefined}
   */
  setState(nextState) {
    this.state = nextState
  }

  /**
   * 
   * @param {Function} callback 
   * @param {number} delay 
   */
  debounce(callback, delay) {
    let timer = null

    return event => {
      this.clearResults()
      clearTimeout(timer)
      timer = setTimeout(
        () => this.onSearch(event.target.value), 
        delay
      )
    }
  } 

  /**
   * @return {number}
   */
  getDelay() {
    return this.state.element.dataset[
      AsyncSelect.datasets['DELAY']
    ] || 250;
  }

  /**
   * 
   * @return {number}
   */
  getApi() {
    return this.state.element.dataset[
      AsyncSelect.datasets['API']
    ];
  }

  /**
   * 
   * @return {undefined}
   */
  render() {
    const textfieldElement = this.getElement(
      AsyncSelect.classes['TEXTFIELD']
    )
    const resultsElement = this.getElement(
      AsyncSelect.classes['RESULTS']
    )
    const isMultiple = this.isMultiple()
    const api = this.getApi()
    const delay = this.getDelay()
    const chipsElement = this.state
      .element
      .querySelector(`.${AsyncSelect.classes['CHIPS']}`)
    const inputName = this.state
      .element
      .dataset[AsyncSelect.datasets['INPUT_NAME']]
    this.setState({
      ...this.state,
      api,
      isMultiple,
      resultsElement,
      textfieldElement,
      chipsElement,
      inputName,
    })
    textfieldElement.addEventListener(
      'keyup', 
      this.debounce(this.onSearch, delay)
    )
  }
}

export default AsyncSelect
