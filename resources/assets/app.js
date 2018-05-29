import { DrawerContainer, DrawerTemporary } from './components/drawer'
import { TextFieldContainer, TextField } from './components/textfield'
import { TextFieldHelperTextContainer, TextFieldHelperText } from './components/textfield-helper-text'
import { ButtonContainer, Button } from './components/button'
import { TopAppBarContainer, TopAppBar } from './components/top-app-bar'
import { SnackbarContainer, Snackbar } from './components/snackbar'
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