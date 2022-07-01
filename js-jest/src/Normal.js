module.exports = class Normal {
    constructor(item) {
        this.item = item;
    }

    update() {
        let {sellIn, quality} = this.item;

        this.item.sellIn = sellIn - 1;

        if (quality + 1 > 50 || quality - 1 < 0) {
            return;
        }

        if (this.item.sellIn < 0) {
            this.item.quality = quality - 2;
        } else {
            this.item.quality = quality - 1;
        }
    }
}