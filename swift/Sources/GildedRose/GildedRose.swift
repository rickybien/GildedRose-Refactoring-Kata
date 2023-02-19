
public enum SpecialItem: String {
    case sulfurasHandOfRangaros = "Sulfuras, Hand of Ragnaros"
    case conjured = "Conjured"
}

public class GildedRose {
    var items: [Item]

    public init(items: [Item]) {
        self.items = items
    }
    
    private func updateItemQuality(with item: Item, ratio: Int = 1) {
        item.sellIn -= 1
        
        if item.sellIn < 0 {
            item.quality = 0
            return
        }
        
        item.quality += ratio
        
        switch item.sellIn {
        case 6..<11:
            item.quality = min(50, item.quality + ratio * 1)
        case let x where x < 6:
            item.quality = min(50, item.quality + ratio * 2)
        default:
            break
        }
    }
    
    public func updateQuality() {
        items.forEach { item in
            switch SpecialItem(rawValue: item.name) {
            case .conjured:
                updateItemQuality(with: item, ratio: 2)
                
            case .sulfurasHandOfRangaros:
                break
                
            default:
                updateItemQuality(with: item)
            }
        }
    }
}
