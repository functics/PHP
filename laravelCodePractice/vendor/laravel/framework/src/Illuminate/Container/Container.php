<?php

namespace Illuminate\Container;

use Closure;
use ArrayAccess;
//use LogicException;
//use ReflectionClass;
//use ReflectionParameter;
//use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Container\Container as ContainerContract;

class Container implements ArrayAccess, ContainerContract
{

    protected static $instance;                    // The current globally available container (if any).
    protected $resolved                      = []; // An array of the types that have been resolved.
    protected $bindings                      = []; // The container's bindings.
    protected $methodBindings                = []; //
    protected $instances                     = []; // The container's shared instances.
    protected $aliases                       = []; // The registered type aliases.
    protected $abstractAliases               = []; // The registered aliases keyed by the abstract name.
    protected $extenders                     = []; // The extension closures for services.
    protected $tags                          = []; // All of the registered tags.
    protected $buildStack                    = []; // The stack of concretions currently being built.
    protected $with                          = []; // The parameter override stack.
    protected $reboundCallbacks              = []; // All of the registered rebound callbacks.
    protected $globalResolvingCallbacks      = []; // All of the global resolving callbacks.
    protected $globalAfterResolvingCallbacks = []; // All of the global after resolving callbacks.
    protected $resolvingCallbacks            = []; // All of the resolving callbacks by class type.
    protected $afterResolvingCallbacks       = []; // All of the after resolving callbacks by class type.

    public $contextual = []; // The contextual binding map.

    /**↓↓↓↓↓ 非继承 ↓↓↓↓↓**/

    /**
     * Remove an alias from the contextual binding alias cache.
     *
     * @param  string  $searched
     * @return void
     */
    protected function removeAbstractAlias($searched)
    {
        if (! isset($this->aliases[$searched])) {
            return;
        }

        foreach ($this->abstractAliases as $abstract => $aliases) {
            foreach ($aliases as $index => $alias) {
                if ($alias == $searched) {
                    unset($this->abstractAliases[$abstract][$index]);
                }
            }
        }
    }

    /**
     * Determine if a given string is an alias.
     *
     * @param  string  $name
     * @return bool
     */
    public function isAlias($name)
    {
        return isset($this->aliases[$name]);
    }

    /**↑↑↑↑↑ 非继承 ↑↑↑↑↑**/

    /**↓↓↓↓↓ ArrayAccess implements functions ↓↓↓↓↓**/
    public function offsetExists($offset){}
    public function offsetGet($offset){}
    public function offsetSet($offset, $value){}
    public function offsetUnset($offset){}
    /**↑↑↑↑↑ ArrayAccess implements functions ↑↑↑↑↑**/





    /**↓↓↓↓↓ ContainerContract implements functions ↓↓↓↓↓**/

    /**
     * Determine if the given abstract type has been bound.
     *
     * @param  string  $abstract
     * @return bool
     */
    public function bound($abstract)
    {
        return isset($this->bindings[$abstract])  ||
               isset($this->instances[$abstract]) ||
               $this->isAlias($abstract);
    }

    public function alias($abstract, $alias){}
    public function tag($abstract, $tags){}
    public function tagged($tag){}
    public function bind($abstract, $concrete = null, $shard = false){}
    public function bindIf($abstract, $concrete = null, $shard = false){}
    public function singleton($abstract, $concrete = null){}
    public function extend($abstract, Closure $closure){}

    /**
     * Register an existing instance as shared in the container.
     *
     * @param  string  $abstract
     * @param  mixed   $instance
     * @return mixed
     */
    public function instance($abstract, $instance)
    {
        $this->removeAbstractAlias($abstract);

        $isBound = $this->bound($abstract);

        unset($this->aliases[$abstract]);

        // We'll check to determine if this type has been bound before, and if it has
        // we will fire the rebound callbacks registered with the container and it
        // can be updated with consuming classes that have gotten resolved here.
        $this->instances[$abstract] = $instance;

        print_r($this->instances);
        die();//2017-11-8

        if ($isBound) {
            $this->rebound($abstract);
        }

        return $instance;
    }

    public function when(){}
    public function factory($abstract){}
    public function make($abstract, array $parameters = []){}
    public function call($callback, array $parameters = [], $defaultMethod = null){}
    public function resolved($abstract){}
    public function resolving($abstract, Closure $callback = null){}
    public function afterResolving($abstract, Closure $callback = null){}
    public function get($id){}
    public function has($id){}
    /**↑↑↑↑↑ ContainerContract implements functions ↑↑↑↑↑**/


}