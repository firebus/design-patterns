<?php

namespace firebus\ndleton;

/**
 * Instead of alternating between each instance in order, a Probabilistic Ndleton returns an instance at "random" from its
 * collection
 */
class ProbabilisticDoubleton extends Doubleton {
	protected static function incrementIndex() {
		self::$instanceIndex = mt_rand(0, count(self::$instanceCollection) - 1);
	}
}