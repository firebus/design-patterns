Ndletons
========

The Ndleton pattern is the master pattern from which the Singleton is derived. A Singleton is a first degree Ndleton. When the
degree is greater than one, a collection of instances is maintained by the Ndleton. Any algorithm can be used to determine which
instance in the collection to return when an instance is requested. We present a couple of examples in this library.

## Use cases

We've seen the Ndleton pattern used in these situations:

* An individual instance is untrustworthy. 

  If instances have a habit of dying, getting wedged, getting hung by an external dependency, or if you just can't bother to fix a
  difficult to reproduce error condition, spin up multiple instances to reduce the likelihood of failure.

	* If it's possible to determine that an instance has failed, the caller can request instances serially, getting a new instance
      if the first one is no good.
  
	* If failure is non-deterministic, the caller can request multiple instances, and send the same job to all instances in
      parallel. If you know how often instances fail, it's possible to set the degree high enough to guarantee 99.999% uptime.

* Simulation of system failure.

  Ndletons are great for modeling failure-prone systems (e.g. an application running on a cloud platform). In this case instances
  are programmed to fail under certain conditions. Using Ndletons as mock objects, it's possible to validate that an application
  can handle these kinds of failures. The SchroedingersNdleton supports this use case, especially if your cloud platform is
  exposed to unusual amounts of radiation (e.g. mushroom-shaped clouds) or your datacenter is staffed by cats.

## Examples

* The Doubleton is the simplest extension of the Singleton pattern, and possibly the most useful.
* ProbabilisticDoubleton returns a random instance from the collection instead of progressing through the instances in order,
  which is great if you like surprises.
* DynamicNdleton allows each caller to specify the size of the collection, very helpful for teams that can't agree on things.
* SchroedingersSingleton simulates the famous Schroedinger's cat experiment. The instance will eventually die. The probability of
  death increases over time, per the formula for exponential decay. There's no way of knowing if the instance is alive or dead
  without opening the box (i.e. calling getInstance()).

## References

I am not the first to explore this underutilized design pattern

* http://www.codeproject.com/Articles/10335/Starting-from-the-Singleton-Design-Pattern-to-Expl
* http://stackoverflow.com/questions/3026282/doubleton-pattern-implementation
* http://stackoverflow.com/questions/3046940/doubleton-pattern-in-c
* http://www.codingtiger.com/questions/c++/Doubleton-pattern-in-C++.html