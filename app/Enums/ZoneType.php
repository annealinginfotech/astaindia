<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ZoneType extends Enum
{
    const HEADQUARTERS  =   'headquarters';
    const ADMIN         =   'admin';
    const STATE         =   'state';
    const DISTRICT      =   'district';
    const BRANCH        =   'branch';
    const UNIT          =   'unit';
}
