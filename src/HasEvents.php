<?php

namespace Iceylan\Eventor;

/**
 * Trait HasEvents.
 */
trait HasEvents
{
	/**
	 * The event listeners.
	 *
	 * @var array
	 */
    protected array $listeners = [];

    /**
     * Registers an event listener.
     *
     * @param string $event
     * @param callable $listener
     * @param int $priority
     * @return self
     */
    public function on( string $event, callable $listener, int $priority = 0 ): self
    {
        $this->listeners[ $event ][] =
		[
            'listener' => $listener,
            'priority' => $priority,
            'once' => false,
        ];

        return $this;
    }

    /**
     * Registers an event listener to only be executed once.
     *
     * @param string $event
     * @param callable $listener
     * @param int $priority
     * @return self
     */
    public function once( string $event, callable $listener, int $priority = 0 ): self
    {
        $this->listeners[ $event ][] =
		[
            'listener' => $listener,
            'priority' => $priority,
            'once' => true,
        ];

        return $this;
    }

    /**
     * Removes an event listener.
     *
     * @param string $event
     * @param callable $listener
     * @return self
     */
    public function off( string $event, callable $listener ): self
    {
        if( empty( $this->listeners[ $event ]))
		{
            return $this;
        }

        $this->listeners[ $event ] = array_filter(
            $this->listeners[ $event ],
            fn( $entry ) => $entry[ 'listener' ] !== $listener
        );

        if( empty( $this->listeners[ $event ]))
		{
            unset( $this->listeners[ $event ]);
        }

        return $this;
    }

    /**
     * Triggers an event.
     *
     * @param string $event
     * @param mixed $payload
     * @return array
     */
    public function trigger( string $event, mixed $payload = null ): array
    {
        if( empty( $this->listeners[ $event ]))
		{
            return [];
        }

        usort( $this->listeners[ $event ], function( $a, $b )
		{
            return $b[ 'priority' ] <=> $a[ 'priority' ];
        });

        $results = [];
        $eventObj = new Event( $payload );

        foreach( $this->listeners[ $event ] as $key => $entry )
		{
            $result = ( $entry[ 'listener' ])( $eventObj );
            $results[] = $result;

            if( $entry[ 'once' ])
			{
                unset( $this->listeners[ $event ][ $key ]);
            }

            if( $eventObj->isPropagationStopped())
			{
                break;
            }
        }

        $this->listeners[ $event ] = array_values( $this->listeners[ $event ]);

        return $results;
    }
}
