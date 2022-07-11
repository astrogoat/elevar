<?php

namespace Astrogoat\Elevar;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Astrogoat\Elevar\Elevar
 */
class ElevarFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'elevar';
    }
}
