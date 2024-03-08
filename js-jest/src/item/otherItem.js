const Item = require('./item');

class OtherItem extends Item {
    updateItem() {
        this.sellIn -= 1;
        this.quality = Math.max((this.sellIn > 0 ? this.quality - 1 : this.quality - 2), 0);
    }
}

module.exports = OtherItem;
