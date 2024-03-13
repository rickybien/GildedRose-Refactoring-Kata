package com.gildedrose;

import com.gildedrose.Item;
import com.gildedrose.constant.QualityConstant;

import static com.gildedrose.utils.GildedRoseUtils.calculateQuality;

/**
 * 定義有特殊規則的 item enum，其他預設為 NORMAL
 */
public enum ItemEnum {
    AGED_BRIE("Aged Brie") {
        @Override
        public void updateQuality(Item item) {
            int amount = 1;
            amount = item.sellIn > 0 ? amount : amount * 2;
            item.quality = calculateQuality(item.quality, amount);
        }
    }, SULFURAS("Sulfuras, Hand of Ragnaros") {
        @Override
        public void updateQuality(Item item) {
            // ignore
        }

        @Override
        public void updateSellIn(Item item) {
            // ignore
        }
    }, BACKSTAGE("Backstage passes to a TAFKAL80ETC concert") {
        @Override
        public void updateQuality(Item item) {
            if (item.sellIn > 10) {
                item.quality = calculateQuality(item.quality, 1);
            } else if (5 < item.sellIn) {
                item.quality = calculateQuality(item.quality, 2);
            } else if (0 < item.sellIn) {
                item.quality = calculateQuality(item.quality, 3);
            } else {
                item.quality = 0;
            }
        }
    }, CONJURED("Conjured Mana Cake") {
        @Override
        public void updateQuality(Item item) {
            int amount = QualityConstant.NORMAL_ITEM_QUALITY_DEGRADE_AMOUNT * 2;
            amount = item.sellIn > 0 ? amount : amount * 2;
            item.quality = calculateQuality(item.quality, amount);
        }
    }, NORMAL("") {
        @Override
        public void updateQuality(Item item) {
            int amount = QualityConstant.NORMAL_ITEM_QUALITY_DEGRADE_AMOUNT;
            amount = item.sellIn > 0 ? amount : amount * 2;
            item.quality = calculateQuality(item.quality, amount);
        }
    };

    private final String value;

    public String getValue() {
        return this.value;
    }

    ItemEnum(String value) {
        this.value = value;
    }

    public static ItemEnum getItemEnum(String itemName) {
        for (ItemEnum itemEnum : ItemEnum.values()) {
            if (itemEnum.getValue().equals(itemName)) {
                return itemEnum;
            }
        }
        return ItemEnum.NORMAL;
    }

    public abstract void updateQuality(Item item);

    public void updateSellIn(Item item) {
        item.sellIn--;
    }

    public void update(Item item) {
        updateQuality(item);
        updateSellIn(item);
    }
}
