import TextFieldHelperText from './TextFieldHelperText'

const TextFieldHelperTextContainer = () => ({
  selector: '.mdc-text-field-helper-text',
  init: element => TextFieldHelperText(element)
})

export default TextFieldHelperTextContainer
