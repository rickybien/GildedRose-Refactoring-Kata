export class Item {
  name: string;
  sellIn: number;
  quality: number;

  constructor(name: string, sellIn: number, quality: number) {
    this.name = name;
    this.sellIn = sellIn;
    this.quality = quality;
  }
}

enum ItemType { 
  Normal = 'normal',
  AgedBrie = 'Aged Brie',
  Sulfuras = 'Sulfuras, Hand of Ragnaros',
  Backstage = 'Backstage passes to a TAFKAL80ETC concert',
  Conjured = 'Conjured Mana Cake'
}

class ItemHandler extends Item{
  constructor(name: string, sellIn: number, quality: number) { 
    super(name, sellIn, quality);
  }

  addQuality(count: number) {
    this.quality += count;
  }
  minusQuality(count: number) { 
    this.quality -= count;
  }
  minusSellIn() {
    this.sellIn -= 1;
  }
  isAvailableQuality() { 
    return this.quality > 0 && this.quality < 50;
  }
  isSellIn() {
    return this.sellIn < 1;
  }
  updateQuality() {
    if (this.name === ItemType.Sulfuras) return this

    if (this.isSellIn() && this.isAvailableQuality()) {
      if (this.name === ItemType.AgedBrie) {
        this.addQuality(1);
      } 
      if (this.name === ItemType.Backstage) { 
        this.minusQuality(this.quality);
      }
      if ([ItemType.Normal, ItemType.Conjured].includes(this.name as ItemType)) {
        this.minusQuality(this.name === ItemType.Conjured ? 2 : 1);
      }
    }

    if (this.isAvailableQuality()) {
      if (this.name === ItemType.Normal) { 
        this.minusQuality(1);
      }
      if (this.name === ItemType.AgedBrie) { 
        this.addQuality(1);
      }
      if (this.name === ItemType.Backstage) {
        this.addQuality(1);
        if (this.sellIn < 11) {
          this.addQuality(1);
        }
        if (this.sellIn < 6) {
          this.addQuality(1);
        }
      }
      if (this.name === ItemType.Conjured) { 
        this.minusQuality(2);
      }
    }

    this.minusSellIn();

    return this;
  }
}
export class GildedRose {
  items: Array<Item>;

  constructor(items = [] as Array<Item>) {
    this.items = items;
  }

  updateQuality() {
    for (let i = 0; i < this.items.length; i++) {
      if (this.items[i].name != 'Aged Brie' && this.items[i].name != 'Backstage passes to a TAFKAL80ETC concert') {
        if (this.items[i].quality > 0) {
          if (this.items[i].name != 'Sulfuras, Hand of Ragnaros') {
            this.items[i].quality = this.items[i].quality - 1
          }
        }
      } else {
        if (this.items[i].quality < 50) {
          this.items[i].quality = this.items[i].quality + 1
          if (this.items[i].name == 'Backstage passes to a TAFKAL80ETC concert') {
            if (this.items[i].sellIn < 11) {
              if (this.items[i].quality < 50) {
                this.items[i].quality = this.items[i].quality + 1
              }
            }
            if (this.items[i].sellIn < 6) {
              if (this.items[i].quality < 50) {
                this.items[i].quality = this.items[i].quality + 1
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
                this.items[i].quality = this.items[i].quality - 1
              }
            }
          } else {
            this.items[i].quality = this.items[i].quality - this.items[i].quality
          }
        } else {
          if (this.items[i].quality < 50) {
            this.items[i].quality = this.items[i].quality + 1
          }
        }
      }
    }

    return this.items;
  }
}
