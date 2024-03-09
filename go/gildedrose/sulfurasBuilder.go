package gildedrose

type SulfurasBuilder struct {
	SellIn  int
	Quality int
}

func newSulfurasBuilder() *SulfurasBuilder {
	return &SulfurasBuilder{}
}

func (b *SulfurasBuilder) calculSellIn(item *Item) {
	b.SellIn = item.SellIn
}

func (b *SulfurasBuilder) calculQuality(item *Item) {
	b.Quality = item.Quality
}

func (b *SulfurasBuilder) getCalculItem() CulcalItem {
	return CulcalItem{
		SellIn:  b.SellIn,
		Quality: b.Quality,
	}
}
