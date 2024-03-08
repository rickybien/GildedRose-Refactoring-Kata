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
    for (let item of this.items) {
      let productName;
      if(item.name.includes('Backstage passes')){
        productName = 'Backstage passes';
      } else if(item.name.includes('Conjured')){
        productName = 'Conjured';
      } else if(item.name.includes('Aged Brie')){
        productName = 'Aged Brie';
      } else if(item.name.includes('Sulfuras')){
        productName = 'Sulfuras';
      } else {
        productName = 'normal';
      }

      switch (productName) {
        case 'Aged Brie':
          if(item.quality < 50){
            item.quality++;
          }
          item.sellIn --;
          if(item.sellIn < 0 && item.quality < 50){
            item.quality++;
          }
          break;
        case 'Backstage passes':
          if(item.quality < 50){
            item.quality++;
            if(item.sellIn < 11) {
              item.quality++;
            }
            if(item.sellIn < 6) {
              item.quality++;
            }
          }
          item.sellIn --;
          if(item.sellIn < 0){
            item.quality = 0;
          }
          break;
        case 'Sulfuras':
          break;
        case 'Conjured':
          if (item.quality > 0) {
            item.quality = item.quality - 2;
          }
          item.sellIn--;
          if(item.sellIn < 0 && item.quality > 0){
            item.quality = item.quality - 2;
          }
          break;
        default:
          if (item.quality > 0) {
            item.quality--;
          }
          item.sellIn--;
          if (item.sellIn < 0 && item.quality > 0) {
            item.quality--;
          }
          break;
      }
    }

    return this.items;
  }
}

module.exports = {
  Item,
  Shop
}
