// aged `Quality`会随着时间推移而提高
const aged = ['Aged Brie']; 

// backstage `Quality`会随着时间推移而提高；
// 当还剩10天或更少的时候，品质`Quality`每天提高2
// 当还剩5天或更少的时候，品质`Quality`每天提高3
// 但一旦过期，品质就会降为0
const backstage = ['Backstage passes to a TAFKAL80ETC concert']; 

// sulfuras 永不过期，也不会降低品质`Quality`
const sulfuras = ['Sulfuras, Hand of Ragnaros'];



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
      let { name, quality, sellIn } = this.items[i];
      if (!sulfuras.includes(name)) {
        sellIn--;
        if (backstage.includes(name)) {
          if (sellIn < 0) {
            quality = 0;
          } else if (sellIn < 5) {
            quality += 3;
          } else if (sellIn < 10) {
            quality += 2;
          } else {
            quality++;
          }
        } else {
          let diff = (sellIn < 0) ? 2 : 1;
          diff *= (aged.includes(name))? 1 : -1;
          quality += diff;
        }
      }
      this.items[i].quality = (quality < 0) ? 0 : (quality > 50) ? 50 : quality;
      this.items[i].sellIn = sellIn;
    }

    return this.items;
  }
}

module.exports = {
  Item,
  Shop
}
