<?php

declare(strict_types=1);

namespace GildedRose;

class GildedRose
{
    /**
     * @var Item[]
     */
    private $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function updateQuality()
    {
        foreach ($this->items as $item) {
            if ($item->name == 'Sulfuras, Hand of Ragnaros') { //"Sulfuras" is a legendary item and as such its Quality is 80 and it never alters.
                continue;
            }
            if ($item->name != 'Aged Brie' && $item->name != 'Backstage passes to a TAFKAL80ETC concert') { //normal items quality degrade
                $item->quality --;
                if($item->name == 'Conjured') { //'Conjured' degrades twice as fast as normal items
                    $item->quality --;
                }
            } else {
                if ($item->quality < 50) {
                    $item->quality++;
                    if ($item->name == 'Backstage passes to a TAFKAL80ETC concert') {
                        if ($item->sellIn < 11) {
                            $item->quality++;
                        }
                        if ($item->sellIn < 6) {
                            $item->quality++;
                        }
                    }
                }
            }
            $item->sellIn --;
            if ($item->sellIn < 0) {
                if ($item->name != 'Aged Brie') {
                    if ($item->name != 'Backstage passes to a TAFKAL80ETC concert') {
                        $item->quality --;
                        if($item->name == 'Conjured') { // 'Conjured' degrades twice as fast as normal items
                            $item->quality --;
                        }
                    } else {
                        $item->quality = 0;
                    }
                } else {
                    $item->quality ++;
                }
            }
            // limit the quality value to the range [0, 50],
            $item->quality = $item->quality > 0 ? $item->quality : 0;
            $item->quality = $item->quality < 0 ? $item->quality : 50;
        }
    }
}
