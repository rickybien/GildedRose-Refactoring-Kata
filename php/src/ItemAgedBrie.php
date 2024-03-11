<?php
declare(strict_types=1);

namespace GildedRose;

final class ItemAgedBrie implements ItemInterface
{
    private $sellIn;
    private $quality;

    public function __construct()
    {
    }

    public function setSellIn($sellIn): void
    {
        $this->sellIn = $sellIn;
    }

    public function setQuality($quality): void
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
        $this->sellIn -= 1;
        if ($this->quality < 50){
            if ($this->sellIn < 0){
                $this->quality += 1;
            }
        }
    }
    
    public function modifyQuality(): void
    {
        if ($this->quality < 50){
            $this->quality += 1;
        }
    }
}