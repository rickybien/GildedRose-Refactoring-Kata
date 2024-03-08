import { clamp } from './helper';

export const itemSettings = {
  'Aged Brie': {
    sellIn: (v) => v - 1,
    quality: (sellIn, q) => {
      if(sellIn < 0) return clamp(q + 2);
      return clamp(q + 1);
    },
  },
  'Sulfuras, Hand of Ragnaros': {
    sellIn: (v) => v,
    quality: (_sellIn, q) => q,
  },
  'Backstage passes to a TAFKAL80ETC concert': {
    sellIn: (v) => v - 1,
    quality: (sellIn, q) => {
      if(sellIn < 0) return 0;
      if(sellIn < 5) return clamp(q + 3);
      if(sellIn < 10) return clamp(q + 2);
      return clamp(q + 1);
    },
  },
  'Conjured': {
    sellIn: (v) => v - 1,
    quality: (sellIn, q) => {
      if(sellIn < 0) return clamp(q - 4);
      return clamp(q - 2);
    },
  },
  DEFAULT: {
    sellIn: (val) => val - 1,
    quality: (sellIn, q) => {
      if(sellIn < 0) return clamp(q - 2);
      return clamp(q - 1);
    },
  },
};
