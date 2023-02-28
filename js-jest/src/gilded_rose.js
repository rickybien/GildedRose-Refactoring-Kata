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
      let {name: itemName, quality, sellIn} = this.items[i];

      if (itemName != 'Aged Brie' && itemName != 'Backstage passes to a TAFKAL80ETC concert') {
        if (quality > 0){
          if (itemName != 'Sulfuras, Hand of Ragnaros') {
            quality = quality - 1;
          }
        }
      } else {
        if (quality < 50) {
          quality = quality + 1;

          if (itemName == 'Backstage passes to a TAFKAL80ETC concert') {
            if (sellIn < 11) {
                quality = quality + 1;
            }
            if (sellIn < 6) {
                quality = quality + 1;
            }
          }
        }
      }

      if (itemName != 'Sulfuras, Hand of Ragnaros') {
        sellIn = sellIn - 1;
      }

      if (sellIn < 0) {
        if (itemName != 'Aged Brie') {
          if (itemName != 'Backstage passes to a TAFKAL80ETC concert') {
            if (quality > 0) {
              if (itemName != 'Sulfuras, Hand of Ragnaros') {
                quality = quality - 1;
              }
            }
          } else {
            quality = quality - quality;
          }
        } else {
          if (quality < 50) {
            quality = quality + 1;
          }
        }
      }

      this.items[i] = {
        name: itemName,
        quality,
        sellIn,
      }
    }

    return this.items;
  }
}

module.exports = {
  Item,
  Shop
}
