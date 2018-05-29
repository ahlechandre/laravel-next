import { DrawerContainer, DrawerTemporary } from './drawer'
import { TextFieldContainer, TextField } from './textfield'
import { TextFieldHelperTextContainer, TextFieldHelperText } from './textfield-helper-text'
import { ButtonContainer, Button } from './button'
import { TopAppBarContainer, TopAppBar } from './top-app-bar'
import { SnackbarContainer, Snackbar } from './snackbar'
import { MDCAutocomplete } from './autocomplete'

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
    SnackbarContainer
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

  // Disponibiliza todos os componentes globalmente. 
  window.mdcn = {
    MDCAutocomplete,
    DrawerTemporary,
    TextField,
    TextFieldHelperText,
    Button,
    TopAppBar,
    Snackbar
  }
}

window.addEventListener('load', app);