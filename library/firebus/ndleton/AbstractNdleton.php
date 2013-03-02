<?php

namespace firebus\ndleton;

/**
 * An Ndleton is an extension of the Singleton design pattern which supports singleton-like use cases that require more than one
 * instance. 
 * 
 * AbstractNdleton is an example generic base class that concrete Ndletons can extend
 */
class AbstractNdleton {

	/** @var integer $degree How many instances to create. Each concrete Ndleton must define this */
	protected static $degree;
	/** @var integer $instanceIndex Keep track of the last instance to be returned */
	protected static $instanceIndex = 0;
	/** @var Array $instanceCollection */
	protected static $instanceCollection;
	
	protected function __construct() {}
	
	public static function getInstance() {
		if (count(self::$instanceCollection) < self::$degree) {
			self::$instanceCollection[] = new INTROSPECTION;
			return self::$instanceCollection[self::getIndex()];
		} else {
			return self::$instanceCollection[self::getIndex()];
		}
		$this->incrementIndex;
	}
	
	abstract protected static function getIndex();
	
	abstract protected static function incrementIndex();
}