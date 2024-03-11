package gildedrose

type OtherBuilder struct {
	SellIn  int
	Quality int
}

func newOtherBuilder() *OtherBuilder {
	return &OtherBuilder{}
}

func (b *OtherBuilder) calculSellIn(item *Item) {
	b.SellIn = item.SellIn - 1
}

func (b *OtherBuilder) calculQuality(item *Item) {
	b.Quality = item.Quality

	if b.Quality > 0 {
		b.Quality = b.Quality - 1
	}
	if b.SellIn < 0 && b.Quality > 0 {
		b.Quality = b.Quality - 1
	}

	if b.Quality >= 50 {
		b.Quality = 50
		return
	}
	if b.Quality <= 0 {
		b.Quality = 0
		return
	}
}

func (b *OtherBuilder) getCalculItem() CulcalItem {
	return CulcalItem{
		SellIn:  b.SellIn,
		Quality: b.Quality,
	}
}
