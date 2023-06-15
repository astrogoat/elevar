<?php

namespace Astrogoat\Elevar\Settings;

use Helix\Lego\Settings\AppSettings;
use Illuminate\Validation\Rule;

class ElevarSettings extends AppSettings
{
    public string $uuid;
    public bool $data_layer_listener_enabled;
    public string $server_side_url;
    public string $signing_key;
    public string $events_script_version;
    public string $att_script_version;

    public function rules(): array
    {
        return [

             'uuid' => Rule::requiredIf($this->enabled === true),
             'data_layer_listener_enabled' => 'boolean',
             'server_side_url' => ['nullable'],
             'signing_key' => ['required'],
             'events_script_version' => ['required'],
             'att_script_version' => ['required'],
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
               'properties' => ['data_layer_listener_enabled', 'uuid', 'server_side_url','signing_key', 'events_script_version', 'att_script_version'],
           ],
        ];
    }

    protected function labels(): array
    {
        return [
            'data_layer_listener_enabled' => 'Enable Elevar Data Layer',
            'uuid' => 'Key (UUID)',
            'server_side_url' => 'Server side URL',
            'signing_key' => 'Signing Key',
            'events_script_version' => 'Events script version',
            'att_script_version' => 'ATT script version',
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
            'events_script_version' => 'Enter the events script version to be used. Example: "3.2.10". This will likely be provided by Elevar.',
            'att_script_version' => 'Enter the ATT script version to be used. Example: "3.2.10". This will likely be provided by Elevar.',
        ];
    }
}
