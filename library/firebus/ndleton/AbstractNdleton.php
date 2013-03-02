<?php

namespace firebus\ndleton;

/**
 * An Ndleton is an extension of the Singleton design pattern which supports singleton-like use cases that require more than one
 * instance. 
 * 
 * AbstractNdleton is an example generic base class that concrete Ndletons can extend
 */
class AbstractNdleton {

	/** @var integer $instanceIndex Keep track of the last instance to be returned */
	protected static $instanceIndex = 0;
	/** @var Array $instanceCollection */
	protected static $instanceCollection;
	
	protected function __construct() {}
	
	abstract public static function getInstance();
	
	abstract protected static function incrementIndex();
}