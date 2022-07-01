class Item {
  constructor(name, sellIn, quality) {
    this.name = name;
    this.sellIn = sellIn;
    this.quality = quality;
  }
}

class Shop {
  constructor(items = []) {
    this.items = items;
  }

  updateQuality() {
    const {
      items,
      isLegendaryItem,
      normalItemMap,
    } = this;

    items.forEach(item => {
      const {name, quality} = item;

      if (!isLegendaryItem(name)) {
        item.sellIn -= 1;

        if (quality > 0 && quality < 50) {
          if (this.isAgedBrieItem(name)) {
            this.updateAgedBrieItem(item);
          }

          if (this.isBackstagePassesItem(name)) {
            this.updateBackstagePassesItem(item);
          }

          if (this.isNormalItem(name)) {
            this.updateNormalItem(item);
          }
        }
      }
    });

    return this.items;
  }

  isLegendaryItem(name) {
    return name.includes('Sulfuras');
  }

  isAgedBrieItem(name) {
    return name.includes('Aged Brie');
  }

  isBackstagePassesItem(name) {
    return name.includes('Backstage passes');
  }

  isNormalItem(name) {
    return !this.isAgedBrieItem(name) && !this.isBackstagePassesItem(name);
  }

  updateNormalItem(item) {
    const {name, sellIn, quality} = item;

    if (sellIn < 0) {
      item.quality -= 2;
    } else {
      item.quality -= 1;
    }
  }

  updateAgedBrieItem(item) {
    const {name, sellIn, quality} = item;

    if (quality > 0 && quality < 50) {
      if (sellIn < 0 && quality !== 49) {
        item.quality += 2;
      } else {
        item.quality += 1;
      }
    }
  }

  updateBackstagePassesItem(item) {
    const {name, sellIn, quality} = item;

    if (sellIn >= 10) {
      item.quality += 1;
    } else if (sellIn < 10 && sellIn >= 6 && quality !== 49) {
      item.quality += 2;
    } else if (sellIn < 5 && sellIn >= 0 && quality !== 48) {
      item.quality += 3;
    } else {
      item.quality = 0;
    }
  }
}

module.exports = {
  Item,
  Shop
}
