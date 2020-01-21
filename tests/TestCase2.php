<?php


namespace stonkeep\ModelFields\Tests;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Facade;
use stonkeep\ModelFields\ModelFieldsBaseServiceProvider;

class TestCase2 extends \Orchestra\Testbench\TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        $app = new Container();
        $app->singleton('app', 'Illuminate\Container\Container');

        /**
         * Set $app as FacadeApplication handler
         */
        Facade::setFacadeApplication($app);


        $this->configureDatabase();
        $this->migrateIdentitiesTable();
    }

    protected function configureDatabase()
    {
        $db = new DB;
        $db->addConnection(array(
            'driver'    => 'sqlite',
            'database'  => ':memory:',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ));
        $db->setAsGlobal();
        $db->bootEloquent();
    }

    public function migrateIdentitiesTable()
    {
        DB::schema()->create('user', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('login');
            $table->string('password');
            $table->timestamps();
        });

        User::create([
            'name' => 'User Name',
            'login' => 'Login',
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        ]);

    }
    protected function getPackageProviders($app)
    {
        return [
            ModelFieldsBaseServiceProvider::class,
        ];
    }

}
