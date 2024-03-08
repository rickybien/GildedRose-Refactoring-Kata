<?php
namespace GildedRose;

final class ItemSulfuras
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
    }
    
    public function modifyQuality(){
    }
}
