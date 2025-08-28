package gildedrose

type Item struct {
	Name            string
	SellIn, Quality int
}

func UpdateQuality(items []*Item) {

	for i := 0; i < len(items); i++ {
		builderInstance := getBuilder(items[i].Name)

		director := setDirector(builderInstance)
		resultItem := director.setItem(items[i]).eBuilder()

		items[i].SellIn = resultItem.SellIn
		items[i].Quality = resultItem.Quality
	}
}
