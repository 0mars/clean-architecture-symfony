<?php
declare(strict_types=1);


namespace Example\Store\Domain\Entities;

class Key
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $value;

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
}
