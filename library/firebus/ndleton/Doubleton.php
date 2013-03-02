<?php

namespace firebus\ndleton;

/**
 * The Doubleton is probably the most useful of the Ndleton patterns.
 * Two instances are created (lazily) and each call to getInstance() alternates between the two
 */
class Doubleton extends AbstractNdleton {

	const INSTANCE_LIMIT = 2;
	
	public static function getInstance() {
		if (count(self::$instanceCollection) < self::INSTANCE_LIMIT) {
			self::$instanceCollection[] = new Doubleton;
			return self::$instanceCollection[self::$instanceIndex];
		} else {
			return self::$instanceCollection[self::$instanceIndex];
		}
		$this->incrementIndex;
	}
	
	protected static function incrementIndex() {
		self::$instanceIndex = (self::$instanceIndex + 1) % self::INSTANCE_LIMIT;
	}
}