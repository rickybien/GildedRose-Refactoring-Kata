import { Item } from "./item"

export class Sulfuras extends Item {
    constructor(name = 'Sulfuras, Hand of Ragnaros') {
        // 传奇物品"Sulfuras"（萨弗拉斯—炎魔拉格纳罗斯之手）永不过期，也不会降低品质`Quality`
        super(name, 0, 80);
    }
    updateItem() {
    }
}
