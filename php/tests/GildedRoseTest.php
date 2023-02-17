<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
	// 測試一般物品
	public function testNormalProduct(): void
	{
		$items = [
			new Item('box', 0, 0),
			new Item('sword', 10, 30),
			new Item('shoes', 0, 10),
		];

		$excepted = [
			[
				'name' => 'box',
				'sellIn' => -1,
				'quality' => 0,
			],
			[
				'name' => 'sword',
				'sellIn' => 9,
				'quality' => 29,
			],
			[
				'name' => 'shoes',
				'sellIn' => -1,
				'quality' => 8,
			],
		];
		$gildedRose = new GildedRose($items);
		$gildedRose->updateQuality();
		foreach ($excepted as $index => $exceptedItem) {
			$this->assertSame($exceptedItem['name'], $items[$index]->name);
			$this->assertSame($exceptedItem['sellIn'], $items[$index]->sellIn);
			$this->assertSame($exceptedItem['quality'], $items[$index]->quality);
		}
	}

	// 測試奶酪
	public function testAgedBrie(): void
	{
		$items = [
			new Item('Aged Brie', 0, 50),
			new Item('Aged Brie', 0, 0),
			new Item('Aged Brie', 10, 25),
		];

		$excepted = [
			[
				'name' => 'Aged Brie',
				'sellIn' => -1,
				'quality' => 50,
			],
			[
				'name' => 'Aged Brie',
				'sellIn' => -1,
				'quality' => 2,
			],
			[
				'name' => 'Aged Brie',
				'sellIn' => 9,
				'quality' => 26,
			],
		];
		$gildedRose = new GildedRose($items);
		$gildedRose->updateQuality();
		foreach ($excepted as $index => $exceptedItem) {
			$this->assertSame($exceptedItem['name'], $items[$index]->name);
			$this->assertSame($exceptedItem['sellIn'], $items[$index]->sellIn);
			$this->assertSame($exceptedItem['quality'], $items[$index]->quality);
		}
	}
}
