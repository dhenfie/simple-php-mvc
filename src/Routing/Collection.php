<?php

namespace System\Routing;

use System\Routing\Interfaces\RouteCollectionInterface;

/**
 * RouteColletion
 *
 * @author dhenfie <fajarsusilo1600@gmail.com>
 * @version 1.0.0
 */

class Collection implements RouteCollectionInterface
{

	private array $routes;

	public function __construct()
	{
		$this->routes = [];
	}

	private function isExist(string $path) : bool
	{
		$routePath = array_column($this->getRoutes(), '_path');
		return in_array($path, $routePath);
	}

	public function add(string $path, string $handler) : RouteCollectionInterface
	{
		if (! $this->isExist($path)) {
			$path           = ($path === '/') ? $path : trim($path, '/');
			$this->routes[] = ['_path' => $path, '_handler' => $handler];
			return $this;
		}
		return $this;
	}

	public function setError(string $handler) : void
	{
		$this->add('_error', $handler);
	}


	public function getRoutes() : array
	{
		return $this->routes;
	}

	public function reset() : void
	{
		$this->routes = [];
	}
}
