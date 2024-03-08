const Item = require('./item');

class Conjured extends Item {
    updateItem() {
        this.sellIn -= 1;
        // 一旦销售期限过期，品质`Quality`会以双倍速度加速下降
        // "Conjured"（召唤物品）的品质`Quality`下降速度比正常物品快一倍
        this.quality = Math.max(0, this.sellIn > 0 ? this.quality - 2 : this.quality - 4);
    }
}

module.exports = Conjured;
