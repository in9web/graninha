<?php
/**
 * Slim Framework (http://slimframework.com)
 *
 * @link      https://github.com/slimphp/Twig-View
 * @copyright Copyright (c) 2011-2015 Josh Lockhart
 * @license   https://github.com/slimphp/Twig-View/blob/master/LICENSE.md (MIT License)
 */
namespace App;

class TwigExtension extends \Twig_Extension
{
    /**
     * @var \Slim\Interfaces\RouterInterface
     */
    private $router;

    /**
     * @var string|\Slim\Http\Uri
     */
    private $uri;

    public function __construct($router, $uri)
    {
        $this->router = $router;
        $this->uri = $uri;
    }

    public function getName()
    {
        return 'slimex';
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('template_url', array($this, 'templateUrl')),
            new \Twig_SimpleFunction('show_message', 'show_message'),
        ];
    }

    public function templateUrl($uri='')
    {
        if (is_string($this->uri)) {
            return $this->uri.TEMPLATE_URI.$uri;
        }
        if (method_exists($this->uri, 'getBaseUrl')) {
            return $this->uri->getBaseUrl().TEMPLATE_URI.$uri;
        }
    }

    public static function getTemplateVars($vars=array())
    {
        $def = array(
            'template_url' => TEMPLATE_URI,
            'page_title' => 'Home',
        );
        return array_merge($def, $vars);
    }
}
