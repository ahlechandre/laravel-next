import fetch from 'cross-fetch'

export const TYPE_REQUEST_ITEMS = 'REQUEST_ITEMS'
export const TYPE_INVALIDATE_REQUEST = 'INVALIDATED_REQUEST_ITEMS'
export const TYPE_RECEIVE_ITEMS = 'TYPE_RECEIVE_ITEMS'

/**
 * Ação de requisitar items.
 * 
 * @param {string} api 
 * @param {string} query 
 */
export const requestItems = (api, query) => ({
  type: TYPE_REQUEST_ITEMS,
  api,
  query,
}) 

/**
 * Ação de invalidar uma requisição.
 * 
 */
export const invalidateRequest = (error) => ({
  type: TYPE_INVALIDATE_REQUEST,
  error,
}) 

/**
 * Ação de adicionar items do servidor.
 * 
 * @param {object} items 
 */
export const receiveItems = items => ({
  type: TYPE_RECEIVE_ITEMS,
  items,
})

const fetchItems = (api, query) => dispatch => {
  dispatch(requestItems(api, query))

  return fetch(`${api}?q=${query}`)
    .then(response => response.json())
    .then(json => dispatch(receiveItems(json)))
    .catch(error => invalidateRequest(error))
}

const shouldFetchItems = (state, query) => {
  return !state.isFetching
}

/**
 * Ação de buscar items no servidor apenas se necessário.
 * 
 * @param {string} api 
 * @param {string} query 
 */
export const fetchItemsIfNeeded = (api, query) => (dispatch, getState) => {
  if (shouldFetchItems(getState(), query)) {
    return fetchItems(api, query)(dispatch)
  }
  
  return Promise.resolve()
}
