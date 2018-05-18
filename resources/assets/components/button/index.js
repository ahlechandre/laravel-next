import Button from './Button'

const ButtonContainer = () => ({
  selector: '.button',
  init: element => Button(element),
})

export default ButtonContainer
