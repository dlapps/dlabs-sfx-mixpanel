<?php
declare(strict_types = 1);

namespace DL\MixpanelBundle\Service;

/**
 * Exposes the Mixpanel API into the rest of the Symfony ecosystem.
 *
 * @package DL\MixpanelBundle\Service
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
class MixpanelService
{
    /**
     * The token used when communicating with Mixpanel.
     *
     * @var string
     */
    protected $token;

    /**
     * The options that should be specified for the Mixpanel client.
     *
     * @var array
     */
    protected $options;

    /**
     * The Mixpanel instance used when communicating to the API.
     *
     * @var \Mixpanel
     */
    protected $instance;

    /**
     * MixpanelService constructor.
     *
     * @param string $token
     * @param array  $options
     */
    public function __construct(string $token, array $options)
    {
        $this->token   = $token;
        $this->options = $options;
    }

    /**
     * Retrieve an instance of the Mixpanel client.
     *
     * @return \Mixpanel
     */
    public function getClient(): \Mixpanel
    {
        if (null === $this->instance) {
            $this->instance = $this->initialiseInstance();
        }

        return $this->instance;
    }

    /**
     * Initialise a new instance of the Mixpanel client.
     *
     * @return \Mixpanel
     */
    private function initialiseInstance(): \Mixpanel
    {
        return new \Mixpanel($this->token, $this->options);
    }
}
