import Mdc from './mdc'
import DrawerContainer from './drawer'
import TextFieldContainer from './textfield'
import TextFieldHelperTextContainer from './textfield-helper-text'
import ButtonContainer from './button'
import FilterableContainer from './filterable'
import ChipableContainer from './chipable'
import AsyncSelectContainer from './async-select'

const components = [
  DrawerContainer,  
  TextFieldContainer,
  TextFieldHelperTextContainer,
  ButtonContainer,
  FilterableContainer,
  ChipableContainer,
  AsyncSelectContainer,  
]

/**
 * 
 * @param {object} component
 * @return {undefined} 
 */
const render = component => {
  let i = 0
  const elements = document.querySelectorAll(component().selector)

  for (i; i < elements.length; i++) {
    component().init(elements[i])
  }
}

const app = () => {
  Mdc()

  components.map(render)
}

window.addEventListener('load', app);