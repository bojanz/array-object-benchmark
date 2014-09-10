array-object-benchmark
========================

Benchmark for https://github.com/symfony/symfony/issues/11887 which analyzes
various approaches to representing ICU data (as a class, as an array, or combined).

There is general concensus that since PHP 5.4 using a typed object
requires less memory than using an array: https://gist.github.com/nikic/5015323
This means that the memory usage of various approaches should generally be irrelevant.

The tests were performed in a 64bit virtualbox machine running Ubuntu 12.04, PHP 5.4.31.
The measurements in milliseconds represent an average over 10 runs.

benchmark-array: 1.60ms
benchmark-object: 4.36ms
benchmark-combined: 2.00ms

Both memory and peak memory stayed at exactly 512kb for all tests, which is curious.

Constructing an array with all currency information (in benchmark-array.php) increased
the memory usage to 768kb, but I didn't include it since it doesn't represent a common
usage pattern.
