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
    this.sellInMin = 0;
    this.qualityMax = 50;
    this.qualityMin = 0;

    this.updateMethods = {
      'Aged Brie': this.updateAgedBrie.bind(this),
      'Sulfuras, Hand of Ragnaros': this.updateSulfuras.bind(this),
      'Backstage passes to a TAFKAL80ETC concert': this.updateBackstagePass.bind(this),
      'Conjured': this.updateConjured.bind(this),
    };
  }
  updateQuality() {
    this.items.forEach((item) => {
      this.updateSellIn(item)

      const updateMethod = this.updateMethods[item.name]
      updateMethod ? updateMethod(item) : this.updateNormal(item)
    })

    return this.items;
  }

  updateSellIn(item) {
    if(item.name === this.legendaryItem) return
    item.sellIn -= this.decreaseSellIn
  }

  updateNormal(item) {
    item.sellIn < this.sellInMin ? item.quality -= this.decreaseQuality * 2 : item.quality -= this.decreaseQuality
    item.quality < this.qualityMin ? item.quality = this.qualityMin : item.quality
  }

  updateAgedBrie(item) {
    item.sellIn < this.sellInMin ? item.quality += this.decreaseQuality * 2 : item.quality += this.decreaseQuality
    item.quality > this.qualityMax ? item.quality = this.qualityMax : item.quality
  }

  updateSulfuras(_item) {
    return
  }

  updateBackstagePass(item) {
    const firstSellInStage = 10
    const secondSellInStage = 6

    if(item.sellIn < this.sellInMin) {
      item.quality = this.qualityMin
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
    item.sellIn < this.sellInMin ? item.quality -= this.decreaseQuality * 4 : item.quality -= this.decreaseQuality * 2
    item.quality < this.qualityMin ? item.quality = this.qualityMin : item.quality
  }
}

module.exports = {
  Item,
  Shop
}
