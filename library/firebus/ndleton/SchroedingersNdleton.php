<?php

namespace firebus\ndleton;

/**
 * In a Schroedinger's Ndleton getInstance() will either return an instance or a null.
 * 
 * There is no way of knowing if the $instanceContainer contains instances or nulls until you call getInstance() and "open the
 * box". A naive physicist might argue that the container has *both* instances AND nulls until getInstance() is called. This is
 * clearly absurd, thus this Ndleton is excellent for use cases that require a refutation of the Copenhagen Interpretation.
 * 
 * The details of Schroedinger's experiment are ambiguous for lengths of time shorter or longer than an hour. We'll assume that 
 * the machine of death contains a single atom, of a substance that undergoes exponential decay, with a half-life set by a class
 * constant.
 * 
 * http://en.wikipedia.org/wiki/Schr%C3%B6dinger%27s_cat
 * One can even set up quite ridiculous cases. A cat is penned up in a steel chamber, along with the following device (which must
 * be secured against direct interference by the cat): in a Geiger counter, there is a tiny bit of radioactive substance, so small
 * that perhaps in the course of the hour, one of the atoms decays, but also, with equal probability, perhaps none; if it happens,
 * the counter tube discharges, and through a relay releases a hammer that shatters a small flask of hydrocyanic acid. If one has
 * left this entire system to itself for an hour, one would say that the cat still lives if meanwhile no atom has decayed. The
 * psi-function of the entire system would express this by having in it the living and dead cat mixed or smeared out in equal
 * parts. It is typical of these cases that an indeterminacy originally restricted to the atomic domain becomes transformed into
 * macroscopic indeterminacy, which can then be resolved by direct observation. That prevents us from so naively accepting as
 * valid a "blurred model" for representing reality. In itself, it would not embody anything unclear or contradictory. There is a
 * difference between a shaky or out-of-focus photograph and a snapshot of clouds and fog banks.
 */
abstract class SchroedingersNdleton extends AbstractNdleton {
	
	protected static $halfLife = 3600; // One hour by default
	const ATOM_COUNT = 1;

	/** @var float $startTime A microtimestamp */
	protected static $startTime = null;
	protected static $isDead = false;
	
	public static function getInstance($className) {
		if (is_null(self::$startTime)) {
			self::$startTime = microtime(true);
		}
		if (self::$isDead || self::openTheBox()) {
			return null;
		} else {
			return parent::getInstance($className);
		}
	}

	/**
	 * Calculate the probabilty of decay since $startTime
	 * http://en.wikipedia.org/wiki/Half-life#Formulas_for_half-life_in_exponential_decay
	 */
	protected static function openTheBox() {
		$now = microtime(true);
		$diff = $now - self::$startTime;
		$probability = self::ATOM_COUNT * pow(0.5, $diff / self::$halfLife);
		// TODO: This needs to vary between 0 and ATOM_COUNT
		$random = mt_rand() / mt_getrandmax();
		if ($probability < $random) {
			self::$isDead = true;
			return true;
		} else {
			return false;
		}
	}
	
	public static function setHalfLife($seconds) {
		self::$halfLife = $seconds;
	}
}