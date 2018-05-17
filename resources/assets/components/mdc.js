const Mdc = () => {
  
  if (!window.mdc) return

  window.mdc.autoInit()
}

export default Mdc