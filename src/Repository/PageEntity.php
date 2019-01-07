<?php

declare(strict_types=1);

namespace Pages\Repository;

use RpkUtils\Oop\Abstracts\Entity;

class PageEntity extends Entity
{
    protected $_data = [
        'Id'                    => null,
        'Name'                  => null,
        'Content'               => null,
        'Head'                  => null,
        'StaticPage'            => null,
        'Crawlable'             => null,
        'Category'              => null,
        'Details'               => null,
        'FullPage'              => null,
        'Status'                => null,
        'Timestamp'             => null,
    ];
}