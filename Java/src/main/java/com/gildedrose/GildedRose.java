package com.gildedrose;

import com.gildedrose.updater.*;

class GildedRose {
    Item[] items;

    public GildedRose(Item[] items) {
        this.items = items;
    }

    public void updateQuality(){
        for (Item item : items) {
            ItemUpdater updater = createUpdater(item);
            updater.update();
        }
    }

    /**
     * 依照物品名稱建立對應的 ItemUpdater
     */
    private ItemUpdater createUpdater(Item item) {
        switch (item.name) {
            case "Aged Brie":
                return new AgedBrieUpdater(item);
            case "Backstage passes to a TAFKAL80ETC concert":
                return new BackstagePassUpdater(item);
            case "Sulfuras, Hand of Ragnaros":
                return new SulfurasUpdater(item);
            default:
                return new NormalItemUpdater(item);
        }
    }

    /**
     * 首次重構的 updateQuality
     */
    public void updateQuality2() {
        // 物品類: 一般/ Aged Brie/ Backstage passes/ Sulfuras
        for (Item item : items) {
            switch (item.name) {
                case "Aged Brie":
                    updateAgedBrie(item);
                    break;
                case "Backstage passes to a TAFKAL80ETC concert":
                    updateBackstagePasses(item);
                    break;
                case "Sulfuras, Hand of Ragnaros":
                    updateSulfuras(item);
                    break;
                default:
                    updateNormalItems(item);
                    break;
            }

            decreaseSellIn(item);

            if (item.sellIn < 0) {
                handleExpiredItem(item);
            }
        }

    }

    /**
     * Aged Brie 或 Backstage passes 其品质`Quality`会随着时间推移而提高，但上限為50
     */
    private void increaseQuality(Item item) {
        if (item.quality < 50) {
            item.quality++;
        }
    }

    /**
     * 除了傳奇物品，每天都會降低品質
     */
    private void decreaseSellIn(Item item) {
        if (!"Sulfuras, Hand of Ragnaros".equals(item.name)) {
            item.sellIn--;
        }
    }

    private void handleExpiredItem(Item item) {
        if ("Backstage passes to a TAFKAL80ETC concert".equals(item.name)) {
            item.quality = 0;
        } else if ("Aged Brie".equals(item.name)) {
            increaseQuality(item);
        } else if ("Sulfuras, Hand of Ragnaros".equals(item.name)) {
            // Sulfuras 不會過期, 不會降低品質
        }else{
            decreaseQuality(item);
        }
    }


    private void decreaseQuality(Item item) {
        if (item.quality > 0) {
            item.quality--;
        }
    }

    private void updateSulfuras(Item item) {
        // Sulfuras 不會過期, 不會降低品質
    }

    private void updateBackstagePasses(Item item) {
        increaseQuality(item);
        if (item.sellIn < 11) {
            increaseQuality(item);
        }
        if (item.sellIn < 6) {
            increaseQuality(item);
        }
    }

    private void updateAgedBrie(Item item) {
        increaseQuality(item);
    }

    private void updateNormalItems(Item item) {
        decreaseQuality(item);
    }


}
