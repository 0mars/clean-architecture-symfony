<?php
declare(strict_types=1);


namespace Example\Store\DataProviders\Database\MongoDb;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use DateTime;

/**
 * @ODM\Document(
 *   collection="keys",
 *   indexes={
 *     @ODM\Index(
 *          keys={"expiresAt"=true},
 *          options={"expireAfterSeconds": 0},
 *          partialFilterExpression={"expiresAt"={"$ne"=null}}
 *     )
 *   }
 * )
 *
 * @package Example\Store\DataProviders\Database\MongoDb
 */
class Key
{
    /**
     * @ODM\Id(strategy="NONE", type="string")
     *
     * @var string
     */
    private $id;

    /**
     * @ODM\Field(type="string")
     *
     * @var string
     */
    private $value;

    /**
     * @ODM\Field(type="date")
     *
     * @var DateTime
     */
    private $expiresAt;

    public function __construct(string $id, string $value)
    {
        $this->id = $id;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param DateTime $expiresAt
     */
    public function setExpiresAt(DateTime $expiresAt): void
    {
        $this->expiresAt = $expiresAt;
    }
}
