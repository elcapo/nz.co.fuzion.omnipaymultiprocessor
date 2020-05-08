<?php

namespace Webmozart\Assert\Tests\StaticAnalysis;

use Webmozart\Assert\Assert;

class NotA {}
class NotB {}

/**
 * @psalm-pure
 * @param NotA|NotB $value
 */
function consume($value): NotA
{
    Assert::notInstanceOf($value, NotB::class);

    return $value;
}
