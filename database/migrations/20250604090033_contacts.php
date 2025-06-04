<?php

use Phinx\Migration\AbstractMigration;

final class Contacts extends AbstractMigration
{
    public function change(): void
    {
        $this->table('contacts')
            ->addColumn('last_name', 'string', ['limit' => 100])
            ->addColumn('first_name', 'string', ['limit' => 100])
            ->addColumn('email', 'string', ['limit' => 150])
            ->addColumn('message', 'text')
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->create();
    }
}
