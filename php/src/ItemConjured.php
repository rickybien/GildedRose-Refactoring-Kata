<?php
declare(strict_types=1);

namespace GildedRose;

final class ItemConjured implements ItemInterface
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
        $this->sellIn -= 1;
        if($this->sellIn < 0){
            $this->quality -= 2;
        }
    }
    
    public function modifyQuality(): void
    {
        if($this->quality > 0){
            $this->quality -= 2;
        }
    }
}
