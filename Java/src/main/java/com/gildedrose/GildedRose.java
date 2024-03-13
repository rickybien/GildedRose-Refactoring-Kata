package com.gildedrose;

class GildedRose {
    Item[] items;

    public GildedRose(Item[] items) {
        this.items = items;
    }

    public void updateQuality() {
        for (Item item : items) {
            ItemEnum itemEnum = ItemEnum.getItemEnum(item.name);
            itemEnum.update(item);
        }
    }
}
