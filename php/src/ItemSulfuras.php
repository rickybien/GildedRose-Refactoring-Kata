<?php
declare(strict_types=1);

namespace GildedRose;

class ItemSulfuras implements ItemInterface
{
    private $sellIn;
    private $quality;

    public function __construct()
    {
    }

    public function setSellIn(int $sellIn): void
    {
        $this->sellIn = $sellIn;
    }

    public function setQuality(int $quality): void
    {
        $this->quality = $quality;
    }

    public function getSellIn(): int
    {
        return $this->sellIn;
    }
    
    public function getQuality(): int
    {
        return $this->quality;
    }

    public function modifySellIn(): void
    {
    }
    
    public function modifyQuality(): void
    {
    }
}
