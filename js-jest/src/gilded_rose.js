import { itemSettings } from './config';

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
      const currentSetting = itemSettings[this.items[i].name] ?? itemSettings.DEFAULT;

      this.items[i].sellIn = currentSetting.sellIn(this.items[i].sellIn);
      this.items[i].quality = currentSetting.quality(this.items[i].sellIn, this.items[i].quality);
    }
    return this.items;
  }
}

export {
  Item,
  Shop
}
