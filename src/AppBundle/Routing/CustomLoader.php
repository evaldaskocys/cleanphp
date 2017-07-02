<?php

namespace AppBundle\Routing;

use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

/**
 * Class CustomLoader
 *
 * @package AppBundle\Routing
 */
class CustomLoader extends Loader
{
    /**
     * @var bool
     */
    private $loaded = false;

    /**
     * @param mixed $resource
     * @param null  $type
     * @return RouteCollection
     */
    public function load($resource, $type = null)
    {
        if (true === $this->loaded) {
            throw new \RuntimeException('Do not add the "custom" loader twice');
        }

        $routes = new RouteCollection();

        $path = '/homepage';
        $defaults = [
            '_controller' => 'AppBundle:Default:index',
        ];

        $route = new Route($path, $defaults);

        $routeName = 'app_custom_homepage';
        $routes->add($routeName, $route);

        $this->loaded = true;

        return $routes;
    }

    /**
     * @param mixed $resource
     * @param null  $type
     * @return bool
     */
    public function supports($resource, $type = null)
    {
        return 'custom' === $type;
    }
}
