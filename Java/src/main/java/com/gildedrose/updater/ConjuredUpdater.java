package com.gildedrose.updater;

import com.gildedrose.Item;

public class ConjuredUpdater  extends ItemUpdater {

    public ConjuredUpdater(Item item) {
        super(item);
    }
    @Override
    public void update() {
        decreaseQualityTwice(item);
        item.sellIn--;
        if (item.sellIn < 0) {
            decreaseQualityTwice(item);
        }
    }
    private void decreaseQualityTwice(Item item) {
        if (item.quality > 0) {
            item.quality--;
        }
        if (item.quality > 0) {
            item.quality--;
        }
    }
}
