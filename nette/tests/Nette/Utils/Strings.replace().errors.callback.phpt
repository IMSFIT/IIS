<?php

/**
 * Test: Nette\Utils\Strings and error in callback.
 *
 * @author     David Grudl
 * @package    Nette\Utils
 * @phpversion 5.3 due to nested closure
 */

use Nette\Utils\Strings;


require __DIR__ . '/../bootstrap.php';


Assert::error(function() {
	Assert::same('HELLO', Strings::replace('hello', '#.+#', new Nette\Callback(function($m) {
		$a++; // E_NOTICE
		return strtoupper($m[0]);
	})));
}, E_NOTICE, "Undefined variable: a");


Assert::same('HELLO', Strings::replace('hello', '#.+#', new Nette\Callback(function($m) {
	preg_match('#\d#u', "0123456789\xFF"); // Malformed UTF-8 data
	return strtoupper($m[0]);
})));
