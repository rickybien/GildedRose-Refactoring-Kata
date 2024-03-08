module.exports = class Backstage {
    constructor(item) {
        this.item = item;
    }

    update() {
        this.item.sellIn -= 1;

        const {sellIn, quality} = this.item;

        if (sellIn < 10 && sellIn > 5) {
            this.item.quality = quality + 2;
        }
        else if (sellIn >= 0 && sellIn <= 5) {
            this.item.quality = quality + 3;
        }
        else if (sellIn > 0) {
            this.item.quality = quality + 1;
        } else {
            this.item.quality = 0;
        }

        if (this.item.quality > 50) {
            this.item.quality = 50;
        }
    }
}