<?php

namespace GildedRose\Quality;

class SulfurasService extends QualityHandler
{
    protected bool $isChangeSellIn = false;
    protected const MIN_QUALITY = 80;
    protected const MAX_QUALITY = 80;

    public function updateQuality(): void
    {
    }
}