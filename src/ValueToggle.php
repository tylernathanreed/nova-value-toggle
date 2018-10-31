<?php

namespace NovaComponents\ValueToggle;

use Closure;
use JsonSerializable;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Contracts\Resolvable;

class ValueToggle implements JsonSerializable, Resolvable
{
    /**
     * The vue component.
     *
     * @var string
     */
    public $component = 'value-toggle';

    /**
	 * The field being toggled.
	 *
	 * @var \Laravel\Nova\Fields\Field
     */
    public $field;

    /**
     * The condition in which the field appears.
     *
     * @var \NovaComponents\ValueToggle\ToggleBuilder
     */
    public $condition;

    /**
     * Create a new field.
     *
     * @param  \Laravel\Nova\Fields\Field  $field
     * @param  \Closure                    $condition
     *
     * @return void
     */
    public function __construct(Field $field, Closure $condition)
    {
        $this->field = $field;
        $this->condition = ToggleBuilder::make($condition);
    }

    /**
     * Create a new element.
     *
     * @return static
     */
    public static function make(...$arguments)
    {
        return new static(...$arguments);
    }

    /**
     * Resolve the field's value.
     *
     * @param  mixed        $resource
     * @param  string|null  $attribute
     *
     * @return void
     */
    public function resolve($resource, $attribute = null)
    {
        return $this->field->resolve($resource, $attribute);
    }

    /**
     * Prepare the panel for JSON serialization.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'component' => $this->component,
            'field' => $this->field,
            'condition' => $this->condition,
            'prefixComponent' => true,
            'panel' => $this->panel,
            'indexName' => $this->field->name,
            'textAlign' => $this->field->textAlign,
        ];
    }

    /**
     * Handles dynamic method calls to the field instance.
     *
     * @param  string  $method
     * @param  array   $arguments
     *
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        return $this->field->{$method}(...$arguments);
    }

    /**
     * Handles dynamic attribute access to the field instance.
     *
     * @param  string  $attribute
     *
     * @return mixed
     */
    public function __get($attribute)
    {
        return $this->field->{$attribute};
    }

    /**
     * Handles dynamic atribute mutating to the field instance.
     *
     * @param  string  $attribute
     * @param  mixed   $value
     *
     * @return void
     */
    public function __set($attribute, $value)
    {
        $this->field->{$attribute} = $value;
    }
}
