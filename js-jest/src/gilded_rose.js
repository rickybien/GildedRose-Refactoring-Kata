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

  get specialItemsName () {
    return [
      'Aged Brie', 'Sulfuras, Hand of Ragnaros', 'Backstage passes to a TAFKAL80ETC concert',
    ];
  }

  updateQuality() {
    this.items.forEach(item => {
      this.updateAgedBrieItem(item);
      this.updateBackstagePassesItem(item);
      this.updateNormalItem(item);
    });

    return this.items;
  }

  updateNormalItem(item) {
    if (this.specialItemsName.includes(item.name)) {
      return;
    }

    item.sellIn -= 1;

    if (item.quality > 0 && item.quality <= 50) {
      if (item.sellIn < 0) {
        item.quality -= 2;
      } else {
        item.quality -= 1;
      }
    }
  }

  updateAgedBrieItem(item) {
    if (item.name === 'Aged Brie') {
      item.sellIn -= 1;

      if (item.quality > 0 && item.quality < 50) {
        if (item.sellIn < 0 && item.quality !== 49) {
          item.quality += 2;
        } else {
          item.quality += 1;
        }
      }
    }
  }

  updateBackstagePassesItem(item) {
    if (item.name === 'Backstage passes to a TAFKAL80ETC concert') {
      item.sellIn -= 1;

      if (item.quality > 0 && item.quality < 50) {
        if (item.sellIn >= 10) {
          item.quality += 1;
        } else if (item.sellIn < 10 && item.sellIn >= 6 && item.quality !== 49) {
          item.quality += 2;
        } else if (item.sellIn < 5 && item.sellIn >= 0 && item.quality !== 48) {
          item.quality += 3;
        } else {
          item.quality = 0;
        }
      }
    }
  }
}

module.exports = {
  Item,
  Shop
}
