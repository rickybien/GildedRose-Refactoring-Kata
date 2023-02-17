<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    /**
     * @var Item[]
     */
    private $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

	public function updateQuality(): void
	{
		foreach ($this->items as &$item) {
			if (!$item->name || !$item->sellIn || !$item->quality) {
				continue;
			}
			// 時間老人工作中
			$item->sellIn = $item->sellIn - 1;
			$item = $this->process($item);
		}
	}

	private function process(object $item): object
	{
		switch ($item->name) {
			// 奶酪
			case 'Aged Brie':
				// 時間老人會讓他變得更好吃，但再好吃也有天花板
				$plusNumber = $item->sellIn < 0 ? 2 : 1;
				$item->quality = $this->plusQuality($item->quality, $plusNumber);
				break;
			// 通行證
			case 'Backstage passes to a TAFKAL80ETC concert':
				if ($item->sellIn > 0) {
					// 正常 + 1
					$plusNumber = 1;
					// 5到10天 + 2
					if ($item->sellIn > 5 && $item->sellIn < 11) {
						$plusNumber = 2;
						// 5天內 + 3
					} elseif ($item->sellIn <= 5) {
						$plusNumber = 3;
					}
					$item->quality = $this->plusQuality($item->quality, $plusNumber);
				} else {
					// 過期歸0
					$item->quality = 0;
				}
				break;
			// 炎魔的手手，不會壞掉，去去時間老人走
			case 'Sulfuras, Hand of Ragnaros':
				$item->quality = 80;
				break;
			// 一般物品
			default:
				// 過期會壞更快
				$minusNumber = $item->sellIn > 0 ? 1 : 2;
				$item->quality = $this->minusQuality($item->quality, $minusNumber);
				break;
		}
		return $item;
	}

	private function plusQuality(int $quality, int $plusNumber): int
	{
		return $quality + $plusNumber < 50 ? $quality + $plusNumber : 50;
	}

	private function minusQuality(int $quality, int $minusNumber): int
	{
		return $quality - $minusNumber > 0 ? $quality - $minusNumber : 0;
	}
}
