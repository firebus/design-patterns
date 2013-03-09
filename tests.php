<?php

require_once('library/firebus/ndleton/AbstractNdleton.php');
require_once('library/firebus/ndleton/Doubleton.php');
require_once('library/firebus/ndleton/ProbabilisticDoubleton.php');
require_once('library/firebus/ndleton/DynamicNdleton.php');
require_once('library/firebus/ndleton/SchroedingersNdleton.php');
require_once('library/firebus/ndleton/SchroedingersSingleton.php');

print "doubleton\n";

$doubleton1 = \firebus\ndleton\Doubleton::getInstance();
$doubleton2 = \firebus\ndleton\Doubleton::getInstance();
$doubleton3 = \firebus\ndleton\Doubleton::getInstance(); // Should be the same instance as $doubleton1

if ($doubleton1 === $doubleton2) {
	print "doubleton1 = doubleton2\n"; // Unexpected
}
if ($doubleton1 === $doubleton3) {
	print "doubleton1 = doubleton3\n"; // Expected
}

print "\nprobabilistic doubleton\n";

$pdoubleton1 = \firebus\ndleton\ProbabilisticDoubleton::getInstance();
$pdoubleton2 = \firebus\ndleton\ProbabilisticDoubleton::getInstance();
$pdoubleton3 = \firebus\ndleton\ProbabilisticDoubleton::getInstance();

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

$ndleton1 = \firebus\ndleton\DynamicNdleton::getInstance(2); // Doubleton
$ndleton2 = \firebus\ndleton\DynamicNdleton::getInstance(2); // Doubleton
$ndleton3 = \firebus\ndleton\DynamicNdleton::getInstance(3); // Tripleton
$ndleton4 = \firebus\ndleton\DynamicNdleton::getInstance(3); // Tripleton, should be the same instance as $ndleton1

if ($ndleton1 === $ndleton3) {
	print "ndleton1 = ndleton3\n"; // Unexpected
}
if ($ndleton1 === $ndleton4) {
	print "ndleton1 = ndleton4\n"; // Expected
}

print "\nshroedingers singleton\n";

// Each 5 seconds the likelihood of survival reduces by 50%
\firebus\ndleton\SchroedingersSingleton::setHalfLife(5);
$ssingleton = \firebus\ndleton\SchroedingersSingleton::getInstance();
while (TRUE) {
	sleep(1);
	$ssingleton = \firebus\ndleton\SchroedingersSingleton::getInstance();	
	if ($ssingleton) {
		print "the cat is still alive\n";
	} else {
		print "the cat is dead\n";
		break;
	}
}