const QUALITY_MIN = 0;
const QUALITY_MAX = 50;

export function clamp(value, min = QUALITY_MIN, max = QUALITY_MAX) {
  return Math.min(Math.max(value, min), max);
}
