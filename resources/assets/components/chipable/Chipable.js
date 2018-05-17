import { syncChips, activateChip, deactivateChip } from './actions'

class Chipable {
  datasets = {
    CHIP_LABEL: 'imaChipableLabel',
    CHIP_FOR: 'ima-chipable-for',
  }

  classes = {
    CHIPABLE_ITEM: 'ima-chipable__item',
    CHIPS_CONTAINER: 'ima-chipable__chips',
    CHIP: 'ima-chip',
  }

  constructor(props) {
    this.state = {
      store: props.store,
      element: props.element,
    }
    this.renderChips = this.renderChips.bind(this)

    this.state.store.subscribe(() => this.onStoreChange(
      this.state.store.getState()
    ))
  }
  
  onStoreChange(state) {
    this.clearChipsContainer()

    state.chips.map(chip => chip.is_active ? this.addChipToContainer(chip): chip)
  }

  clearChipsContainer() {
    const container = this.state.chipsContainerElement

    while (container.firstChild) {
      container.removeChild(
        container.firstChild
      )
    }
  }

  addChipToContainer(chip) {
    const container = this.state.chipsContainerElement
    const span = document.createElement('span')
    span.textContent = chip.label
    span.setAttribute(this.datasets['CHIP_FOR'], chip.for)
    span.classList.add(this.classes['CHIP'])
    container.appendChild(span)
  }

  getChipFor(itemElement) {
    return itemElement.getAttribute('id')
  }

  getChipLabel(itemElement) {
    return itemElement.dataset[
      this.datasets['CHIP_LABEL']
    ]
  }

  getChipableItems() {
    return this.state.element.querySelectorAll(`.${
      this.classes['CHIPABLE_ITEM']
    }`)
  }

  getChipContainer() {
    return this.state.element.querySelector(`.${
      this.classes['CHIPS_CONTAINER']
    }`)
  }

  setChipActive(itemElement) {
    const chipFor = this.getChipFor(itemElement)

    this.state.store.dispatch(
      activateChip(chipFor)
    )
  }

  setChipDeactive(itemElement) {
    let i = 0
    const chipFor = this.getChipFor(itemElement)
    const state = this.state.store.getState()

    for (i; i < state.chips.length; i++) {

      if (state.chips[i].for === chipFor && state.chips[i].is_active) {
        this.state.store.dispatch(
          deactivateChip(chipFor)
        )
      }
    }
  }

  renderChips() {
    let i = 0

    for (i; i < this.state.itemElements.length; i++) {

      if (this.state.itemElements[i].checked) {
        this.setChipActive(
          this.state.itemElements[i]
        )
      } else {
        this.setChipDeactive(
          this.state.itemElements[i]
        )
      }
    }
  }

  syncChipItems() {
    let i = 0
    let chips = []

    for (i; i < this.state.itemElements.length; i++) {
      this.state.itemElements[i].addEventListener('change', this.renderChips)

      chips = [
        ...chips,
        {
          for: this.getChipFor(
            this.state.itemElements[i]
          ),
          label: this.getChipLabel(
            this.state.itemElements[i]
          ),
          is_active: this.state.itemElements[i].checked,
        }
      ]
    }

    this.state.store.dispatch(syncChips(chips))
  }

  render() {
    const itemElements = this.getChipableItems()
    const chipsContainerElement = this.getChipContainer()

    if (!itemElements || !chipsContainerElement) return

    this.state = {
      ...this.state,
      chipsContainerElement,
      itemElements,
    }

    this.syncChipItems()
  }
}

export default Chipable
