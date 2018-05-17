import { 
  TYPE_ACTIVATE_CHIP,
  TYPE_DEACTIVATE_CHIP,
  TYPE_SYNC_CHIPS
} from '../actions'

const initialState = {
  chips: []
}

const chipableReducer = (state = initialState, action) => {
  switch (action.type) {
    case TYPE_SYNC_CHIPS: {
      return {
        ...state,
        chips: action.chips
      }
    }
    case TYPE_ACTIVATE_CHIP: {
      return {
        ...state,
        chips: state.chips.map(chip => chip.for === action.chipFor ? ({
          ...chip,
          is_active: true,
        }) : chip)
      }
    }
    case TYPE_DEACTIVATE_CHIP: {
      return {
        ...state,
        chips: state.chips.map(chip => chip.for === action.chipFor ? ({
          ...chip,
          is_active: false,
        }) : chip)
      }
    }
    default: {
      return initialState
    }
  }
}

export default chipableReducer
