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
      const {name} = item;

      if (!isLegendaryItem(name)) {
        item.sellIn -= 1;

        if (item.quality > 0 && item.quality < 50) {
          if (this.isAgedBrieItem(name)) {
            this.updateAgedBrieItem(item);
          }

          if (this.isBackstagePassesItem(name)) {
            this.updateBackstagePassesItem(item);
          }

          if (this.isConjuredItem(name)) {
            this.updateConjuredItem(item);
          }

          if (this.isNormalItem(name)) {
            this.updateNormalItem(item);
          }
        }

        if (item.quality > 50) {
          item.quality = 50;
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

  isConjuredItem(name) {
    return name.includes('Conjured');
  }

  isNormalItem(name) {
    return !this.isAgedBrieItem(name) && !this.isBackstagePassesItem(name) && !this.isConjuredItem(name);
  }

  minusItemQuality(item, quality = 1, multiple = 1) {
    item.quality -= (quality * multiple);
  }

  plusItemQuality(item, quality = 1, multiple = 1) {
    item.quality += (quality * multiple);
  }

  updateNormalItem(item) {
    const {name, sellIn, quality} = item;

    if (sellIn < 0) {
      this.minusItemQuality(item, 1, 2);
    } else {
      this.minusItemQuality(item, 1, 1);
    }
  }

  updateAgedBrieItem(item) {
    const {name, sellIn, quality} = item;

    if (sellIn < 0) {
      this.plusItemQuality(item, 1, 2);
    } else {
      this.plusItemQuality(item, 1, 1);
    }
  }

  updateBackstagePassesItem(item) {
    const {name, sellIn, quality} = item;

    if (sellIn >= 10) {
      this.plusItemQuality(item, 1, 1);
    } else if (sellIn < 10 && sellIn >= 6) {
      this.plusItemQuality(item, 2, 1);
    } else if (sellIn < 5 && sellIn >= 0) {
      this.plusItemQuality(item, 3, 1);
    } else {
      item.quality = 0;
    }
  }

  updateConjuredItem(item) {
    const {name, sellIn, quality} = item;

    if (sellIn < 0) {
      this.minusItemQuality(item, 1, 4);
    } else {
      this.minusItemQuality(item, 1, 2);
    }
  }
}

module.exports = {
  Item,
  Shop
}
