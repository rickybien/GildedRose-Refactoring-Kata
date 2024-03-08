module.exports = class AgedBrie {
    constructor(item) {
        this.item = item;
    }

    update() {
        this.item.sellIn -= 1;

        const {quality} = this.item;

        if (this.item.sellIn < 0) {
            this.item.quality = quality + 2 > 50 ? 50 : quality + 2;
        } else {
            this.item.quality = quality + 1 > 50 ? 50 : quality + 1;
        }
    }
}