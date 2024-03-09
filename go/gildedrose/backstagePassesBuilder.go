package gildedrose

type BackstagePassesBuilder struct {
	SellIn  int
	Quality int
}

func newBackstagePassesBuilder() *BackstagePassesBuilder {
	return &BackstagePassesBuilder{}
}

func (b *BackstagePassesBuilder) calculSellIn(item *Item) {
	b.SellIn = item.SellIn - 1
}

func (b *BackstagePassesBuilder) calculQuality(item *Item) {
	b.Quality = item.Quality

	var sellInOrigin int

	sellInOrigin = sellInOrigin + 1

	if b.Quality < 50 {
		b.Quality = b.Quality + 1
		if sellInOrigin < 11 {
			b.Quality = b.Quality + 1
		}
		if sellInOrigin < 6 {
			b.Quality = b.Quality + 1
		}
	}

	if b.SellIn < 0 {
		b.Quality = b.Quality - b.Quality
	}
}

func (b *BackstagePassesBuilder) getCalculItem() CulcalItem {
	return CulcalItem{
		SellIn:  b.SellIn,
		Quality: b.Quality,
	}
}
