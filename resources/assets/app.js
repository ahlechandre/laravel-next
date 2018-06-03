import { DrawerContainer, DrawerTemporary } from './components/drawer'
import { TextFieldContainer, TextField } from './components/textfield'
import { TextFieldHelperTextContainer, TextFieldHelperText } from './components/textfield-helper-text'
import { ButtonContainer, Button } from './components/button'
import { TopAppBarContainer, TopAppBar } from './components/top-app-bar'
import { SnackbarContainer, Snackbar } from './components/snackbar'
import { RippleContainer, Ripple } from './components/ripple'
import { SelectContainer, Select } from './components/select'
import { MDCAutocomplete } from './components/autocomplete'

/**
 * Inicializa automaticamente todos os componentes indicados.
 * 
 * @return {undefined} 
 */
const autoInit = () => {
  // Lista de containers de componentes a serem inicializados automaticamente.
  const containers = [
    DrawerContainer,  
    TextFieldContainer,
    TextFieldHelperTextContainer,
    ButtonContainer,
    TopAppBarContainer,
    SnackbarContainer,
    RippleContainer,
    SelectContainer,
  ]
  containers.map(container => {
    let i = 0
    const elements = document.querySelectorAll(container().selector)
  
    for (i; i < elements.length; i++) {
      container().init(elements[i])
    }  
  })
}

const app = () => {
  // Inicializa os componentes.
  autoInit()
}

window.addEventListener('load', app);