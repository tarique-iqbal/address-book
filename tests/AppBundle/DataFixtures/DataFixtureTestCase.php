<?php declare(strict_types = 1);

namespace Tests\AppBundle\DataFixtures;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\StringInput;

class DataFixtureTestCase extends WebTestCase
{
    protected static $application;

    protected $entityManager;

    public static function setUpBeforeClass()
    {
        self::runCommand('doctrine:database:create');
        self::runCommand('doctrine:schema:create');

        parent::setUpBeforeClass();
    }

    public function setUp()
    {
        self::runCommand('doctrine:fixtures:load --no-interaction');

        $client = static::createClient();
        $this->entityManager = $client
            ->getKernel()
            ->getContainer()
            ->get('doctrine')
            ->getManager();

        parent::setUp();
    }

    protected static function runCommand(string $command)
    {
        $command = sprintf('%s --quiet', $command);

        return self::getApplication()->run(new StringInput($command));
    }

    protected static function getApplication()
    {
        if (self::$application === null) {
            $client = static::createClient();

            self::$application = new Application($client->getKernel());
            self::$application->setAutoExit(false);
        }

        return self::$application;
    }

    protected function tearDown()
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null;
    }

    public static function tearDownAfterClass()
    {
        self::runCommand('doctrine:database:drop --force');

        parent::tearDownAfterClass();
    }
}
