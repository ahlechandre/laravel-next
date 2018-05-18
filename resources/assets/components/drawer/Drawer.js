import { MDCPersistentDrawer } from '@material/drawer'

/**
 * Armazena todos os atributos datasets do componente. 
 */
const datasets = {
  'DRAWER_TOGGLE': 'drawer-toggle'
}

/**
 * Componente específico para drawers persistentes.
 *  
 * @param {HTMLElement} element 
 */
const DrawerPersistent = element => {
  const toggleButtonSelector = `[data-${datasets['DRAWER_TOGGLE']}]`;
  const toggleButton = document.querySelector(toggleButtonSelector)
  const drawer = new MDCPersistentDrawer(element)
  const onToggleDrawer = () => (
    drawer.open = !drawer.open
  )
  const isDesktop = screen.width > 920
  drawer.open = isDesktop

  if (toggleButton) {
    toggleButton.addEventListener('click', onToggleDrawer)
  }
}

/**
 * 
 * @param {HTMLElement} element 
 */
const Drawer = element => {
  /**
   * Especificações do componente.
   */
  const modifiers = [
    {
      className: 'mdc-drawer--persistent',
      component: DrawerPersistent 
    }
  ]

  /**
   * Verifica se o elemento HTML referente à especificação existe e
   * invoca o seu componente.
   * 
   * @param {Object} modifier
   * @param {HTMLElement} element
   * @return void
   */
  const mapModifierToComponent = (modifier, element) => {
    const exists = element.classList.contains(modifier.className)

    if (!exists) return
    
    // Se existir, invoca o componente específico.
    modifier.component(element)
  }

  modifiers.map(modifier => mapModifierToComponent(modifier, element))
}

export default Drawer
