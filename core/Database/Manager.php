<?php

namespace Core\Database;

use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use function Symfony\Component\String\s;

class Manager
{

    /** @var Capsule  */
    protected $capsule;

    /**
     * Eloquent constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->capsule = new Capsule;
        $this->capsule->addConnection([
            "driver"   => "mysql",
            "host"     => $config['host'],
            "database" => $config['name'],
            "username" => $config['username'],
            "password" => $config['password'],
        ]);

        $this->capsule->setAsGlobal();
        $this->capsule->setEventDispatcher(new Dispatcher(new Container));
        $this->capsule->bootEloquent();

    }

    /**
     * @return Capsule
     */
    public function capsule()
    {
        return $this->capsule;
    }

    public function schema()
    {
        return $this->capsule->schema();
    }
}