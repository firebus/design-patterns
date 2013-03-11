<?php

namespace Firebus\DesignPatterns\Ndleton;

/**
 * A Dynamic Ndleton behaves like any Ndleton on a per-caller basis, i.e. each caller can specify how many instances are in its
 * pool
 */
class DynamicNdleton extends AbstractNdleton {

	public static function getInstance($degree) {
		self::$degree = $degree;
		return parent::getInstance('DynamicNdleton');
	}
	
	protected static function getIndex() {
		return self::$instanceIndex % self::$degree;
	}
	
	protected static function incrementIndex() {
		self::$instanceIndex = (self::$instanceIndex + 1);
	}
}