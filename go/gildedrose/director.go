package gildedrose

type Director struct {
	builder IBuilder
	item    *Item
}

func setDirector(b IBuilder) *Director {
	return &Director{
		builder: b,
	}
}

func (d *Director) setItem(item *Item) *Director {
	d.item = item
	return d
}

func (d *Director) eBuilder() CulcalItem {

	d.builder.calculSellIn(d.item)

	d.builder.calculQuality(d.item)

	return d.builder.getCalculItem()
}
