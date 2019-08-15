<?php


namespace Example\Store\EntryPoints\Rest\Resources;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     collectionOperations={
 *          "get"={
 *              "method"="GET",
 *              "path"="/keys",
 *              "controller"="Example\Store\EntryPoints\Rest\Endpoints\GetAllValues::execute",
 *              "swagger_context"= {
 *                  "summary"="Get All Values"
 *              }
 *          },
 *          "put"={
 *              "method"="PUT",
 *              "path"="/keys",
 *              "controller"="Example\Store\EntryPoints\Rest\Endpoints\SetValue::execute",
 *              "swagger_context"= {
 *                  "summary"="Set Value"
 *              }
 *          },
 *          "delete"={
 *              "method"="DELETE",
 *              "path"="/keys",
 *              "controller"="Example\Store\EntryPoints\Rest\Endpoints\DeleteAllValues::execute",
 *              "swagger_context"= {
 *                  "summary"="Delete All Values"
 *              }
 *          }
 *      },
 *     itemOperations={
 *          "get"={
 *              "method"="GET",
 *              "path"="/keys/{id}",
 *              "controller"="Example\Store\EntryPoints\Rest\Endpoints\GetValue::execute",
 *              "swagger_context"= {
 *                  "summary"="Get value",
 *                  "parameters" = {
 *                      {
 *                          "name" = "id",
 *                          "in" = "query",
 *                          "description" = "Key ID",
 *                          "required" = "true",
 *                          "type" : "string",
 *                      }
 *                  }
 *              }
 *          },
 *          "head"={
 *              "method"="HEAD",
 *              "path"="/keys/{id}",
 *              "controller"="Example\Store\EntryPoints\Rest\Endpoints\GetValue::execute",
 *              "swagger_context"= {
 *                  "summary"="Check if a value exists",
 *                  "parameters" = {
 *                      {
 *                          "name" = "id",
 *                          "in" = "query",
 *                          "description" = "Key ID",
 *                          "required" = "true",
 *                          "type" : "string",
 *                      }
 *                  }
 *              }
 *          },
 *          "delete"={
 *              "method"="DELETE",
 *              "path"="/keys/{id}",
 *              "controller"="Example\Store\EntryPoints\Rest\Endpoints\DeleteValue::execute",
 *              "swagger_context"= {
 *                  "summary"="Delete value",
 *                  "parameters" = {
 *                      {
 *                          "name" = "id",
 *                          "in" = "query",
 *                          "description" = "Key ID",
 *                          "required" = "true",
 *                          "type" : "string",
 *                      }
 *                  }
 *              }
 *          },
 *     },
 * )
 */
class Key
{
    /**
     * @param string $key
     *
     * @ApiProperty(
     *     identifier=true,
     *     attributes={
     *         "swagger_context"={"type"="string", "description"="Key ID"}
     *     }
     * )
     *
     * @Assert\NotBlank()
     * @Assert\Type("string")
     */
    private $id;

    /**
     * @var string
     *
     * @ApiProperty(
     *     attributes={
     *         "swagger_context"={"type"="string", "description"="Value"}
     *     }
     * )
     *
     * @Assert\NotBlank()
     * @Assert\Type("string")
     */
    private $value;

    /**
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value): void
    {
        $this->value = $value;
    }
}
