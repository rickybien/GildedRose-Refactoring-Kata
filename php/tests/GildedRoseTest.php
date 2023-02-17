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
	    $gildedRose = new GildedRose([
		    new Item('box', 0, 0),
		    new Item('sword', 10, 30),
		    new Item('shoes', 0, 10),
	    ]);
	    $items = $gildedRose->updateQuality();
		foreach ($excepted as $index => $exceptedItem) {
			$this->testPattern($exceptedItem, $items[$index]);
		}
    }
	// 測試奶酪
	public function testAgedBrie(): void
	{
		$name = 'Aged Brie';
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
		$gildedRose = new GildedRose([
			new Item($name, 0, 50),
			new Item($name, 0, 0),
			new Item($name, 10, 25),
		]);
		$items = $gildedRose->updateQuality();
		foreach ($excepted as $index => $exceptedItem) {
			$this->testPattern($exceptedItem, $items[$index]);
		}
	}

	// 測試通行證邏輯
	public function testBackstagePasses(): void
	{
		$name = 'Backstage passes to a TAFKAL80ETC concert';
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
		$gildedRose = new GildedRose([
			new Item($name, 0, 30),
			new Item($name, 20, 30),
			new Item($name, 10, 30),
			new Item($name, 5, 30),
			new Item($name, 20, 50),
			new Item($name, 10, 49),
			new Item($name, 5, 48),
		]);
		$items = $gildedRose->updateQuality();
		foreach ($excepted as $index => $exceptedItem) {
			$this->testPattern($exceptedItem, $items[$index]);
		}
	}
	// 測試炎魔手手邏輯
	public function testSulfuras(): void
	{
		$name = 'Sulfuras, Hand of Ragnaros';
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
		$gildedRose = new GildedRose([
			new Item($name, 0, 0),
			new Item($name, 10, 10),
			new Item($name, 20, 1000),
		]);
		$items = $gildedRose->updateQuality();
		foreach ($excepted as $index => $exceptedItem) {
			$this->testPattern($exceptedItem, $items[$index]);
		}
	}
	// 測試召喚物品邏輯
	public function testConjured(): void
	{
		$name = 'Conjured';
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
		$gildedRose = new GildedRose([
			new Item($name, 0, 0),
			new Item($name, 0, 10),
			new Item($name, 10, 10),
		]);
		$items = $gildedRose->updateQuality();
		foreach ($excepted as $index => $exceptedItem) {
			$this->testPattern($exceptedItem, $items[$index]);
		}
	}


	// 測試髒資料
	public function testDirtyData(): void
	{
		$excepted = [
			[
				'name' => 'box',
				'sellIn' => -1,
				'quality' => 0,
			],
			[
				'error' => true,
				'message' => 'ER01: item type is not object',
			],
			[
				'error' => true,
				'message' => 'ER02: item name is undefined',
			],
			[
				'error' => true,
				'message' => 'ER03: item sellIn is undefined',
			],
			[
				'error' => true,
				'message' => 'ER04: item quality is undefined',
			],
		];
		$gildedRose = new GildedRose([
			new Item('box', 0, 0),
			[],
			(object) [
				'sellIn' => -1,
				'quality' => 0,
			],
			(object) [
				'name' => 'box',
				'quality' => 0,
			],
			(object) [
				'name' => 'box',
				'sellIn' => -1,
			],
		]);
		$items = $gildedRose->updateQuality();
		foreach ($excepted as $index => $exceptedItem) {
			$this->testPattern($exceptedItem, $items[$index]);
		}
	}

	private function testPattern(array $exceptedItem, $item): void
	{
		if (isset($exceptedItem['error'])) {
			$this->assertSame($exceptedItem, $item);
		} else {
			$this->assertSame($exceptedItem['name'], $item->name);
			$this->assertSame($exceptedItem['sellIn'], $item->sellIn);
			$this->assertSame($exceptedItem['quality'], $item->quality);
		}
	}
}
