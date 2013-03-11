<?php

$root = '../../Ndleton';
require_once("$root/AbstractNdleton.php");
require_once("$root/Doubleton.php");
require_once("$root/ProbabilisticDoubleton.php");
require_once("$root/DynamicNdleton.php");
require_once("$root/SchroedingersNdleton.php");
require_once("$root/SchroedingersSingleton.php");

print "doubleton\n";

$doubleton1 = \Firebus\DesignPatterns\Ndleton\Doubleton::getInstance();
$doubleton2 = \Firebus\DesignPatterns\Ndleton\Doubleton::getInstance();
$doubleton3 = \Firebus\DesignPatterns\Ndleton\Doubleton::getInstance(); // Should be the same instance as $doubleton1

if ($doubleton1 === $doubleton2) {
	print "doubleton1 = doubleton2\n"; // Unexpected
}
if ($doubleton1 === $doubleton3) {
	print "doubleton1 = doubleton3\n"; // Expected
}

print "\nprobabilistic doubleton\n";

$pdoubleton1 = \Firebus\DesignPatterns\Ndleton\ProbabilisticDoubleton::getInstance();
$pdoubleton2 = \Firebus\DesignPatterns\Ndleton\ProbabilisticDoubleton::getInstance();
$pdoubleton3 = \Firebus\DesignPatterns\Ndleton\ProbabilisticDoubleton::getInstance();

// Each run will be different.
if ($pdoubleton1 === $pdoubleton2) {
	print "pdoubleton1 = pdoubleton2\n";
}
if ($pdoubleton2 === $pdoubleton3) {
	print "pdoubleton2 = pdoubleton3\n";
}
if ($pdoubleton1 === $pdoubleton3) {
	print "pdoubleton1 = pdoubleton3\n";
}

print "\ndynaic ndleton\n";

$ndleton1 = \Firebus\DesignPatterns\Ndleton\DynamicNdleton::getInstance(2); // Doubleton
$ndleton2 = \Firebus\DesignPatterns\Ndleton\DynamicNdleton::getInstance(2); // Doubleton
$ndleton3 = \Firebus\DesignPatterns\Ndleton\DynamicNdleton::getInstance(3); // Tripleton
$ndleton4 = \Firebus\DesignPatterns\Ndleton\DynamicNdleton::getInstance(3); // Tripleton, should be the same instance as $ndleton1

if ($ndleton1 === $ndleton3) {
	print "ndleton1 = ndleton3\n"; // Unexpected
}
if ($ndleton1 === $ndleton4) {
	print "ndleton1 = ndleton4\n"; // Expected
}

print "\nshroedingers singleton\n";

// Each 5 seconds the likelihood of survival reduces by 50%
\Firebus\DesignPatterns\Ndleton\SchroedingersSingleton::setHalfLife(5);
$ssingleton = \Firebus\DesignPatterns\Ndleton\SchroedingersSingleton::getInstance();
while (TRUE) {
	sleep(1);
	$ssingleton = \Firebus\DesignPatterns\Ndleton\SchroedingersSingleton::getInstance();	
	if ($ssingleton) {
		print "the cat is still alive\n";
	} else {
		print "the cat is dead\n";
		break;
	}
}