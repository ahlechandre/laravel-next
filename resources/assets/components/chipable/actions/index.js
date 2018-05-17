export const TYPE_SYNC_CHIPS = 'SYNC_CHIPS'
export const TYPE_ACTIVATE_CHIP = 'ACTIVATE_CHIP'
export const TYPE_DEACTIVATE_CHIP = 'DEACTIVATE_CHIP'

export const syncChips = chips => ({
  type: TYPE_SYNC_CHIPS,
  chips,
})

export const activateChip = chipFor => ({
  type: TYPE_ACTIVATE_CHIP,
  chipFor,
})

export const deactivateChip = chipFor => ({
  type: TYPE_DEACTIVATE_CHIP,
  chipFor,
})