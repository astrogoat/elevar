<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class AddSigningKeyToElevarSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('elevar.signing_key', '');
    }

    public function down()
    {
        $this->migrator->delete('elevar.signing_key');
    }
}
