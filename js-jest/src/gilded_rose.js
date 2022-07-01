const AgedBrie = require('./AgedBrie');
const Backstage = require('./Backstage');
const Normal = require('./Normal');
const Sulfuras = require('./Sulfuras');

class Item {
  constructor(name, sellIn, quality){
    this.name = name;
    this.sellIn = sellIn;
    this.quality = quality;
  }
}

class Shop {
  constructor(items=[]){
    this.items = items;
  }

  get itemMap() {
    return {
      'Aged Brie': AgedBrie,
      'Backstage passes to a TAFKAL80ETC concert': Backstage,
      'Sulfuras, Hand of Ragnaros': Sulfuras,
    };
  }
  
  updateQuality() {
    this.items.forEach(item => {
      const className = this.itemMap[item.name] || Normal;

      new className(item).update();
    });

    return this.items;
  }
}

module.exports = {
  Item,
  Shop
}
