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
             'server_side_url' => ['url','nullable'],

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
               'title' => 'Data Layer Listener',
               'properties' => 'data_layer_listener_enabled',
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

    protected function help()
    {
        return [
            'data_layer_listener_enabled' => "Check to inject elevar code.",
            'server_side_url' => 'Enter URL or Leave blank for null',
        ];
    }
}
