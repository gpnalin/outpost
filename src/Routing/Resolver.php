<?php

namespace Outpost\Routing;

use Outpost\SiteInterface;
use Symfony\Component\HttpFoundation\Request;

class Resolver implements ResolverInterface {

  /**
   * @var Request
   */
  protected $request;

  /**
   * @var SiteInterface
   */
  protected $site;

  /**
   * @param SiteInterface $site
   * @param Request $request
   */
  public function __construct(SiteInterface $site, Request $request) {
    $this->site = $site;
    $this->request = $request;
  }

  public function getRequest() {
    return $this->request;
  }

  /**
   * @param $route
   * @return array
   */
  public function resolve($route) {
    if ($route instanceof RouteInterface) {
      $route = new Response($this->site, $this->request, $route->getResponder());
    }
    return $route;
  }
}