<?php

namespace GildedRose;

interface CalculateInterface
{
    public const BASE_SELL_IN = 1;
    public const BASE_QUALITY = 1;
    public const BASE_EXPIRED_QUALITY_MULTIPLE = 2;

    /**
     * 計算銷售期限
     *
     * @param int $sellIn
     * @return int
     */
    public function calculateSellIn(int $sellIn): int;

    /**
     * 計算品質
     *
     * @param int $sellIn
     * @param int $quality
     * @return int
     */
    public function calculateQuality(int $sellIn, int $quality): int;
}