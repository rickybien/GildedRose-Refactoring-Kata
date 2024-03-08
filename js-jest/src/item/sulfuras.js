const Item = require('./item');

class Sulfuras extends Item {
    constructor(sellIn, quality) {
        // 传奇物品"Sulfuras"（萨弗拉斯—炎魔拉格纳罗斯之手）永不过期，也不会降低品质`Quality`
        super('Sulfuras, Hand of Ragnaros', sellIn, quality);
    }
    updateItem() {
    }
}

module.exports = Sulfuras;
