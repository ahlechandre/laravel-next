class Filterable {
  datasets = {
    FILTER_MAX: 'imaFilterMax',
    FILTER_TERM: 'imaFilterTerm',
  }

  classes = {
    INPUT: 'ima-text-field__input',
    TEXTFIELD: 'ima-filterable__filter',
    LIST: 'ima-filterable__list',
    LIST_ITEM: 'ima-filterable__item',
    LIST_ITEM_HIDDEN: 'is-hidden',
  }

  constructor(props) {
    this.state = {
      element: props.element
    }

    this.filterList = this.filterList.bind(this)
  }

  getInputElement() {
    const textfield = this.state.element.querySelector(`.${
      this.classes['TEXTFIELD']
    }`)

    if (!textfield) return

    return textfield.querySelector(`.${
      this.classes['INPUT']
    }`)
  }

  getListElement() {
    return this.state.element.querySelector(`.${
      this.classes['LIST']
    }`)
  }

  showItem(itemElement) {
    return itemElement.classList.remove(
      this.classes['LIST_ITEM_HIDDEN']
    )
  }

  hideItem(itemElement) {
    return itemElement.classList.add(
      this.classes['LIST_ITEM_HIDDEN']
    )
  }

  filterList(query, listElement) {
    const queryTrim = query.trim()
    
    // Indica se a query está vazia pois só há espaços
    // em branco. Deixa passar quando o usuário apaga
    // todos os caracteres e o filtro deve listar 
    // todos os itens novamente.
    if (!queryTrim && query) return

    const queryToLower = query.toLowerCase()
    const items = listElement.querySelectorAll(`.${
      this.classes['LIST_ITEM']
    }`)
    let i = 0
    let term
    
    for (i; i < items.length; i++) {
      term = items[i].dataset[
        this.datasets['FILTER_TERM']
      ].toLowerCase()

      if (term.includes(queryToLower)) {
        this.showItem(items[i])
      } else {
        this.hideItem(items[i])
      }
    }
  }

  filterOnType(inputElement, listElement) {
    const filterList = this.filterList

    inputElement.addEventListener('keyup', event => {

      // Ignora espaços
      if (event.keyCode === 32) return

      filterList(event.target.value, listElement)
    })
  }

  render() {
    const inputElement = this.getInputElement()
    const listElement = this.getListElement()

    if (!inputElement || !listElement) return

    this.filterOnType(inputElement, listElement)
  }

}

export default Filterable
