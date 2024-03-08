class Item {
  constructor(name, sellIn, quality){
    this.name = name;
    this.sellIn = sellIn;
    this.quality = quality;
  }
}
AgedGoodsWithoutTimeLimitArr = ['Aged Brie']
AgedGoodsWithTimeLimitArr = ['Backstage passes to a TAFKAL80ETC concert']
ImmortalGoodsArr = ['Sulfuras, Hand of Ragnaros']

class Shop {
  constructor(items=[]){
    this.items = items;
  }

  updateSellIn (item) {
    item.sellIn--
  }

  updateAgedGoodsWithoutTimeLimitQuality (item) {
    if (item.sellIn > 0) {
      item.quality++
    } else {
      item.quality += 2
    }
    if (item.quality > 50) item.quality = 50
  }

  updateAgedGoodsWithTimeLimitQuality (item) {
    switch (true) {
      case item.sellIn > 10:
        item.quality++
        break
      case item.sellIn > 5:
        item.quality+= 2
        break
      case item.sellIn > 0:
        item.quality+= 3
        break
      case item.sellIn <= 0:
        item.quality = 0
        break
      default:
        console.error(`item sellIn is not a number, sellIn: ${item.sellIn}`)
    }
    if (item.quality > 50) item.quality = 50
  }

  updateNormalGoodsQuality (item) {
    if (item.sellIn > 0) item.quality--
    else item.quality -= 2

    if (item.quality < 0) item.quality = 0
  }

  updateConjuredGoodsQuality (item) {
    this.updateNormalGoodsQuality(item)
    this.updateNormalGoodsQuality(item)    
  }

  updateQuality() {
    for (let i = 0; i < this.items.length; i++) {
      const item = this.items[i]
      const name = item.name
      switch(true) {
        case AgedGoodsWithoutTimeLimitArr.includes(name): 
          this.updateAgedGoodsWithoutTimeLimitQuality(item)
          this.updateSellIn(item)
          break
        case AgedGoodsWithTimeLimitArr.includes(name):
          this.updateAgedGoodsWithTimeLimitQuality(item)
          this.updateSellIn(item)
          break
        case ImmortalGoodsArr.includes(name):
          break
        case name.includes('conjured'):   // if conjured items are all started with "conjured", then the function could be changed to "startsWith".
          this.updateConjuredGoodsQuality(item)
          this.updateSellIn(item)
          break
        default:
          this.updateNormalGoodsQuality(item)
          this.updateSellIn(item)
          break
      }
    }

    return this.items;
  }
}

module.exports = {
  Item,
  Shop
}
