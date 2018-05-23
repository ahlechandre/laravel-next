import AsyncSelect from './AsyncSelect'

/**
 * @return {Object}
 */
const AsyncSelectContainer = () => ({
  selector: '.async-select',
  init: element => {
    const component = new AsyncSelect({
      element
    })

    component.render()
  }
})

export {
  AsyncSelect,
  AsyncSelectContainer
}
