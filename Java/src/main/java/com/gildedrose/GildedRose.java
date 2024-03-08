package com.gildedrose;

import com.gildedrose.factory.Factory;
import com.gildedrose.factory.ItemEnum;

class GildedRose {
    Item[] items;

    public GildedRose(Item[] items) {
        this.items = items;
    }

    public void updateQuality() {
        Factory factory = new Factory();
        for (Item item : items) {
            factory.setItemEnum(converItemNameToItemEnum(item.name));
            factory.updateItem(item);
        }
    }

    private ItemEnum converItemNameToItemEnum(String itemName) {
        for (ItemEnum itemEnum : ItemEnum.values()) {
            if (itemEnum.getValue().equals(itemName)) {
                return itemEnum;
            }
        }
        return ItemEnum.NORMAL;
    }
}
