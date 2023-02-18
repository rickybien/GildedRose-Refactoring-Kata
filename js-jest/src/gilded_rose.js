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
  updateQuality() {
    this.items.forEach(item => {
      if (qualityCheckPass(item.quality) && !isSulfurasItem(item.name)) {
        item.sellIn -= 1;
        switch (item.name) {
          case 'Aged Brie':
            item.quality += isBeforeSellInDate(item.sellIn) ? 1 : 2;
            break;
          case 'Backstage passes to a TAFKAL80ETC concert':
            if (item.sellIn >= 10) {
              item.quality += 1;
            } else if (item.sellIn >= 6) {
              item.quality += 2;
            } else if (item.sellIn >= 0) {
              item.quality += 3;
            } else {
              item.quality = 0;
            }
            break;
          case 'Conjured':
            item.quality -= qualityMinusValue(item.sellIn, true);
            break;
          default:
            item.quality -= qualityMinusValue(item.sellIn);
            break;
        };
      }
      itemQualityCalibrate(item);
    });
    return this.items;
  }
}

isBeforeSellInDate = sellIn => sellIn > 0;

isSulfurasItem = name => name === 'Sulfuras, Hand of Ragnaros';

qualityCheckPass = quality => quality >= 0 && quality <= 50;

qualityMinusValue = (sellIn, isConjured = false) => {
  if (isConjured) {
    return isBeforeSellInDate(sellIn) ? 2 : 4;
  }
  return isBeforeSellInDate(sellIn) ? 1 : 2;
};

itemQualityCalibrate = item => {
  if (item.quality > 50) {
    item.quality = 50;
  } else if (item.quality < 0) {
    item.quality = 0;
  }
};

module.exports = {
  Item,
  Shop
}
