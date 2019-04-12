<?php declare(strict_types = 1);

namespace Tests\AppBundle\Util;

use AppBundle\Util\UniqueNameGenerator;
use PHPUnit\Framework\TestCase;

class UniqueNameGeneratorTest extends TestCase
{
    public function testGenerateUniqueFileName()
    {
        $uniqueNameGenerator = new UniqueNameGenerator();
        $fileName = $uniqueNameGenerator->generateUniqueFileName();

        $this->assertEquals(32, strlen($fileName));
    }
}
