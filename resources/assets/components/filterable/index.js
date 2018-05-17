import Filterable from './Filterable'

const FilterableContainer = () => ({
  selector: '.ima-filterable',
  init: element => {
    const filterable = new Filterable({
      element
    })
    filterable.render()
  },
})

export default FilterableContainer
