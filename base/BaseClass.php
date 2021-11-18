<?php

namespace Tritonium\Base;

class BaseClass extends \StdClass
{

	/**
	 * Configures an object with the initial property values.
	 * @param object $object the object to be configured
	 * @param array $properties the property initial values given in terms of name-value pairs.
	 * @return object the object itself
	 */
	public static function configure($object, $properties)
	{
		foreach ($properties as $name => $value) {
			$object->$name = $value;
		}

		return $object;
	}
}