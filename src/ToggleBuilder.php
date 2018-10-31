<?php

namespace NovaComponents\ValueToggle;

use Closure;
use JsonSerializable;
use Illuminate\Support\Str;
use Illuminate\Database\Query\Builder;

class ToggleBuilder extends Builder implements JsonSerializable
{
    /**
     * All of the available clause operators.
     *
     * @var array
     */
    public $operators = [
        '=', '<', '>', '<=', '>=', '<>', '!='
    ];

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
		$condition = new static(new NullConnection);

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