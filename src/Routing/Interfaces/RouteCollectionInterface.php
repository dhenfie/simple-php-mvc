<?php
namespace System\Routing\Interfaces;
use Closure;

interface RouteCollectionInterface {

    public function add(string $path, string $handler): RouteCollectionInterface;
    
    public function setError(string $handler): void;

    public function getRoutes(): array;

    public function reset(): void;
}

