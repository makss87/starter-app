<?php

use App\Http\Request;
use Core\Session\SessionManager;
use Illuminate\Container\Container;
use Illuminate\View\Factory;
use Symfony\Component\VarDumper\VarDumper;

if ( !function_exists('config')) {
    /**
     * Easy access to config vars
     * @param $key
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    function config($key)
    {
        $config = Container::getInstance()->make('config');

        return $config->get($key);
    }
}

if ( !function_exists('url')) {

    /**
     * Builds ur;s relative to current root
     * @param $path
     * @return string
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    function url($path)
    {
        $path = trim($path, '/');

        $root = config('website_root') ? '/' . config('website_root') : '';

        return $root . '/' . $path;
    }
}

if ( !function_exists('dd')) {
    /**
     * Convenient dumping tool to debug
     * @param mixed ...$vars
     */
    function dd(...$vars)
    {
        foreach ($vars as $v) {
            VarDumper::dump($v);
        }

        die(1);
    }
}

if ( !function_exists('view')) {

    /**
     * View helper
     * @param null $view
     * @param array $data
     * @param array $mergeData
     * @return Factory
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    function view($view = null, $data = [], $mergeData = [])
    {
        /** @var $factory Factory $factory */
        $factory = Container::getInstance()->make('view');

        if (func_num_args() === 0) {
            return $factory;
        }

        echo $factory->make($view, $data, $mergeData);
    }
}
if ( !function_exists('request')) {

    /**
     * Easy access for request params
     * @param null $key
     * @return mixed
     */
    function request($key = null)
    {
        $session = Container::getInstance()->make(Request::class);

        if (is_null($key)) {
            return $session;
        }

        return $session->get($key);
    }
}
if ( !function_exists('session')) {

    /**
     * @param null $key
     * @return SessionManager
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    function session($key = null)
    {
        $session = Container::getInstance()->make(SessionManager::class);

        if (is_null($key)) {
            return $session;
        }

        return $session->get($key);
    }
}
if ( !function_exists('app')) {

    /**
     * Easy access for container bindings
     * @param null $containerItem
     * @return Container|mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    function app($containerItem = null)
    {
        if (is_null($containerItem)) {
            return Container::getInstance();
        }

        return Container::getInstance()->make($containerItem);
    }
}
if ( !function_exists('str_random')) {

    function str_random($length = 16)
    {
        $string = '';

        while (($len = strlen($string)) < $length) {
            $size = $length - $len;

            $bytes = random_bytes($size);

            $string .= substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $size);
        }

        return $string;
    }
}

if ( !function_exists('sortLink')) {

    /**
     * Helper to create sorting links
     * @param $param
     * @return string
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    function sortLink($param)
    {
        $directions = ['asc', 'desc'];
        $query      = request()->query;
        $direction  = 0;

        if ($query->has('sort_by') && $query->get('sort_by') == $param) {
            $direction = !array_search(request('sort_dir'), $directions);
        }

        $data = request()->all();

        $data['sort_by']  = $param;
        $data['sort_dir'] = $directions[$direction];

        $string = '?' . http_build_query($data);
        $arrow  = $direction ? 'up' : 'down';


        return '<a href="' . $string . '">
                 <i class="fa fa-arrow-' . $arrow . '" aria-hidden="true"></i>
        </a>';
    }
}

if ( !function_exists('str_limit')) {
    /**
     * Limit the number of characters in a string.
     *
     * @param string $value
     * @param int $limit
     * @param string $end
     * @return string
     */
    function str_limit($value, $limit = 100, $end = '...')
    {
        if (mb_strwidth($value, 'UTF-8') <= $limit) {
            return $value;
        }

        return rtrim(mb_strimwidth($value, 0, $limit, '', 'UTF-8')) . $end;
    }
}