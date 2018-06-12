import { DrawerContainer } from './components/drawer'
import { TextFieldContainer } from './components/textfield'
import { TextFieldHelperTextContainer } from './components/textfield-helper-text'
import { ButtonContainer} from './components/button'
import { TopAppBarContainer } from './components/top-app-bar'
import { SnackbarContainer } from './components/snackbar'
import { RippleContainer } from './components/ripple'
import { SelectContainer } from './components/select'
import { ChartContainer } from './components/chart'
import { TabBarScrollerContainer } from './components/tab-bar-scroller'

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
    ChartContainer,
    TabBarScrollerContainer
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