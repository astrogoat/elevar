<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class AddServerSideUrlToElevarSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('elevar.server_side_url', '');
        $this->migrator->add('elevar.data_layer_listener_enabled', false);

    }

    public function down()
    {
        $this->migrator->delete('elevar.server_side_url');
         $this->migrator->delete('elevar.data_layer_listener_enabled');
    }
}
