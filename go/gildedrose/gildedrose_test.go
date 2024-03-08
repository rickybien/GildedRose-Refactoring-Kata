package gildedrose_test

import (
	"testing"

	"github.com/emilybache/gildedrose-refactoring-kata/gildedrose"
	"github.com/stretchr/testify/assert"
)

func TestUpdatesNormalItemsBeforeSellDate(t *testing.T) {
	var items = []*gildedrose.Item{
		{"normal", 5, 10},
	}

	gildedrose.UpdateQuality(items)

	assert.Equal(t, items[0].SellIn, 4)
	assert.Equal(t, items[0].Quality, 9)
}

func TestUpdatesNormalItemsOnSellDate(t *testing.T) {
	var items = []*gildedrose.Item{
		{"normal", 0, 10},
	}

	gildedrose.UpdateQuality(items)

	assert.Equal(t, items[0].SellIn, -1)
	assert.Equal(t, items[0].Quality, 8)
}

func TestUpdatesNormalItemsAfterSellDate(t *testing.T) {
	var items = []*gildedrose.Item{
		{"normal", -5, 10},
	}

	gildedrose.UpdateQuality(items)

	assert.Equal(t, items[0].SellIn, -6)
	assert.Equal(t, items[0].Quality, 8)
}

func TestUpdatesNormalItemsWithAQualityOf0(t *testing.T) {
	var items = []*gildedrose.Item{
		{"normal", 5, 0},
	}

	gildedrose.UpdateQuality(items)

	assert.Equal(t, items[0].SellIn, 4)
	assert.Equal(t, items[0].Quality, 0)
}

// -----------------
// Brie item
// -----------------
func TestUpdatesBrieItemsBeforeSellDate(t *testing.T) {
	var items = []*gildedrose.Item{
		{"Aged Brie", 5, 10},
	}

	gildedrose.UpdateQuality(items)

	assert.Equal(t, items[0].SellIn, 4)
	assert.Equal(t, items[0].Quality, 11)
}

func TestUpdatesBrieItemsBeforeSellDateWithMaximumQuality(t *testing.T) {
	var items = []*gildedrose.Item{
		{"Aged Brie", 5, 50},
	}

	gildedrose.UpdateQuality(items)

	assert.Equal(t, items[0].SellIn, 4)
	assert.Equal(t, items[0].Quality, 50)
}

func TestUpdatesBrieItemsOnSellDate(t *testing.T) {
	var items = []*gildedrose.Item{
		{"Aged Brie", 0, 10},
	}

	gildedrose.UpdateQuality(items)

	assert.Equal(t, items[0].SellIn, -1)
	assert.Equal(t, items[0].Quality, 12)
}

func TestUpdatesBrieItemsOnSellDateNearMaximumQuality(t *testing.T) {
	var items = []*gildedrose.Item{
		{"Aged Brie", 0, 49},
	}

	gildedrose.UpdateQuality(items)

	assert.Equal(t, items[0].SellIn, -1)
	assert.Equal(t, items[0].Quality, 50)
}

func TestUpdatesBrieItemsOnSellDateWithMaximumQuality(t *testing.T) {
	var items = []*gildedrose.Item{
		{"Aged Brie", 0, 50},
	}

	gildedrose.UpdateQuality(items)

	assert.Equal(t, items[0].SellIn, -1)
	assert.Equal(t, items[0].Quality, 50)
}

func TestUpdatesBrieItemsAfterSellDate(t *testing.T) {
	var items = []*gildedrose.Item{
		{"Aged Brie", -10, 10},
	}

	gildedrose.UpdateQuality(items)

	assert.Equal(t, items[0].SellIn, -11)
	assert.Equal(t, items[0].Quality, 12)
}

func TestUpdatesBrieItemsAfterSellDateWithMaximumQuality(t *testing.T) {
	var items = []*gildedrose.Item{
		{"Aged Brie", -10, 50},
	}

	gildedrose.UpdateQuality(items)

	assert.Equal(t, items[0].SellIn, -11)
	assert.Equal(t, items[0].Quality, 50)
}

// -----------------
// Sulfuras item
// -----------------
func TestUpdatesSulfurasItemsBeforeSellDate(t *testing.T) {
	var items = []*gildedrose.Item{
		{"Sulfuras, Hand of Ragnaros", 5, 10},
	}

	gildedrose.UpdateQuality(items)

	assert.Equal(t, items[0].SellIn, 5)
	assert.Equal(t, items[0].Quality, 10)
}

func TestUpdatesSulfurasItemsOnSellDate(t *testing.T) {
	var items = []*gildedrose.Item{
		{"Sulfuras, Hand of Ragnaros", 0, 10},
	}

	gildedrose.UpdateQuality(items)

	assert.Equal(t, items[0].SellIn, 0)
	assert.Equal(t, items[0].Quality, 10)
}

func TestUpdatesSulfurasItemsAfterSellDate(t *testing.T) {
	var items = []*gildedrose.Item{
		{"Sulfuras, Hand of Ragnaros", -1, 10},
	}

	gildedrose.UpdateQuality(items)

	assert.Equal(t, items[0].SellIn, -1)
	assert.Equal(t, items[0].Quality, 10)
}

// -----------------
// Backstage Pass
// -----------------
func TestUpdatesBackstagePassItemsLongBeforeSellDate(t *testing.T) {
	var items = []*gildedrose.Item{
		{"Backstage passes to a TAFKAL80ETC concert", 11, 10},
	}

	gildedrose.UpdateQuality(items)

	assert.Equal(t, items[0].SellIn, 10)
	assert.Equal(t, items[0].Quality, 11)
}

func TestUpdatesBackstagePassItemsCloseToBeforeSellDate(t *testing.T) {
	var items = []*gildedrose.Item{
		{"Backstage passes to a TAFKAL80ETC concert", 10, 10},
	}

	gildedrose.UpdateQuality(items)

	assert.Equal(t, items[0].SellIn, 9)
	assert.Equal(t, items[0].Quality, 12)
}

func TestUpdatesBackstagePassItemsCloseToSellDateAtMaximumQuality(t *testing.T) {
	var items = []*gildedrose.Item{
		{"Backstage passes to a TAFKAL80ETC concert", 10, 50},
	}

	gildedrose.UpdateQuality(items)

	assert.Equal(t, items[0].SellIn, 9)
	assert.Equal(t, items[0].Quality, 50)
}

func TestUpdatesBackstagePassItemsVeryCloseToSellDate(t *testing.T) {
	var items = []*gildedrose.Item{
		{"Backstage passes to a TAFKAL80ETC concert", 5, 10},
	}

	gildedrose.UpdateQuality(items)

	assert.Equal(t, items[0].SellIn, 4)
	assert.Equal(t, items[0].Quality, 13)
}

func TestUpdatesBackstagePassItemsVeryCloseToSellDateAtMaximumQuality(t *testing.T) {
	var items = []*gildedrose.Item{
		{"Backstage passes to a TAFKAL80ETC concert", 5, 50},
	}

	gildedrose.UpdateQuality(items)

	assert.Equal(t, items[0].SellIn, 4)
	assert.Equal(t, items[0].Quality, 50)
}

func TestUpdatesBackstagePassItemsWithOneDayLeftToSellDateAtMaximumQuality(t *testing.T) {
	var items = []*gildedrose.Item{
		{"Backstage passes to a TAFKAL80ETC concert", 1, 50},
	}

	gildedrose.UpdateQuality(items)

	assert.Equal(t, items[0].SellIn, 0)
	assert.Equal(t, items[0].Quality, 50)
}

func TestUpdatesBackstagePassItemsOnSellDate(t *testing.T) {
	var items = []*gildedrose.Item{
		{"Backstage passes to a TAFKAL80ETC concert", 0, 10},
	}

	gildedrose.UpdateQuality(items)

	assert.Equal(t, items[0].SellIn, -1)
	assert.Equal(t, items[0].Quality, 0)
}

func TestUpdatesBackstagePassItemsAfterSellDate(t *testing.T) {
	var items = []*gildedrose.Item{
		{"Backstage passes to a TAFKAL80ETC concert", -1, 10},
	}

	gildedrose.UpdateQuality(items)

	assert.Equal(t, items[0].SellIn, -2)
	assert.Equal(t, items[0].Quality, 0)
}

// -----------------
// Conjured
// -----------------
func TestUpdatesConjuredItemsBeforeSellDate(t *testing.T) {
	var items = []*gildedrose.Item{
		{"Conjured", 5, 10},
	}

	gildedrose.UpdateQuality(items)

	assert.Equal(t, items[0].SellIn, 4)
	assert.Equal(t, items[0].Quality, 8)
}

func TestUpdatesConjuredItemsOnSellDate(t *testing.T) {
	var items = []*gildedrose.Item{
		{"Conjured", 0, 10},
	}

	gildedrose.UpdateQuality(items)

	assert.Equal(t, items[0].SellIn, -1)
	assert.Equal(t, items[0].Quality, 6)
}

func TestUpdatesConjuredItemsAfterSellDate(t *testing.T) {
	var items = []*gildedrose.Item{
		{"Conjured", -5, 10},
	}

	gildedrose.UpdateQuality(items)

	assert.Equal(t, items[0].SellIn, -6)
	assert.Equal(t, items[0].Quality, 6)
}

func TestUpdatesConjuredItemsWithAQualityOf0(t *testing.T) {
	var items = []*gildedrose.Item{
		{"Conjured", 5, 0},
	}

	gildedrose.UpdateQuality(items)

	assert.Equal(t, items[0].SellIn, 4)
	assert.Equal(t, items[0].Quality, 0)
}
