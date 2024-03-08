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

export class GildedRose {
  items: Array<Item>;

  constructor(items = [] as Array<Item>) {
    this.items = items;
  }

  updateQuality() {
    for (let i = 0; i < this.items.length; i++) {
      if (this.items[i].name == 'Sulfuras, Hand of Ragnaros') continue;

      this.items[i].sellIn -= 1;
      const isSellInLessThanZero = this.items[i].sellIn < 0

      switch (this.items[i].name) {
        case 'Aged Brie':
          this.items[i].quality += isSellInLessThanZero ? 2 : 1;
          if (this.items[i].quality > 50) {
            this.items[i].quality = 50;
          }
          break;
        case 'Backstage passes to a TAFKAL80ETC concert':
          if (isSellInLessThanZero) {
            this.items[i].quality = 0;
          } else {
            this.items[i].quality += 1;
            
            if (this.items[i].sellIn < 11) {
              this.items[i].quality += 1;
            }
            if (this.items[i].sellIn < 6) { 
              this.items[i].quality += 1;
            }

            if (this.items[i].quality > 50) {
              this.items[i].quality = 50;
            }
          }
          break;
        case 'Conjured':
          this.items[i].quality -= isSellInLessThanZero ? 4 : 2;
          if (this.items[i].quality < 0) {
            this.items[i].quality = 0;
          }
          break;
        default:
          this.items[i].quality -= isSellInLessThanZero ? 2 : 1
          if (this.items[i].quality < 0) {
            this.items[i].quality = 0;
          }
      }
    }

    return this.items;
  }
}
