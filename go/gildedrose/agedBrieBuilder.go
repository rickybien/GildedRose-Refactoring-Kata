package gildedrose

type AgedBrieBuilder struct {
	SellIn  int
	Quality int
}

func newAgedBrieBuilder() *AgedBrieBuilder {
	return &AgedBrieBuilder{}
}

func (b *AgedBrieBuilder) calculSellIn(item *Item) {
	b.SellIn = item.SellIn - 1
}

func (b *AgedBrieBuilder) calculQuality(item *Item) {
	b.Quality = item.Quality

	if b.Quality < 50 {
		b.Quality = b.Quality + 1
	}

	if b.SellIn < 0 {
		if b.Quality < 50 {
			b.Quality = b.Quality + 1
		}
	}
}

func (b *AgedBrieBuilder) getCalculItem() CulcalItem {
	return CulcalItem{
		SellIn:  b.SellIn,
		Quality: b.Quality,
	}
}
