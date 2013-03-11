<?php

namespace Firebus\DesignPatterns\Ndleton;

/**
 * A concrete implementation of SchroedingersNdleton
 */
class SchroedingersSingleton extends SchroedingersNdleton {
	
	public static function getInstance() {
		self::$degree = 1;
		return parent::getInstance('SchroedingersSingleton');
	}
	
	protected static function getIndex() {
		return 0;
	}
	
	protected static function incrementIndex() {}
}