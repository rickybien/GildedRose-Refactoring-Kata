export class Item {
  name: string;
  sellIn: number;
  quality: number;

  constructor(name, sellIn, quality) {
    this.name = name;
    this.sellIn = sellIn;
    this.quality = quality;
  }
}

const qualityMaximum = 50
const qualityMinimum = 0


export class GildedRose {
  items: Array<Item>;

  constructor(items = [] as Array<Item>) {
    this.items = items;
  }

  fixQuality(quality: number) {
    if (quality > qualityMaximum) {
      return qualityMaximum
    }
    if (quality < qualityMinimum) {
      return qualityMinimum
    }
    return quality
  }

  calcAgedBrieQuality(nextSellIn: number, quality: number) {
    return this.fixQuality(quality + (nextSellIn < 0 ? 2 : 1))
  }

  calcBackstagePassQuality(nextSellIn: number, quality: number) {
    let nextQuality: number
    switch (true) {
      case nextSellIn < 0:
        nextQuality = 0
        break
      case nextSellIn < 5:
        nextQuality = quality + 3
        break
      case nextSellIn < 10: 
        nextQuality = quality + 2
        break
      default:
        nextQuality = quality + 1
        break
    }
    return this.fixQuality(nextQuality)
  }

  calcNormalQuality(nextSellIn: number, quality: number) {
    return this.fixQuality(quality - (nextSellIn < 0 ? 2 : 1))
  }

  updateQuality() {
    this.items.forEach(item => {
      const nextSellIn = item.sellIn - 1
      switch (item.name) {
        case 'Aged Brie':
          item.sellIn = nextSellIn
          item.quality = this.calcAgedBrieQuality(nextSellIn, item.quality)
          break
        case 'Backstage passes to a TAFKAL80ETC concert':
          item.sellIn = nextSellIn
          item.quality = this.calcBackstagePassQuality(nextSellIn, item.quality)
        case 'Sulfuras, Hand of Ragnaros':
          break
        default:
          item.sellIn = nextSellIn
          item.quality = this.calcNormalQuality(nextSellIn, item.quality)
          return
      }
    })
    
    return this.items;
  }
}
