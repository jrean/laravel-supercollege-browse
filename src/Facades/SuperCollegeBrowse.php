<?php
/**
 * This file is part of Jrean\SuperCollegeBrowse package.
 *
 * (c) Jean Ragouin <go@askjong.com> <www.askjong.com>
 */
namespace Jrean\SuperCollegeBrowse\Facades;

use Illuminate\Support\Facades\Facade;

class SuperCollegeBrowse extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'supercollege-browse';
    }
}
