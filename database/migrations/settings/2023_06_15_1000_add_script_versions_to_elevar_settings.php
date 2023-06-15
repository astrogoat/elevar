<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('elevar.events_script_version', '3.2.10');
        $this->migrator->add('elevar.att_script_version', '3.2.10');
    }

    public function down()
    {
        $this->migrator->delete('elevar.events_script_version');
        $this->migrator->delete('elevar.att_script_version');
    }
};
