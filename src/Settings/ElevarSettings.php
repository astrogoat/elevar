<?php

namespace Astrogoat\Elevar\Settings;

use Helix\Lego\Settings\AppSettings;
use Illuminate\Validation\Rule;

class ElevarSettings extends AppSettings
{
    public string $uuid;
    public bool $data_layer_listener_enabled;
    public string $server_side_url;

    public function rules(): array
    {
        return [

             'uuid' => Rule::requiredIf($this->enabled === true),
             'data_layer_listener_enabled' => 'boolean',
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
               'title' => 'Data Layer',
               'properties' => ['data_layer_listener_enabled', 'uuid', 'server_side_url'],
           ],
        ];
    }

    protected function labels(): array
    {
        return [
            'data_layer_listener_enabled' => 'Enable Elevar Data Layer',
            'uuid' => 'Key (UUID)',
            'server_side_url' => 'Server side URL',
        ];
    }

    public static function group(): string
    {
        return 'elevar';
    }

    protected function help()
    {
        return [
            'server_side_url' => 'Enter server side URL if you have one.',
        ];
    }
}
