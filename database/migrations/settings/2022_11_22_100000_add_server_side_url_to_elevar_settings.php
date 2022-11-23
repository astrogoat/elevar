<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class AddServerSideUrlToElevarSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('elevar.server_side_url', '');
    }

    public function down()
    {
        $this->migrator->delete('elevar.server_side_url');
    }
}
