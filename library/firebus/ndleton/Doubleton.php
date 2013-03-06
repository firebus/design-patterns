<?php

namespace firebus\ndleton;

/**
 * The Doubleton is probably the most useful of the Ndleton patterns.
 * Two instances are created (lazily) and each call to getInstance() alternates between the two
 */
class Doubleton extends AbstractNdleton {

	public static function getInstance() {
		self::$degree = 2;
		return parent::getInstance('Doubleton');
	}
	
	protected static function getIndex() {
		return self::$instanceIndex;
	}
	
	protected static function incrementIndex() {
		self::$instanceIndex = (self::$instanceIndex + 1) % self::$degree;
	}
}