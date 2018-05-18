import AsyncSelect from './AsyncSelect'

const AsyncSelectContainer = () => ({
  selector: '.async-select',
  init: element => {
    const component = new AsyncSelect({
      element
    })

    component.render()
  }
})

export default AsyncSelectContainer
