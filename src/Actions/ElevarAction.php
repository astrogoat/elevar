<?php

namespace Astrogoat\Elevar\Actions;

use Helix\Lego\Apps\Actions\Action;

class ElevarAction extends Action
{
    public static function actionName(): string
    {
        return 'Elevar action name';
    }

    public static function run(): mixed
    {
        return redirect()->back();
    }
}
