<?php declare(strict_types = 1);

namespace AppBundle\Util;

/**
 * Class UniqueNameGenerator
 * @package AppBundle\Util
 */
class UniqueNameGenerator
{
    /**
     * @return string
     */
    public function generateUniqueFileName(): string
    {
        return md5(uniqid());
    }
}
