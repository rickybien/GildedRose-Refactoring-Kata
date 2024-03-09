package gildedrose_test

import (
	"testing"

	"github.com/emilybache/gildedrose-refactoring-kata/gildedrose"
	"github.com/stretchr/testify/suite"
)

type gdSuite struct {
	suite.Suite
}

func TestGildedrose(t *testing.T) {
	suite.Run(t, new(gdSuite))
}

func (t *gdSuite) TestOther() {

	testCase := []struct {
		Desc         string
		numberOfDays int
		items        []*gildedrose.Item
		TestFunc     func()
		ExpSellIn    int
		ExpQuality   int
		ExpErr       error
	}{
		{
			Desc:         "Case 1 Other 正常",
			numberOfDays: 1,
			items: []*gildedrose.Item{
				{"Other", 2, 0},
			},
			ExpSellIn:  1,
			ExpQuality: 0,
			ExpErr:     nil,
		},
		{
			Desc:         "Case 2 Other sellIn 2",
			numberOfDays: 2,
			items: []*gildedrose.Item{
				{"Other", 2, 0},
			},
			ExpSellIn:  0,
			ExpQuality: 0,
			ExpErr:     nil,
		},
		{
			Desc:         "Case 3 Other sellIn 5",
			numberOfDays: 8,
			items: []*gildedrose.Item{
				{"Other", 5, 10},
			},
			ExpSellIn:  -3,
			ExpQuality: 0,
			ExpErr:     nil,
		},
		{
			Desc:         "Case 4 Other sellIn 5 quality extra 2",
			numberOfDays: 15,
			items: []*gildedrose.Item{
				{"Other", 5, 10},
			},
			ExpSellIn:  -10,
			ExpQuality: 0,
			ExpErr:     nil,
		},
		{
			Desc:         "Case 5 Other sellIn 2 quality extra -1",
			numberOfDays: 7,
			items: []*gildedrose.Item{
				{"Other", 2, -1},
			},
			ExpSellIn:  -5,
			ExpQuality: -1,
			ExpErr:     nil,
		},
	}

	for _, c := range testCase {
		for i := 0; i < c.numberOfDays; i++ {
			gildedrose.UpdateQuality(c.items)
		}

		t.Equal(c.ExpSellIn, c.items[0].SellIn, c.Desc)
		t.Equal(c.ExpQuality, c.items[0].Quality, c.Desc)
	}
}

func (t *gdSuite) TestAgedBrie() {

	testCase := []struct {
		Desc         string
		numberOfDays int
		items        []*gildedrose.Item
		TestFunc     func()
		ExpSellIn    int
		ExpQuality   int
		ExpErr       error
	}{
		{
			Desc:         "Case 1 Aged Brie 正常",
			numberOfDays: 1,
			items: []*gildedrose.Item{
				{"Aged Brie", 2, 0},
			},
			ExpSellIn:  1,
			ExpQuality: 1,
			ExpErr:     nil,
		},
		{
			Desc:         "Case 2 Aged Brie sellIn 2",
			numberOfDays: 2,
			items: []*gildedrose.Item{
				{"Aged Brie", 2, 0},
			},
			ExpSellIn:  0,
			ExpQuality: 2,
			ExpErr:     nil,
		},
		{
			Desc:         "Case 3 Aged Brie sellIn 5",
			numberOfDays: 8,
			items: []*gildedrose.Item{
				{"Aged Brie", 5, 10},
			},
			ExpSellIn:  -3,
			ExpQuality: 21,
			ExpErr:     nil,
		},
		{
			Desc:         "Case 4 Aged Brie sellIn 5 quality extra 2",
			numberOfDays: 15,
			items: []*gildedrose.Item{
				{"Aged Brie", 5, 10},
			},
			ExpSellIn:  -10,
			ExpQuality: 35,
			ExpErr:     nil,
		},
		{
			Desc:         "Case 5 Aged Brie sellIn 2 quality extra -1",
			numberOfDays: 7,
			items: []*gildedrose.Item{
				{"Aged Brie", 2, -1},
			},
			ExpSellIn:  -5,
			ExpQuality: 11,
			ExpErr:     nil,
		},
	}

	for _, c := range testCase {
		for i := 0; i < c.numberOfDays; i++ {
			gildedrose.UpdateQuality(c.items)
		}

		t.Equal(c.ExpSellIn, c.items[0].SellIn, c.Desc)
		t.Equal(c.ExpQuality, c.items[0].Quality, c.Desc)
	}
}

func (t *gdSuite) TestBackstagePasses() {
	testCase := []struct {
		Desc         string
		numberOfDays int
		items        []*gildedrose.Item
		TestFunc     func()
		ExpSellIn    int
		ExpQuality   int
		ExpErr       error
	}{
		{
			Desc:         "Case 1 Backstage passes 正常",
			numberOfDays: 1,
			items: []*gildedrose.Item{
				{"Backstage passes to a TAFKAL80ETC concert", 2, 0},
			},
			ExpSellIn:  1,
			ExpQuality: 3,
			ExpErr:     nil,
		},
		{
			Desc:         "Case 2 Backstage passes sellIn 2",
			numberOfDays: 2,
			items: []*gildedrose.Item{
				{"Backstage passes to a TAFKAL80ETC concert", 2, 0},
			},
			ExpSellIn:  0,
			ExpQuality: 6,
			ExpErr:     nil,
		},
		{
			Desc:         "Case 3 Backstage passes sellIn 5",
			numberOfDays: 8,
			items: []*gildedrose.Item{
				{"Backstage passes to a TAFKAL80ETC concert", 5, 10},
			},
			ExpSellIn:  -3,
			ExpQuality: 0,
			ExpErr:     nil,
		},
		{
			Desc:         "Case 4 Backstage passes sellIn 5 quality extra 2",
			numberOfDays: 15,
			items: []*gildedrose.Item{
				{"Backstage passes to a TAFKAL80ETC concert", 5, 10},
			},
			ExpSellIn:  -10,
			ExpQuality: 0,
			ExpErr:     nil,
		},
		{
			Desc:         "Case 5 Backstage passes sellIn 2 quality extra -1",
			numberOfDays: 7,
			items: []*gildedrose.Item{
				{"Backstage passes to a TAFKAL80ETC concert", 2, -1},
			},
			ExpSellIn:  -5,
			ExpQuality: 0,
			ExpErr:     nil,
		},
	}

	for _, c := range testCase {
		for i := 0; i < c.numberOfDays; i++ {
			gildedrose.UpdateQuality(c.items)
		}

		t.Equal(c.ExpSellIn, c.items[0].SellIn, c.Desc)
		t.Equal(c.ExpQuality, c.items[0].Quality, c.Desc)
	}
}

func (t *gdSuite) TestSulfuras() {
	testCase := []struct {
		Desc         string
		numberOfDays int
		items        []*gildedrose.Item
		TestFunc     func()
		ExpSellIn    int
		ExpQuality   int
		ExpErr       error
	}{
		{
			Desc:         "Case 1 Sulfuras 正常",
			numberOfDays: 1,
			items: []*gildedrose.Item{
				{"Sulfuras, Hand of Ragnaros", 2, 0},
			},
			ExpSellIn:  2,
			ExpQuality: 0,
			ExpErr:     nil,
		},
		{
			Desc:         "Case 2 Sulfuras sellIn 2",
			numberOfDays: 2,
			items: []*gildedrose.Item{
				{"Sulfuras, Hand of Ragnaros", 2, 0},
			},
			ExpSellIn:  2,
			ExpQuality: 0,
			ExpErr:     nil,
		},
		{
			Desc:         "Case 3 Sulfuras sellIn 5",
			numberOfDays: 8,
			items: []*gildedrose.Item{
				{"Sulfuras, Hand of Ragnaros", 5, 10},
			},
			ExpSellIn:  5,
			ExpQuality: 10,
			ExpErr:     nil,
		},
		{
			Desc:         "Case 4 Sulfuras sellIn 5 quality extra 2",
			numberOfDays: 15,
			items: []*gildedrose.Item{
				{"Sulfuras, Hand of Ragnaros", 5, 10},
			},
			ExpSellIn:  5,
			ExpQuality: 10,
			ExpErr:     nil,
		},
		{
			Desc:         "Case 5 Sulfuras sellIn 2 quality extra -1",
			numberOfDays: 7,
			items: []*gildedrose.Item{
				{"Sulfuras, Hand of Ragnaros", 2, -1},
			},
			ExpSellIn:  2,
			ExpQuality: -1,
			ExpErr:     nil,
		},
	}

	for _, c := range testCase {
		for i := 0; i < c.numberOfDays; i++ {
			gildedrose.UpdateQuality(c.items)
		}

		t.Equal(c.ExpSellIn, c.items[0].SellIn, c.Desc)
		t.Equal(c.ExpQuality, c.items[0].Quality, c.Desc)
	}
}
