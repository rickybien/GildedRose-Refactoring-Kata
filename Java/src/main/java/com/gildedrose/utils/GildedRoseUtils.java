package com.gildedrose.utils;

import com.gildedrose.constant.QualityConstant;

public class GildedRoseUtils {

    public static int calculateQuality(int originQuality, int amount) {
        int quality = originQuality + amount;
        if (quality > QualityConstant.MAXIMUM) {
            return QualityConstant.MAXIMUM;
        }
        if (quality < QualityConstant.MINIMUM) {
            return QualityConstant.MINIMUM;
        }
        return quality;
    }
}
