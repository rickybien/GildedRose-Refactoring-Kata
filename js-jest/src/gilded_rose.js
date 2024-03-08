import {
  specialItems,
  checkSpecialItemByName,
  clamp,
} from './helper';

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
    for (let i = 0; i < this.items.length; i++) {
      if(this.items[i].name === specialItems.SULFURAS) {
        return this.items;
      }

      this.items[i].sellIn--;

      const item = this.items[i];
      const { name, sellIn, quality } = item;

      // normal item
      if(!checkSpecialItemByName(name)) {
        if(sellIn < 0) {
          this.items[i].quality = clamp(quality - 2);
        } else {
          this.items[i].quality = clamp(quality - 1);
        }
      }

      // special item
      if(name === specialItems.AGED_BRIE) {
        if(sellIn < 0) {
          this.items[i].quality = clamp(quality + 2);
        } else {
          this.items[i].quality = clamp(quality + 1);
        }
      }

      if(name === specialItems.BACKSTAGE_PASSES) {
        if(sellIn < 0) {
          this.items[i].quality = 0;
        } else if(sellIn < 5) {
          this.items[i].quality = clamp(quality + 3);
        } else if(sellIn < 10) {
          this.items[i].quality = clamp(quality + 2);
        } else {
          this.items[i].quality = clamp(quality + 1);
        }
      }
    }

    return this.items;
  }
}

export {
  Item,
  Shop
}
