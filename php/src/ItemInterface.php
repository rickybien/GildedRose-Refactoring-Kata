<?php

declare(strict_types=1);

namespace GildedRose;

interface ItemInterface
{
    public function setSellIn(int $sellIn): void;

    public function setQuality(int $Quality): void;

    public function getSellIn(): int;
    
    public function getQuality(): int;

    public function modifySellIn(): void;
    
    public function modifyQuality(): void;
}
