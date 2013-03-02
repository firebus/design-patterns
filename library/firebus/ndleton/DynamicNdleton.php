<?php

namespace firebus\ndleton;

/**
 * A Dynamic Ndleton can simulate any specific Ndleton, so that each caller can choose how many instances are in its collection
 */
class DynamicNdleton extends AbstractNdleton {

	public static function getInstance($n) {
		if (count(self::$instanceCollection) < $n) {
			self::$instanceCollection[] = new Doubleton;
			return self::$instanceCollection[self::$instanceIndex % n];
		} else {
			return self::$instanceCollection[self::$instanceIndex % n];
		}
		$this->incrementIndex;
	}
	
	protected static function incrementIndex() {
		self::$instanceIndex = (self::$instanceIndex + 1);
	}
}