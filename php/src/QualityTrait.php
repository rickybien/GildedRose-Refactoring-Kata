<?php

namespace GildedRose;

trait QualityTrait
{
    /**
     * 取得異動品質數
     *
     * @param int $sellIn
     * @return int
     */
    public function getModifyQuality(int $sellIn): int
    {
        if ($sellIn < 0) {
            return CalculateInterface::BASE_QUALITY * CalculateInterface::BASE_EXPIRED_QUALITY_MULTIPLE;
        }

        return CalculateInterface::BASE_QUALITY;
    }

    /**
     * 計算品質上下限
     *
     * @param int $quality
     * @return int
     */
    public function qualityLimit(int $quality)
    {
        if ($quality > 50) {
            return 50;
        }
        if ($quality < 0) {
            return 0;
        }

        return $quality;
    }
}