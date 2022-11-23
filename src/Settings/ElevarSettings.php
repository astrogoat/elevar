<?php

namespace Astrogoat\Elevar\Settings;

use Helix\Lego\Settings\AppSettings;
use Illuminate\Validation\Rule;

class ElevarSettings extends AppSettings
{
    public string $uuid;
    public string $server_side_url;

    public function rules(): array
    {
        return [

             'uuid' => Rule::requiredIf($this->enabled === true),
             'server_side_url' => ['nullable'],

        ];
    }


    public function description(): string
    {
        return 'Interact with Elevar.';
    }

    public function sections()
    {
        return [
           [
               'title' => 'Key',
               'properties' => 'uuid',
           ],
           [
               'title' => 'Server Side',
               'properties' => 'server_side_url',
           ],
        ];
    }

    public static function group(): string
    {
        return 'elevar';
    }
}
