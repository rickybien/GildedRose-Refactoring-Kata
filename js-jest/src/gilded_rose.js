const {
  Item,
  OtherItem,
  AgedBrie,
  BackstagePasses,
  Conjured,
  Sulfuras,
} = require('./item');

class Shop {
  constructor(items = []) {
    this.items = items.map((item) => {
      switch (item.name) {
        case 'Sulfuras, Hand of Ragnaros':
          return new Sulfuras(item.sellIn, item.quality);
        case 'Aged Brie':
          return new AgedBrie(item.sellIn, item.quality);
        case 'Backstage passes to a TAFKAL80ETC concert':
          return new BackstagePasses(item.sellIn, item.quality);
        case 'Conjured Item':
          return new Conjured(item.name, item.sellIn, item.quality);
        default:
          return new OtherItem(item.name, item.sellIn, item.quality);
      }
    });
  }
  updateQuality() {
    this.items.forEach((item) => item.updateItem());
    return this.items;
  }
}

module.exports = {
  Item,
  Shop,
};
