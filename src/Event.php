<?php

namespace Iceylan\Eventor;

/**
 * Represents an event.
 */
class Event
{
	/**
	 * Indicates whether the propagation of the event to other listeners is stopped.
	 *
	 * @var boolean
	 */
    protected bool $propagationStopped = false;

	/**
	 * The payload of the event.
	 *
	 * @var mixed
	 */
    protected mixed $payload;

    /**
     * Constructor.
     *
     * @param mixed $payload The payload of the event. By default, it is null.
     */
    public function __construct( mixed $payload = null )
    {
        $this->payload = $payload;
    }

    /**
     * Stops the propagation of the event to other listeners.
     *
     * Once this method is called, no further listeners will be called.
     *
     * @return void
     */
    public function stopPropagation(): void
    {
        $this->propagationStopped = true;
    }

    /**
     * Checks whether the propagation of the event to other listeners is stopped.
     *
     * @return boolean true if the propagation of the event is stopped, false otherwise
     */
    public function isPropagationStopped(): bool
    {
        return $this->propagationStopped;
    }

    /**
     * Retrieves the payload of the event.
     *
     * @return mixed The payload of the event.
     */
    public function getPayload(): mixed
    {
        return $this->payload;
    }
}
