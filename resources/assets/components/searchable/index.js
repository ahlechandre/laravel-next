import Searchable from './Searchable'
import { createStore, applyMiddleware } from 'redux'
import ReduxThunk from 'redux-thunk'
import searchableReducer from './reducers'

const SearchableContainer = () => ({
  selector: '.searchable',
  init: element => {
    const store = createStore(
      searchableReducer,
      applyMiddleware(ReduxThunk)
    )
    store.subscribe(() => console.log(store.getState()))
    const component = new Searchable({
      element,
      store,
    })
    component.render()
  } 
})

export default SearchableContainer
