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
		$name = 'Aged Brie';
		$items = [
			new Item($name, 0, 50),
			new Item($name, 0, 0),
			new Item($name, 10, 25),
		];

		$excepted = [
			[
				'name' => $name,
				'sellIn' => -1,
				'quality' => 50,
			],
			[
				'name' => $name,
				'sellIn' => -1,
				'quality' => 2,
			],
			[
				'name' => $name,
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

	// 測試通行證邏輯
	public function testBackstagePasses(): void
	{
		$name = 'Backstage passes to a TAFKAL80ETC concert';
		$items = [
			new Item($name, 0, 30),
			new Item($name, 20, 30),
			new Item($name, 10, 30),
			new Item($name, 5, 30),
			new Item($name, 20, 50),
			new Item($name, 10, 49),
			new Item($name, 5, 48),
		];

		$excepted = [
			[
				'name' => $name,
				'sellIn' => -1,
				'quality' => 0,
			],
			[
				'name' => $name,
				'sellIn' => 19,
				'quality' => 31,
			],
			[
				'name' => $name,
				'sellIn' => 9,
				'quality' => 32,
			],
			[
				'name' => $name,
				'sellIn' => 4,
				'quality' => 33,
			],
			[
				'name' => $name,
				'sellIn' => 19,
				'quality' => 50,
			],
			[
				'name' => $name,
				'sellIn' => 9,
				'quality' => 50,
			],
			[
				'name' => $name,
				'sellIn' => 4,
				'quality' => 50,
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

	// 測試炎魔手手邏輯
	public function testSulfuras(): void
	{
		$name = 'Sulfuras, Hand of Ragnaros';
		$items = [
			new Item($name, 0, 0),
			new Item($name, 10, 10),
			new Item($name, 20, 1000),
		];

		$excepted = [
			[
				'name' => $name,
				'sellIn' => -1,
				'quality' => 80,
			],
			[
				'name' => $name,
				'sellIn' => 9,
				'quality' => 80,
			],
			[
				'name' => $name,
				'sellIn' => 19,
				'quality' => 80,
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

	// 測試召喚物品邏輯
	public function testConjured(): void
	{
		$name = 'Conjured';
		$items = [
			new Item($name, 0, 0),
			new Item($name, 0, 10),
			new Item($name, 10, 10),
		];

		$excepted = [
			[
				'name' => $name,
				'sellIn' => -1,
				'quality' => 0,
			],
			[
				'name' => $name,
				'sellIn' => -1,
				'quality' => 6,
			],
			[
				'name' => $name,
				'sellIn' => 9,
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
}
