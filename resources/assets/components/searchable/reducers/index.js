import { 
  TYPE_REQUEST_ITEMS, 
  TYPE_RECEIVE_ITEMS, 
  TYPE_INVALIDATE_REQUEST 
} from '../actions'

const initialState = {
  isFetching: false,
  didInvalidate: false,
  api: '',
  query: '',
  items: {}
}

const searchableReducer = (state = initialState, action) => {

  switch (action.type) {
    case TYPE_REQUEST_ITEMS: {
      return {
        ...state,
        isFetching: true,
        didInvalidate: false,
        query: action.query,
        api: action.api,
      }
    }
    case TYPE_INVALIDATE_REQUEST: {
      return {
        ...state,
        isFetching: false,
        didInvalidate: true,
      }
    }
    case TYPE_RECEIVE_ITEMS: {
      return {
        ...state,
        isFetching: false,
        didInvalidate: false,
        items: action.items,
      }
    }
    default: {
      return state
    }
  }
}

export default searchableReducer
