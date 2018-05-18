import Chipable from './Chipable'
import { createStore } from 'redux'
import chipableReducer from './reducers'

const ChipableContainer = () => ({
  selector: '.chipable',
  init: element => {
    const store = createStore(chipableReducer)
    const component = new Chipable({
      element,
      store
    })
    component.render()
  }
})

export default ChipableContainer
