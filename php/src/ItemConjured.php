<?php
namespace GildedRose;

final class ItemConjured
{
    private $sellIn;
    private $quality;

    public function __construct()
    {
    }

    public function setSellIn($sellIn){
        $this->sellIn = $sellIn;
    }

    public function setQuality($quality){
        $this->quality = $quality;
    }

    public function getSellIn(){
        return $this->sellIn;
    }
    
    public function getQuality(){
        return $this->quality;
    }

    public function modifySellIn(){
        $this->sellIn -= 1;
        if($this->sellIn < 0){
            $this->quality -= 2;
        }
    }
    
    public function modifyQuality(){
        if($this->quality > 0){
            $this->quality -= 2;
        }
    }
}
