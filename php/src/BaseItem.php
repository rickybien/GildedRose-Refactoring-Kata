<?php

namespace GildedRose;

readonly class BaseItem
{
    public function __construct(protected Item $item)
    {
    }

    public function updateQuality(): void
    {
    }
}
