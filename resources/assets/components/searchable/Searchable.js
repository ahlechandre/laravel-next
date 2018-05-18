import { fetchItemsIfNeeded } from './actions'

class Searchable {
  datasets = {
    'DELAY': 'raSearchableDelay',
  }

  classes = {
    'FORM': 'searchable__form',
    'TEXTFIELD': 'searchable__search',
    'INPUT': 'text-field__input',
  }

  constructor(props) {
    this.state = {
      element: props.element,
      store: props.store,
    };
  }
  
  getInputElement() {
    const textfieldElement = this.state.element.querySelector(`.${
      this.classes['TEXTFIELD']
    }`);

    return textfieldElement.querySelector(`.${
      this.classes['INPUT']
    }`)
  }

  getFormElement() {
    return this.state.element.querySelector(`.${
      this.classes['FORM']
    }`);
  }

  getApi(formElement) {
    return formElement.getAttribute('action')
  }

  search(api, query, store) {
    store.dispatch(
      fetchItemsIfNeeded(api, query)
    )
  }

  searchOnSubmit(formElement, inputElement) {
    const search = this.search
    const api = this.state.api
    const store = this.state.store

    formElement.addEventListener('submit', event => {
      event.preventDefault()
      const query = inputElement.value
      search(api, query, store)
    })
  }

  setState(nextState) {
    this.state = nextState
  }

  render() {
    const inputElement = this.getInputElement()
    const formElement = this.getFormElement()

    if (!inputElement || !formElement) return
   
    const api = this.getApi(formElement)
    
    this.setState({
      ...this.state,
      api
    })

    this.searchOnSubmit(formElement, inputElement)
  }
}

export default Searchable
