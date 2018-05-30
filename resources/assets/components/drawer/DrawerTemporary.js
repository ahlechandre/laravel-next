import { MDCTemporaryDrawer } from '@material/drawer'

class DrawerTemporary {
  
  /**
   * @var {Object}
   */
  static constants = {
    TOGGLE_BUTTON_ID: 'top-app-bar-menu',
  }

  /**
   * 
   * @param {Object} props 
   */
  constructor(props) {
    this.state = {
      element: props.element
    }
  }

  /**
   * @return {HTMLElement}
   */
  getToggleButtonElement() {
    return document.querySelector(`#${
      DrawerTemporary.constants.TOGGLE_BUTTON_ID
    }`) 
  }
  
  /**
   * @return {undefined}
   */
  render() {
    // Instancia o componente.
    const drawer = new MDCTemporaryDrawer(this.state.element)
    const toggleButton = this.getToggleButtonElement()

    if (!toggleButton) {
      return
    }
    toggleButton.addEventListener('click', event => {
      event.preventDefault()
      drawer.open = !drawer.open
    })
  }
}

export default DrawerTemporary
