<?php

namespace Firebus\DesignPatterns\Ndleton;

/**
 * An Ndleton is an extension of the Singleton design pattern which supports singleton-like use cases that require more than one
 * instance. 
 * 
 * AbstractNdleton is an example generic base class that concrete Ndletons can extend
 */
abstract class AbstractNdleton {

	/** @var integer $degree How many instances to create. Each concrete Ndleton must define this */
	protected static $degree;
	/** @var integer $instanceIndex Keep track of the last instance to be returned */
	protected static $instanceIndex = 0;
	/** @var Array $instanceCollection */
	protected static $instanceCollection = array();
	
	protected function __construct() {}
	
	public static function getInstance($className) {
		$className = __NAMESPACE__ . "\\$className";
		if (count(self::$instanceCollection) < static::$degree) {
			error_log('making a new instance');
			self::$instanceCollection[] = new $className;
		}
		$instance = self::$instanceCollection[static::getIndex()];
		static::incrementIndex();
		return $instance;
	}
	
	abstract protected static function getIndex();
	
	abstract protected static function incrementIndex();
}