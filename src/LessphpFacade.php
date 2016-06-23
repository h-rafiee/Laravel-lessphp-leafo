<?php
namespace Laravelless\Lessphp;
use Illuminate\Support\Facades\Facade;
class LessphpFacade extends Facade {
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'Lessphp'; }
}