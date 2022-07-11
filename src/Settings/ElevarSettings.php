<?php

namespace Astrogoat\Elevar\Settings;

use Astrogoat\Elevar\Actions\ElevarAction;
use Helix\Lego\Settings\AppSettings;
use Illuminate\Validation\Rule;

class ElevarSettings extends AppSettings
{
     public string $uuid;

    public function rules(): array
    {
        return [
             'uuid' => Rule::requiredIf($this->enabled === true),
        ];
    }

    public function description(): string
    {
        return 'Interact with Elevar.';
    }

    public static function group(): string
    {
        return 'elevar';
    }
}
