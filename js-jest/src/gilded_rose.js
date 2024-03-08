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
    this.legendaryItem = 'Sulfuras, Hand of Ragnaros';
    this.decreaseSellIn = 1;
    this.decreaseQuality = 1;
    this.qualityMax = 50;
    this.qualityMin = 0;
  }
  updateQuality() {
    for (let i = 0; i < this.items.length; i++) {
      if (this.items[i].name != 'Aged Brie' && this.items[i].name != 'Backstage passes to a TAFKAL80ETC concert') {
        if (this.items[i].quality > 0) {
          if (this.items[i].name != 'Sulfuras, Hand of Ragnaros') {
            this.items[i].quality = this.items[i].quality - 1;
          }
        }
      } else {
        if (this.items[i].quality < 50) {
          this.items[i].quality = this.items[i].quality + 1;
          if (this.items[i].name == 'Backstage passes to a TAFKAL80ETC concert') {
            if (this.items[i].sellIn < 11) {
              if (this.items[i].quality < 50) {
                this.items[i].quality = this.items[i].quality + 1;
              }
            }
            if (this.items[i].sellIn < 6) {
              if (this.items[i].quality < 50) {
                this.items[i].quality = this.items[i].quality + 1;
              }
            }
          }
        }
      }
      if (this.items[i].name != 'Sulfuras, Hand of Ragnaros') {
        this.items[i].sellIn = this.items[i].sellIn - 1;
      }
      if (this.items[i].sellIn < 0) {
        if (this.items[i].name != 'Aged Brie') {
          if (this.items[i].name != 'Backstage passes to a TAFKAL80ETC concert') {
            if (this.items[i].quality > 0) {
              if (this.items[i].name != 'Sulfuras, Hand of Ragnaros') {
                this.items[i].quality = this.items[i].quality - 1;
              }
            }
          } else {
            this.items[i].quality = this.items[i].quality - this.items[i].quality;
          }
        } else {
          if (this.items[i].quality < 50) {
            this.items[i].quality = this.items[i].quality + 1;
          }
        }
      }
    }

    return this.items;
  }

  updateSellIn(item) {
    if(item.name === this.legendaryItem) return
    item.sellIn -= this.decreaseSellIn
  }

  updateNormal(item) {
    item.sellIn < 0 ? item.quality -= this.decreaseQuality * 2 : item.quality -= this.decreaseQuality
    item.quality < this.qualityMin ? item.quality = this.qualityMin : item.quality
  }

  updateAgedBrie(item) {
    item.sellIn < 0 ? item.quality += this.decreaseQuality * 2 : item.quality += this.decreaseQuality
    item.quality > this.qualityMax ? item.quality = this.qualityMax : item.quality
  }

  updateSulfuras(_item) {
    return
  }

  updateBackstagePass(item) {
    const firstSellInStage = 10
    const secondSellInStage = 6

    if(item.sellIn < 0) {
      item.quality = 0
    } else if(item.sellIn < secondSellInStage) {
      item.quality += this.decreaseQuality * 3
    } else if(item.sellIn < firstSellInStage) {
      item.quality += this.decreaseQuality * 2
    } else {
      item.quality += this.decreaseQuality
    }
    item.quality > this.qualityMax ? item.quality = this.qualityMax : item.quality
  }

  updateConjured(item) {
    item.sellIn < 0 ? item.quality -= this.decreaseQuality * 4 : item.quality -= this.decreaseQuality * 2
    item.quality < this.qualityMin ? item.quality = this.qualityMin : item.quality
  }
}

module.exports = {
  Item,
  Shop
}
