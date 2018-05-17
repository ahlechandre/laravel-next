import Drawer from './Drawer'

const DrawerContainer = () => ({
  selector: '.mdc-drawer',
  init: element => Drawer(element)
})

export default DrawerContainer
