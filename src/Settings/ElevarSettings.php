<?php

namespace Astrogoat\Elevar\Settings;

use Helix\Lego\Settings\AppSettings;
use Illuminate\Validation\Rule;

class ElevarSettings extends AppSettings
{
    public string $uuid;
    public string $server_side_url;
    public bool $server_side_enable;

    public function rules(): array
    {
        return [

             'uuid' => Rule::requiredIf($this->enabled === true),
             'server_side_enable' => ['boolean'],
             'server_side_url' => Rule::requiredIf($this->server_side_enable === true),

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
               'properties' => ['server_side_enable','server_side_url'],
           ],
        ];
    }

    public static function group(): string
    {
        return 'elevar';
    }

    protected function help()
    {

        return [
            'server_side_enable' => 'This will enable the server side option.',
        ];
    }
}
