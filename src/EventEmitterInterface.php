<?php

namespace Iceylan\Eventor;

/**
 * Interface for an event emitter.
 */
interface EventEmitterInterface
{
	/**
	 * Registers an event listener.
	 *
	 * @param string $event
	 * @param callable $listener
	 * @param integer $priority
	 * @return void
	 */
    public function on(string $event, callable $listener, int $priority = 0): void;

	/**
	 * Registers an event listener once.
	 *
	 * @param string $event
	 * @param callable $listener
	 * @param integer $priority
	 * @return void
	 */
    public function once(string $event, callable $listener, int $priority = 0): void;

	/**
	 * Unregisters an event listener.
	 *
	 * @param string $event
	 * @param callable $listener
	 * @return void
	 */
    public function off(string $event, callable $listener): void;

	/**
	 * Triggers an event.
	 *
	 * @param string $event
	 * @param mixed $payload
	 * @return array
	 */
    public function trigger(string $event, mixed $payload = null): array;
}
