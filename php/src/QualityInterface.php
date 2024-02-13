<?php

namespace GildedRose;

interface QualityInterface
{
    public function __construct(Item $item);

    public function updateQuality(): void;
}
