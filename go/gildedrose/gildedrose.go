package gildedrose

type Item struct {
	Name            string
	SellIn, Quality int
}

func UpdateQuality(items []*Item) {
	for _, item := range items {
		switch item.Name {
		case "Sulfuras, Hand of Ragnaros":
			Sulfuras(item)
		case "Aged Brie":
			AgedBrie(item)
		case "Backstage passes to a TAFKAL80ETC concert":
			BackstagePasses(item)
		case "Conjured":
			Conjured(item)
		default:
			Normal(item)
		}
	}
}

func Sulfuras(item *Item) {
	// pass
}

func AgedBrie(item *Item) {
	if item.Quality < 50 {
		if item.SellIn <= 0 {
			item.Quality += 2
		} else {
			item.Quality += 1
		}
	}
	if item.Quality > 50 {
		item.Quality = 50
	}

	item.SellIn -= 1
}

func BackstagePasses(item *Item) {
	switch {
	case item.SellIn <= 0:
		item.Quality = 0
	case item.SellIn <= 5:
		item.Quality += 3
	case item.SellIn <= 10:
		item.Quality += 2
	default:
		item.Quality += 1
	}
	if item.Quality > 50 {
		item.Quality = 50
	}

	item.SellIn -= 1
}

func Conjured(item *Item) {
	switch {
	case item.SellIn <= 0:
		item.Quality -= 4
	default:
		item.Quality -= 2
	}
	if item.Quality < 0 {
		item.Quality = 0
	}

	item.SellIn -= 1
}

func Normal(item *Item) {
	switch {
	case item.SellIn <= 0:
		item.Quality -= 2
	default:
		item.Quality -= 1
	}
	if item.Quality < 0 {
		item.Quality = 0
	}

	item.SellIn -= 1
}
