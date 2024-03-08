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
      let productName;
      if(this.items[i].name.includes('Backstage passes')){
        productName = 'Backstage passes';
      } else if(this.items[i].name.includes('Conjured')){
        productName = 'Conjured';
      } else if(this.items[i].name.includes('Aged Brie')){
        productName = 'Aged Brie';
      } else if(this.items[i].name.includes('Sulfuras')){
        productName = 'Sulfuras';
      } else {
        productName = 'normal';
      }

      switch (productName) {
        case 'Aged Brie':
          if(this.items[i].quality < 50){
            this.items[i].quality++;
          }
          this.items[i].sellIn --;
          if(this.items[i].sellIn < 0 && this.items[i].quality < 50){
            this.items[i].quality++;
          }
          break;
        case 'Backstage passes':
          if(this.items[i].quality < 50){
            this.items[i].quality++;
            if(this.items[i].sellIn < 11) {
              this.items[i].quality++;
            }
            if(this.items[i].sellIn < 6) {
              this.items[i].quality++;
            }
          }
          this.items[i].sellIn --;
          if(this.items[i].sellIn < 0){
            this.items[i].quality = 0;
          }
          break;
        case 'Sulfuras':
          break;
        case 'Conjured':
          if (this.items[i].quality > 0) {
            this.items[i].quality = this.items[i].quality - 2;
          }
          this.items[i].sellIn--;
          if(this.items[i].sellIn < 0 && this.items[i].quality > 0){
            this.items[i].quality = this.items[i].quality - 2;
          }
          break;
        default:
          if (this.items[i].quality > 0) {
            this.items[i].quality--;
          }
          this.items[i].sellIn--;
          if (this.items[i].sellIn < 0 && this.items[i].quality > 0) {
            this.items[i].quality--;
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
