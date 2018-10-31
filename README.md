## Nova Value Toggle

### Installation

Require this package with composer.

```shell
composer require reedware/nova-value-toggle
```

This package uses auto-discovery, so doesn't require you to manually add the service provider. Should you choose to do this manually, you can include the following class in your list of service providers:

```php
\Reedware\NovaValueToggle\FieldServiceProvider::class
```

### Usage

This package creates a new `ValueToggle` field, which is used to wrap around an existing field, such that you may toggle the visibility of the field (on both the detail and edit pages) based on the value of another field.

First and foremost, before you can use the field, you must include it in your code:

```php
use Reedware\NovaValueToggle\ValueToggle;
```

As an example, let's say you have a `Flight` model and resource. Here's what you might expect to see as fields in your `Flight` resource:

```php
/**
 * Get the fields displayed by the resource.
 *
 * @param  \Illuminate\Http\Request  $request
 *
 * @return array
 */
public function fields(Request $request)
{
    return [
        ID::make('ID', 'id')->sortable(),
        Text::make('Name', 'name')->sortable()->rules('required'),
        Select::make('Lands On', 'lands_on')->options([
            'land' => 'Land',
            'water' => 'Water'
        ]),
        Number::make('Wheel Count', 'wheel_count')->min(1)->max(1000)->step(1)
}
```

For flights that land on water, you want to assume that the Wheel Count should be 0. You could provide validation for this, but then you'd essentially have a useless field taking up visible space on the update form. Instead, you could hide the field when the flight is expected to land on water.

This is where the `ValueToggle` field comes in:

```php
/**
 * Get the fields displayed by the resource.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return array
 */
public function fields(Request $request)
{
    return [
        ID::make('ID', 'id')->sortable(),
        Text::make('Name', 'name')->sortable()->rules('required'),
        Select::make('Lands On', 'lands_on')->options([
            'land' => 'Land',
            'water' => 'Water'
        ]),
        ValueToggle::make(Number::make('Wheel Count', 'wheel_count')->min(1)->max(1000)->step(1), function($toggle) {
            return $toggle->where('lands_on', '=', 'land');
        })
    ];
}
```

We still have the original "Wheel Count" field, but it has been passed as the first parameter to `ValueToggle`. The second parameter is a closure that describes when you would like the field to appear.
