<?php

namespace Illuminate\Foundation;

//use Closure;
//use RuntimeException;
//use Illuminate\Support\Arr;
//use Illuminate\Support\Str;
use Illuminate\Http\Request;
//use Illuminate\Support\Collection;
use Illuminate\Container\Container;
//use Illuminate\Filesystem\Filesystem;
//use Illuminate\Log\LogServiceProvider;
//use Illuminate\Support\ServiceProvider;
//use Illuminate\Events\EventServiceProvider;
//use Illuminate\Routing\RoutingServiceProvider;
use Symfony\Component\HttpKernel\HttpKernelInterface;
//use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Contracts\Http\Kernel as HttpKernelContract;
//use Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;
//use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Contracts\Foundation\Application as ApplicationContract;

class Application extends Container implements ApplicationContract, HttpKernelInterface
{
    /**↓↓↓↓↓ 非继承 ↓↓↓↓↓**/

    const VERSION = '5.5.19';                   // The Laravel framework version.

    protected $basePath;                        // The base path for the Laravel installation.
    protected $monologConfigurator;             // A custom callback used to configure Monolog.
    protected $databasePath;                    // The custom database path defined by the developer.
    protected $storagePath;                     // The custom storage path defined by the developer.
    protected $environmentPath;                 // The custom environment path defined by the developer.
    protected $namespace;                       // The application namespace.
    protected $hasBeenBootstrapped  = false;    // Indicates if the application has been bootstrapped before.
    protected $booted               = false;    // Indicates if the application has "booted".
    protected $bootingCallbacks     = [];       // The array of booting callbacks.
    protected $bootedCallbacks      = [];       // The array of booted callbacks.
    protected $terminatingCallbacks = [];       // The array of terminating callbacks.
    protected $serviceProviders     = [];       // All of the registered service providers.
    protected $loadedProviders      = [];       // The names of the loaded service providers.
    protected $deferredServices     = [];       // The deferred services and their providers.
    protected $environmentFile      = '.env';   // The environment file to load during bootstrapping.

    /**
     * Create a new Illuminate application instance.
     *
     * @param  string|null  $basePath
     * @return void
     */
    public function __construct ($basePath = null)
    {
        if ($basePath)
        {
            $this->setBasePath($basePath);
        }
    }

    /**
     * Set the base path for the application.
     *
     * @param  string  $basePath
     * @return $this
     */
    public function setBasePath($basePath)
    {
        $this->basePath = rtrim($basePath, '\/');
        $this->bindPathsInContainer();

        return $this;
    }

    /**
     * Bind all of the application paths in the container.
     *
     * @return void
     */
    protected function bindPathsInContainer()
    {
        echo $this->instance('path', $this->path());
        die();
//        $this->instance('path.base', $this->basePath());
//        $this->instance('path.lang', $this->langPath());
//        $this->instance('path.config', $this->configPath());
//        $this->instance('path.public', $this->publicPath());
//        $this->instance('path.storage', $this->storagePath());
//        $this->instance('path.database', $this->databasePath());
//        $this->instance('path.resources', $this->resourcePath());
//        $this->instance('path.bootstrap', $this->bootstrapPath());
    }

    /**
     * Get the path to the application "app" directory.
     *
     * @param string $path Optionally, a path to append to the app path
     * @return string
     */
    public function path($path = '')
    {
        return $this->basePath . DIRECTORY_SEPARATOR. 'app' . ($path ? DIRECTORY_SEPARATOR.$path : $path);
    }


    /**↑↑↑↑↑ 非继承 ↑↑↑↑↑**/

    /**↓↓↓↓↓ Application implements functions ↓↓↓↓↓**/
    public function version(){}
    public function basePath(){}
    public function environment(){}
    public function runningInConsole(){}
    public function isDownForMaintenance(){}
    public function registerConfiguredProviders(){}
    public function register($provider, $options = [], $force = false){}
    public function registerDeferredProvider($provider, $service = null){}
    public function boot(){}
    public function booting($callback){}
    public function booted($callback){}
    public function getCachedServicesPath(){}
    public function getCachedPackagesPath(){}
    /**↑↑↑↑↑ Application implements functions ↑↑↑↑↑**/


    /**↓↓↓↓↓ HttpKernel implements functions ↓↓↓↓↓**/
    /**
     * {@inheritdoc}
     */
    public function handle(SymfonyRequest $request, $type = self::MASTER_REQUEST, $catch = true)
    {
        return $this[HttpKernelContract::class]->handle(Request::createFromBase($request));
    }
    /**↑↑↑↑↑ HttpKernel implements functions ↑↑↑↑↑**/
}