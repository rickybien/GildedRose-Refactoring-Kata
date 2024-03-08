const QUALITY_MIN = 0;
const QUALITY_MAX = 50;

export const specialItems = {
  AGED_BRIE: 'Aged Brie',
  SULFURAS: 'Sulfuras, Hand of Ragnaros',
  BACKSTAGE_PASSES: 'Backstage passes to a TAFKAL80ETC concert',
  CONJURED: 'Conjured',
};

export function checkSpecialItemByName(itemName) {
  return Object.values(specialItems).includes(itemName);
};

export function clamp(value, min = QUALITY_MIN, max = QUALITY_MAX) {
  return Math.min(Math.max(value, min), max);
}
