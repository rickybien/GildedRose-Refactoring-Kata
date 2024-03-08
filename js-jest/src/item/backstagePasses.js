import { Item } from "./item"

export class BackstagePasses extends Item {
    constructor(sellIn, quality) {
        super('Backstage passes to a TAFKAL80ETC concert', sellIn, quality);
    }

    // "Backstage passes"（后台通行证）与"Aged Brie"（陈年布利奶酪）类似，其品质`Quality`会随着时间推移而提高；
    // 当还剩10天或更少的时候，品质`Quality`每天提高2；
    // 当还剩5天或更少的时候，品质`Quality`每天提高3；
    // 但一旦过期，品质就会降为0
    updateQuality() {
        if (this.sellIn < 0) return 0;
        if (this.sellIn <= 5) return this.quality + 3;
        if (this.sellIn <= 10) return this.quality + 2;
        return this.quality + 1;
    }

    update() {
        this.sellIn -= 1;
        this.quality = Math.min(50, this.updateQuality());
    }
}
