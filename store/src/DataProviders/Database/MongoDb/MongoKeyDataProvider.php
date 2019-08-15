<?php
declare(strict_types=1);


namespace Example\Store\DataProviders\Database\MongoDb;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ODM\MongoDB\DocumentManager;
use Example\Store\DataProviders\Database\MongoDb\Assemblers\EntryAssembler;
use Example\Store\Domain\Entities\Key;
use Example\Store\DataProviders\Database\MongoDb\Key as MongoKey;
use Example\Store\Domain\UseCases\DataProviderDefinitions\KeyDataProvider;
use DateTime;

/**
 * @package Example\Store\DataProviders\Database\MongoDb
 */
class MongoKeyDataProvider implements KeyDataProvider
{
    /**
     * @var DocumentManager
     */
    private $documentManager;

    /**
     * @var EntryAssembler
     */
    private $assembler;

    public function __construct(DocumentManager $documentManager, EntryAssembler $assembler)
    {
        $this->documentManager = $documentManager;
        $this->assembler = $assembler;
    }

    public function save(Key $entry, int $expireIn): void
    {
        $mongoKey = $this->assembler->domainEntryToDoctrine($entry);
        if ($expireIn > 0) {
            $mongoKey->setExpiresAt(new DateTime(sprintf('@%d', time() + $expireIn)));
        }
        $this->documentManager->persist($mongoKey);
        $this->documentManager->flush();
    }

    public function findById($id): ?Key
    {
        $mongoKey = $this->getRepository()->find($id);
        return $mongoKey ? new Key($mongoKey->getId(), $mongoKey->getValue()) : null;
    }

    public function deleteById($id): bool
    {
        $key = $this->getRepository()->find($id);
        if (!$key) {
            return false;
        }
        $this->documentManager->remove($key);
        $this->documentManager->flush();

        return true;
    }

    public function deleteAll(): void
    {
        $keys = new ArrayCollection($this->getRepository()->findAll());

        $keys->map(function (MongoKey $key) {
            $this->documentManager->remove($key);
        });

        $this->documentManager->flush();
    }

    public function findAll(): ArrayCollection
    {
        $resultCollection = new ArrayCollection($this->getRepository()->findAll());
        $keys = $resultCollection->map(static function (MongoKey $value) {
            return new Key($value->getId(), $value->getValue());
        });
        return $keys;
    }

    private function getRepository(): ObjectRepository
    {
        return $this->documentManager->getRepository(MongoKey::class);
    }
}
