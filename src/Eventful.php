<?php

namespace Iceylan\Eventor;

/**
 * Represents a class that can dispatch events.
 */
class Eventful implements ShouldDispatchEvents
{
    use HasEvents;
}
