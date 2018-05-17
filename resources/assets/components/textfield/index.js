import TextField from './TextField'

const TextFieldContainer = () => ({
  selector: '.mdc-text-field',
  init: element => TextField(element)
})

export default TextFieldContainer
