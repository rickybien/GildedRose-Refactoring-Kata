@testable import GildedRose
import XCTest

class GildedRoseTests: XCTestCase {
    //---------------
    // normal item
    //---------------
    func testUpdatesNormalItemsBeforeSellDate() throws {
        // arrange
        let items = [Item(name: "normal", sellIn: 5, quality: 10)]
        let app = GildedRose(items: items)

        // act
        app.updateQuality()

        // assert
        XCTAssertEqual(app.items[0].sellIn, 4)
        XCTAssertEqual(app.items[0].quality, 9)
    }

    func testUpdatesNormalItemsOnSellDate() throws {
        // arrange
        let items = [Item(name: "normal", sellIn: 0, quality: 10)]
        let app = GildedRose(items: items)

        // act
        app.updateQuality()

        // assert
        XCTAssertEqual(app.items[0].sellIn, -1)
        XCTAssertEqual(app.items[0].quality, 8)
    }

    func testUpdatesNormalItemsAfterSellDate() throws {
        // arrange
        let items = [Item(name: "normal", sellIn: -5, quality: 10)]
        let app = GildedRose(items: items)

        // act
        app.updateQuality()

        // assert
        XCTAssertEqual(app.items[0].sellIn, -6)
        XCTAssertEqual(app.items[0].quality, 8)
    }

    func testUpdatesNormalItemsWithAQualityOf0() throws {
        // arrange
        let items = [Item(name: "normal", sellIn: 5, quality: 0)]
        let app = GildedRose(items: items)

        // act
        app.updateQuality()

        // assert
        XCTAssertEqual(app.items[0].sellIn, 4)
        XCTAssertEqual(app.items[0].quality, 0)
    }

    //---------------
    // Brie item
    //---------------
    func testUpdatesBrieItemsBeforeSellDate() throws {
        // arrange
        let items = [Item(name: "Aged Brie", sellIn: 5, quality: 10)]
        let app = GildedRose(items: items)

        // act
        app.updateQuality()

        // assert
        XCTAssertEqual(app.items[0].sellIn, 4)
        XCTAssertEqual(app.items[0].quality, 11)
    }

    func testUpdatesBrieItemsBeforeSellDateWithMaximumQuality() throws {
        // arrange
        let items = [Item(name: "Aged Brie", sellIn: 5, quality: 50)]
        let app = GildedRose(items: items)

        // act
        app.updateQuality()

        // assert
        XCTAssertEqual(app.items[0].sellIn, 4)
        XCTAssertEqual(app.items[0].quality, 50)
    }

    func testUpdatesBrieItemsOnSellDate() throws {
        // arrange
        let items = [Item(name: "Aged Brie", sellIn: 0, quality: 10)]
        let app = GildedRose(items: items)

        // act
        app.updateQuality()

        // assert
        XCTAssertEqual(app.items[0].sellIn, -1)
        XCTAssertEqual(app.items[0].quality, 12)
    }

    func testUpdatesBrieItemsOnSellDateNearMaximumQuality() throws {
        // arrange
        let items = [Item(name: "Aged Brie", sellIn: 0, quality: 49)]
        let app = GildedRose(items: items)

        // act
        app.updateQuality()

        // assert
        XCTAssertEqual(app.items[0].sellIn, -1)
        XCTAssertEqual(app.items[0].quality, 50)
    }

    func testUpdatesBrieItemsOnSellDateWithMaximumQuality() throws {
        // arrange
        let items = [Item(name: "Aged Brie", sellIn: 0, quality: 50)]
        let app = GildedRose(items: items)

        // act
        app.updateQuality()

        // assert
        XCTAssertEqual(app.items[0].sellIn, -1)
        XCTAssertEqual(app.items[0].quality, 50)
    }

    func testUpdatesBrieItemsAfterSellDate() throws {
        // arrange
        let items = [Item(name: "Aged Brie", sellIn: -10, quality: 10)]
        let app = GildedRose(items: items)

        // act
        app.updateQuality()

        // assert
        XCTAssertEqual(app.items[0].sellIn, -11)
        XCTAssertEqual(app.items[0].quality, 12)
    }

    func testUpdatesBrieItemsAfterSellDateWithMaximumQuality() throws {
        // arrange
        let items = [Item(name: "Aged Brie", sellIn: -10, quality: 50)]
        let app = GildedRose(items: items)

        // act
        app.updateQuality()

        // assert
        XCTAssertEqual(app.items[0].sellIn, -11)
        XCTAssertEqual(app.items[0].quality, 50)
    }

    //---------------
    // Sulfuras item
    //---------------
    func testUpdatesSulfurasItemsBeforeSellDate() throws {
        // arrange
        let items = [Item(name: "Sulfuras, Hand of Ragnaros", sellIn: 5, quality: 10)]
        let app = GildedRose(items: items)

        // act
        app.updateQuality()

        // assert
        XCTAssertEqual(app.items[0].sellIn, 5)
        XCTAssertEqual(app.items[0].quality, 10)
    }

    func testUpdatesSulfurasItemsOnSellDate() throws {
        // arrange
        let items = [Item(name: "Sulfuras, Hand of Ragnaros", sellIn: 0, quality: 10)]
        let app = GildedRose(items: items)

        // act
        app.updateQuality()

        // assert
        XCTAssertEqual(app.items[0].sellIn, 0)
        XCTAssertEqual(app.items[0].quality, 10)
    }

    func testUpdatesSulfurasItemsAfterSellDate() throws {
        // arrange
        let items = [Item(name: "Sulfuras, Hand of Ragnaros", sellIn: -1, quality: 10)]
        let app = GildedRose(items: items)

        // act
        app.updateQuality()

        // assert
        XCTAssertEqual(app.items[0].sellIn, -1)
        XCTAssertEqual(app.items[0].quality, 10)
    }

    //---------------
    // Backstage Pass
    //---------------
    func testUpdatesBackstagePassItemsLongBeforeSellDate() throws {
        // arrange
        let items = [Item(name: "Backstage passes to a TAFKAL80ETC concert", sellIn: 11, quality: 10)]
        let app = GildedRose(items: items)

        // act
        app.updateQuality()

        // assert
        XCTAssertEqual(app.items[0].sellIn, 10)
        XCTAssertEqual(app.items[0].quality, 11)
    }

    func testUpdatesBackstagePassItemsCloseToBeforeSellDate() throws {
        // arrange
        let items = [Item(name: "Backstage passes to a TAFKAL80ETC concert", sellIn: 10, quality: 10)]
        let app = GildedRose(items: items)

        // act
        app.updateQuality()

        // assert
        XCTAssertEqual(app.items[0].sellIn, 9)
        XCTAssertEqual(app.items[0].quality, 12)
    }

    func testUpdatesBackstagePassItemsCloseToSellDateAtMaximumQuality() throws {
        // arrange
        let items = [Item(name: "Backstage passes to a TAFKAL80ETC concert", sellIn: 10, quality: 50)]
        let app = GildedRose(items: items)

        // act
        app.updateQuality()

        // assert
        XCTAssertEqual(app.items[0].sellIn, 9)
        XCTAssertEqual(app.items[0].quality, 50)
    }

    func testUpdatesBackstagePassItemsVeryCloseToSellDate() throws {
        // arrange
        let items = [Item(name: "Backstage passes to a TAFKAL80ETC concert", sellIn: 5, quality: 10)]
        let app = GildedRose(items: items)

        // act
        app.updateQuality()

        // assert
        XCTAssertEqual(app.items[0].sellIn, 4)
        XCTAssertEqual(app.items[0].quality, 13)
    }

    func testUpdatesBackstagePassItemsVeryCloseToSellDateAtMaximumQuality() throws {
        // arrange
        let items = [Item(name: "Backstage passes to a TAFKAL80ETC concert", sellIn: 5, quality: 50)]
        let app = GildedRose(items: items)

        // act
        app.updateQuality()

        // assert
        XCTAssertEqual(app.items[0].sellIn, 4)
        XCTAssertEqual(app.items[0].quality, 50)
    }

    func testUpdatesBackstagePassItemsWithOneDayLeftToSellDateAtMaximumQuality() throws {
        // arrange
        let items = [Item(name: "Backstage passes to a TAFKAL80ETC concert", sellIn: 1, quality: 50)]
        let app = GildedRose(items: items)

        // act
        app.updateQuality()

        // assert
        XCTAssertEqual(app.items[0].sellIn, 0)
        XCTAssertEqual(app.items[0].quality, 50)
    }

    func testUpdatesBackstagePassItemsOnSellDate() throws {
        // arrange
        let items = [Item(name: "Backstage passes to a TAFKAL80ETC concert", sellIn: 0, quality: 10)]
        let app = GildedRose(items: items)

        // act
        app.updateQuality()

        // assert
        XCTAssertEqual(app.items[0].sellIn, -1)
        XCTAssertEqual(app.items[0].quality, 0)
    }

    func testUpdatesBackstagePassItemsAfterSellDate() throws {
        // arrange
        let items = [Item(name: "Backstage passes to a TAFKAL80ETC concert", sellIn: -1, quality: 10)]
        let app = GildedRose(items: items)

        // act
        app.updateQuality()

        // assert
        XCTAssertEqual(app.items[0].sellIn, -2)
        XCTAssertEqual(app.items[0].quality, 0)
    }
}
