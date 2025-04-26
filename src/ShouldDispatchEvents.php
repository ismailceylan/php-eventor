<?php

namespace Iceylan\Eventor;

/**
 * Interface for an event emitter.
 */
interface ShouldDispatchEvents
{
	/**
	 * Registers an event listener.
	 *
	 * @param string $event
	 * @param callable $listener
	 * @param integer $priority
	 * @return self
	 */
    public function on( string $event, callable $listener, int $priority = 0 ): self;

	/**
	 * Registers an event listener once.
	 *
	 * @param string $event
	 * @param callable $listener
	 * @param integer $priority
	 * @return self
	 */
    public function once( string $event, callable $listener, int $priority = 0 ): self;

	/**
	 * Unregisters an event listener.
	 *
	 * @param string $event
	 * @param callable $listener
	 * @return self
	 */
    public function off( string $event, callable $listener ): self;

	/**
	 * Triggers an event.
	 *
	 * @param string $event
	 * @param mixed $payload
	 */
    public function trigger( string $event, mixed $payload = null ): array;
}
