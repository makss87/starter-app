<?php

namespace Core;


class AppConfig
{
    /**
     * @var array
     */
    private $configuration;

    /**
     * AppConfig constructor.
     * @param $configuration
     */
    public function __construct(array $configuration)
    {
        $this->configuration = $configuration;
    }

    public function get($key)
    {
        return $this->configuration[$key] ?? '';
    }
}