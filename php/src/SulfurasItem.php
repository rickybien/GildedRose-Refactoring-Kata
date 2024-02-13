<?php

namespace GildedRose;

readonly class SulfurasItem implements QualityInterface
{
    public function __construct(private Item $item)
    {
    }

    public function updateQuality(): void
    {
    }
}
