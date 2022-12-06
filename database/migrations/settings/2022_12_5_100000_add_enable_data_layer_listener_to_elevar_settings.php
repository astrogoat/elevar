<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class AddEnableDataLayerListenerToElevarSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('elevar.data_layer_listener_enabled', false);
    }

    public function down()
    {
        $this->migrator->delete('elevar.data_layer_listener_enabled');
    }
}
