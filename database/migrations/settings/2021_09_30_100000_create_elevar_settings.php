<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateElevarSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('elevar.enabled', false);
        $this->migrator->add('elevar.uuid', '');
    }

    public function down()
    {
        $this->migrator->delete('elevar.enabled');
        $this->migrator->delete('elevar.uuid');
    }
}
