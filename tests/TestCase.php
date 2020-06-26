<?php

namespace EolabsIo\AmazonMws\Tests;

use EolabsIo\AmazonMwsClient\AmazonMwsClientServiceProvider;
use EolabsIo\AmazonMwsResponseParser\AmazonMwsResponseParserServiceProvider;
use EolabsIo\AmazonMws\AmazonMwsServiceProvider;
use EolabsIo\AmazonMws\Tests\Factories\AmazonConstantsFactory;
use Illuminate\Support\Facades\Event;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{

    protected function setUp(): void
    {
        parent::setUp();
        
        $vendorPath = '/vendor/eolabs-io/amazon-mws-client';

        $this->loadMigrationsFrom(realpath(dirname(__DIR__) . $vendorPath .'/database/migrations'));
        $this->withFactories(realpath(dirname(__DIR__) . $vendorPath .'/database/factories'));

        $this->loadMigrationsFrom(realpath(dirname(__DIR__) .'/database/migrations'));
        $this->withFactories(realpath(dirname(__DIR__) .'/database/factories'));

        Event::fake();
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('amazon-mws.constants', AmazonConstantsFactory::getAll() );
    }

    /**
     * Get package providers.  At a minimum this is the package being tested, but also
     * would include packages upon which our package depends, e.g. Cartalyst/Sentry
     * In a normal app environment these would be added to the 'providers' array in
     * the config/app.php file.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            AmazonMwsServiceProvider::class,
            AmazonMwsClientServiceProvider::class,
            AmazonMwsResponseParserServiceProvider::class,
        ];
    }
    /**
     * Get package aliases.  In a normal app environment these would be added to
     * the 'aliases' array in the config/app.php file.  If your package exposes an
     * aliased facade, you should add the alias here, along with aliases for
     * facades upon which your package depends, e.g. Cartalyst/Sentry.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    // protected function getPackageAliases($app)
    // {
    //     return [
    //         // 'Sentry' => 'Cartalyst\Sentry\Facades\Laravel\Sentry',
    //     ];
    // }

}
