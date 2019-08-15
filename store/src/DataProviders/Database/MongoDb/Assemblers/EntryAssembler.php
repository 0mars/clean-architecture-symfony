<?php
declare(strict_types=1);


namespace Example\Store\DataProviders\Database\MongoDb\Assemblers;

use Example\Store\Domain\Entities\Key;
use Example\Store\DataProviders\Database\MongoDb\Key as DoctrineEntry;

class EntryAssembler
{
    public function domainEntryToDoctrine(Key $entry)
    {
        return new DoctrineEntry($entry->getId(), $entry->getValue());
    }
}
