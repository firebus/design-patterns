<?php

namespace firebus\ndleton;

/**
 * A Dynamic Ndleton can simulate any specific Ndleton, so that each caller can choose how many instances are in its collection
 */
class DynamicNdleton extends AbstractNdleton {

	public static function getInstance($degree) {
		self::$degree = $degree;
		return parent::getInstance();
	}
	
	protected static function getIndex() {
		return self::$instanceIndex % self::$degree;
	}
	
	protected static function incrementIndex() {
		self::$instanceIndex = (self::$instanceIndex + 1);
	}
}