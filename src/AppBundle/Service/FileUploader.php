<?php declare(strict_types = 1);

namespace AppBundle\Service;

use AppBundle\Util\UniqueNameGenerator;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class FileUploader
 * @package AppBundle\Service
 */
class FileUploader
{
    /**
     * @var UniqueNameGenerator
     */
    private $uniqueNameGenerator;

    /**
     * FileUploader constructor.
     * @param UniqueNameGenerator $uniqueNameGenerator
     */
    public function __construct(UniqueNameGenerator $uniqueNameGenerator)
    {
        $this->uniqueNameGenerator = $uniqueNameGenerator;
    }

    /**
     * @param string $targetDirectory
     * @param UploadedFile $file
     * @return string
     */
    public function upload(string $targetDirectory, UploadedFile $file): string
    {
        $fileName = $this
                ->uniqueNameGenerator
                ->generateUniqueFileName() . '.' . $file->guessExtension();

        $file->move($targetDirectory, $fileName);

        return $fileName;
    }
}
