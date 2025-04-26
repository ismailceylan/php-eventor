# Eventor
This is a lightweight event handling system for PHP classes via Trait.

Eventor provides a simple event-driven API to any PHP class without forcing inheritance. Attach event listeners, trigger them, propagate results, and handle listeners with priority and once-only options.

## 🚀 Installation
```BASH
composer require iceylan/eventor
```

## ✨ Features
* Add event-driven behavior to any class via a trait
* Support for `on`, `once`, `off`, `trigger`
* Listener priority system
* Stop event propagation
* Collect listener return values
* Minimal and flexible

## 🔥 Usage
```PHP
use Iceylan\Eventor\ShouldDispatchEvents;
use Iceylan\Eventor\HasEvents;

class User implements ShouldDispatchEvents
{
    use HasEvents;
}

// Example
$user = new User();

$user->on( 'registered', function()
{
    return 'Sending welcome email.';
});

$user->on( 'registered', function()
{
    return 'Logging registration.';
}, priority: 10 );
// Higher priority, runs first

$results = $user->trigger( 'registered' );

print_r($results);
```

Output:

```PHP
[
    'Logging registration.',
    'Sending welcome email.'
]
```

## 🛠 Advanced Usage
You can alias trait methods when using the trait, allowing you to customize your API surface:

```PHP
use Iceylan\Eventor\HasEvents;

class Order
{
    use HasEvents {
        on as public addHook;
        off as public removeHook;
        trigger as public runHook;
    }
}

$order = new Order();

$order->addHook( 'something.happened', function()
{
    echo "something happened";
});

$order->runHook( 'something.happened' );
```
