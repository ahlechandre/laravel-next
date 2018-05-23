import { MDCTopAppBar } from '@material/top-app-bar/index';

class TopAppBar {

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
   * 
   * @return {undefined}
   */
  render() {
    // Instancia o novo componente.
    new MDCTopAppBar(this.state.element)
  }
}

export default TopAppBar
