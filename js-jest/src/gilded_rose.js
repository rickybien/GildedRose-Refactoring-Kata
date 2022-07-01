const AgedBrie = require('./AgedBrie');
const Backstage = require('./Backstage');
const Normal = require('./Normal');

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
  
  updateQuality() {
    this.items.forEach(item => {
      const {name} = item;

      switch(name) {
        case 'Aged Brie':
          new AgedBrie(item).update();
          break;
        case 'Sulfuras, Hand of Ragnaros':
          break;
        case 'Backstage passes to a TAFKAL80ETC concert':
          new Backstage(item).update();
          break;
        default:
          new Normal(item).update();
          break;
      }
    });

    return this.items;
  }
}

module.exports = {
  Item,
  Shop
}
