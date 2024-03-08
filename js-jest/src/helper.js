export const specialItems = {
  AGED_BRIE: 'Aged Brie',
  SULFURAS: 'Sulfuras, Hand of Ragnaros',
  BACKSTAGE_PASSES: 'Backstage passes to a TAFKAL80ETC concert',
  CONJURED: 'Conjured',
};

export function checkSpecialItemByName(itemName) {
  return Object.values(specialItems).includes(itemName);
};

export function clamp(value, min = 0, max = 50) {
  return Math.min(Math.max(value, min), max);
}
