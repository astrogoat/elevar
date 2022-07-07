<?php

namespace Astrogoat\Elevar\Settings;

use Helix\Lego\Settings\AppSettings;
use Illuminate\Validation\Rule;
use Astrogoat\Elevar\Actions\ElevarAction;

class ElevarSettings extends AppSettings
{
    // public string $url;

    public function rules(): array
    {
        return [
            // 'url' => Rule::requiredIf($this->enabled === true),
        ];
    }

    // protected static array $actions = [
    //     ElevarAction::class,
    // ];

    // public static function encrypted(): array
    // {
    //     return ['access_token'];
    // }

    public function description(): string
    {
        return 'Interact with Elevar.';
    }

    public static function group(): string
    {
        return 'elevar';
    }
}
