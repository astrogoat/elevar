<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class AddEnableServerSideFieldToElevarSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('elevar.server_side_enable', false);
    }

    public function down()
    {
        $this->migrator->delete('elevar.server_side_enable');
    }
}
