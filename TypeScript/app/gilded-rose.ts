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

class Normal extends ItemHandler {
  constructor(sellIn: number, quality: number) {
    super(ItemType.Normal, sellIn, quality);
  }

  updateQuality() {
    return super.updateQuality()
  }
}

class AgedBrie extends ItemHandler {
  constructor(sellIn: number, quality: number) {
    super(ItemType.AgedBrie, sellIn, quality);
  }

  updateQuality() {
    return super.updateQuality()
  }
}

class Sulfuras extends ItemHandler {
  constructor(sellIn: number, quality: number) {
    super(ItemType.Sulfuras, sellIn, quality);
  }

  updateQuality() {
    return super.updateQuality()
  }
}

class Backstage extends ItemHandler {
  constructor(sellIn: number, quality: number) {
    super(ItemType.Backstage, sellIn, quality);
  }

  updateQuality() {
    return super.updateQuality()
  }
}

class Conjured extends ItemHandler {
  constructor(sellIn: number, quality: number) {
    super(ItemType.Conjured, sellIn, quality);
  }

  updateQuality() {
    return super.updateQuality()
  }
}

export class GildedRose {
  items: Array<Item>;

  constructor(items = [] as Array<Item>) {
    this.items = items;
  }

  updateQuality() {
    for (let i = 0; i < this.items.length; i++) {
      const thisItem = this.items[i];

      if (thisItem.name === ItemType.AgedBrie) {
        const agedBrie = new AgedBrie(thisItem.sellIn, thisItem.quality);
        this.items[i] = agedBrie.updateQuality();
      }

      if (thisItem.name === ItemType.Sulfuras) {
        const sulfuras = new Sulfuras(thisItem.sellIn, thisItem.quality);
        this.items[i] = sulfuras.updateQuality();
      }

      if (thisItem.name === ItemType.Normal) {
        const normal = new Normal(thisItem.sellIn, thisItem.quality);
        this.items[i] = normal.updateQuality();
      }

      if (thisItem.name === ItemType.Backstage) {
        const backstage = new Backstage(thisItem.sellIn, thisItem.quality);
        this.items[i] = backstage.updateQuality();
      }

      if (thisItem.name === ItemType.Conjured) {
        const conjured = new Conjured(thisItem.sellIn, thisItem.quality);
        this.items[i] = conjured.updateQuality();
      }
    }

    return this.items;
  }
}
