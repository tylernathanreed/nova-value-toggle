<?php

namespace Reedware\NovaValueToggle;

use Closure;
use JsonSerializable;

class ToggleBuilder implements JsonSerializable
{
    use WhereClauses;

	/**
	 * Creates and returns a new toggle condition instance.
	 *
	 * @param  \Closure  $callback
	 *
	 * @return static
	 */
	public static function make(Closure $callback)
	{
		// Create a new toggle condition
		$condition = new static();

		// Apply the callback on the condition
		$callback($condition);

		// Return the toggle condition
		return $condition;
	}

    /**
     * Prepare the panel for JSON serialization.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'bindings' => $this->bindings,
            'wheres' => $this->wheres,
            'operators' => $this->operators
        ];
    }
}