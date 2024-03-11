<?php
declare(strict_types=1);

namespace GildedRose;

final class ItemBackstagePasses implements ItemInterface
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
            $this->quality = $this->quality - $this->quality;
        }
    }
    
    public function modifyQuality(): void
    {
        if($this->quality < 50){
            $this->quality += 1;
            if($this->sellIn < 11){
                $this->quality += 1;
            }
            if($this->sellIn < 6){
                $this->quality += 1;
            }
        }
    }
}