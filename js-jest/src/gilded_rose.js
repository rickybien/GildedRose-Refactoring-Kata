class Item {
  constructor(name, sellIn, quality){
    this.name = name;
    this.sellIn = sellIn;
    this.quality = quality;
  }
}

class Shop {
	constructor(items=[]){
		this.items = items;
  }

	static SELLING_PRODUCTS = {
		AGED_BRIE: {
			name: 'Aged Brie',
			passQualityRules: {
				expired: 2,
				notExpired: 1,
			} 
		},
		BACKSTAGE_PASSES: {
			name: 'Backstage passes to a TAFKAL80ETC concert',
			passQualityRules: {
				expiresIn5Days: 3,
				expiresIn10Days: 2,
				notExpired: 1,
			} 
		},
		SULFURAS: {
			name: 'Sulfuras, Hand of Ragnaros'
		},
		CONJURED: {
			name: 'Conjured',
			passQualityRules: {
				expired: -4,
				notExpired: -2,
			} 
		},
		NORMAL: {
			passQualityRules: {
				expired: -2,
				notExpired: -1,
			} 
		}
	};

	static ITEM_QUALITY_LIMITS = {
		MAX_VALUE: 50,
		MIN_VALUE: 0,
	}

	isExpired(sellIn = ITEM_QUALITY_LIMITS.MIN_VALUE) {
		return sellIn <= 0;
	}

	calculateQuality({value = ITEM_QUALITY_LIMITS.MIN_VALUE, increment = ITEM_QUALITY_LIMITS.MIN_VALUE}) {
		const result = value + increment;
  	return result > Shop.ITEM_QUALITY_LIMITS.MAX_VALUE ?
			Shop.ITEM_QUALITY_LIMITS.MAX_VALUE : result < Shop.ITEM_QUALITY_LIMITS.MIN_VALUE ?
			Shop.ITEM_QUALITY_LIMITS.MIN_VALUE : result;
  }

	getBackstagePassQualityRuleKey(sellIn = ITEM_QUALITY_LIMITS.MIN_VALUE) {
		const rulesMap = [
			{ condition: (sellIn) => sellIn <= 5, ruleKey: 'expiresIn5Days' },
			{ condition: (sellIn) => sellIn <= 10, ruleKey: 'expiresIn10Days' },
			{ condition: () => true, ruleKey: 'notExpired' },
		];

		return rulesMap.find(rule => rule.condition(sellIn)).ruleKey;
	}

  updateQuality() {
		return this.items.map(item=> {
			let { name, sellIn, quality } = item;

			switch (name) {
				case Shop.SELLING_PRODUCTS.SULFURAS.name:
					return item;
				case Shop.SELLING_PRODUCTS.AGED_BRIE.name:
					quality = this.calculateQuality({
						value: quality,
						increment: this.isExpired(sellIn) ? 
							Shop.SELLING_PRODUCTS.AGED_BRIE.passQualityRules.expired : 
							Shop.SELLING_PRODUCTS.AGED_BRIE.passQualityRules.notExpired
					});
					break;
				case Shop.SELLING_PRODUCTS.BACKSTAGE_PASSES.name:
					if (this.isExpired(sellIn)) {
						quality = Shop.ITEM_QUALITY_LIMITS.MIN_VALUE;
					} else {
						quality = this.calculateQuality({
							value: quality,
							increment: Shop.SELLING_PRODUCTS.BACKSTAGE_PASSES.passQualityRules[this.getBackstagePassQualityRuleKey(sellIn)]
						});
					}
					break;
				case Shop.SELLING_PRODUCTS.CONJURED.name:
					quality = this.calculateQuality({
						value: quality, 
						increment: this.isExpired(sellIn) ? 
							Shop.SELLING_PRODUCTS.CONJURED.passQualityRules.expired : 
							Shop.SELLING_PRODUCTS.CONJURED.passQualityRules.notExpired
					});
					break;
				default:
					quality = this.calculateQuality({
						value: quality,
						increment: this.isExpired(sellIn) ? 
							Shop.SELLING_PRODUCTS.NORMAL.passQualityRules.expired : 
							Shop.SELLING_PRODUCTS.NORMAL.passQualityRules.notExpired
					});
					break;
			}

			return ({
				name,
				sellIn: name === Shop.SELLING_PRODUCTS.SULFURAS.name ? sellIn : sellIn - 1,
				quality,
			})
		})
  }
}

module.exports = {
  Item,
  Shop
}
