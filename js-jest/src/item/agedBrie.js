const Item = require('./item');

class AgedBrie extends Item {
    constructor(sellIn, quality) {
        super('Aged Brie', sellIn, quality);
    }

    updateItem() {
        this.sellIn -= 1;
        // "Aged Brie"（陈年布利奶酪）的品质`Quality`会随着时间推移而提高
        // 物品的品质`Quality`永远不会超过50
        this.quality = Math.min(50, (this.sellIn > 0 ? this.quality + 1 : this.quality + 2));
    }
}

module.exports = AgedBrie;
