package com.gildedrose.factory;

import com.gildedrose.Item;

public class Factory {
    private ItemEnum itemEnum;

    public void setItemEnum(ItemEnum itemEnum) {
        this.itemEnum = itemEnum;
    }

    public void updateItem(Item item) {
        itemEnum.updateQuality(item);
        itemEnum.updateSellIn(item);
    }
}
