<?php

use Phinx\Migration\AbstractMigration;

final class Services extends AbstractMigration
{
    public function change(): void
    {
        $this->table('services')
            ->addColumn('title', 'string', ['limit' => 150])
            ->addColumn('description', 'text')
            ->addColumn('picture', 'string', ['limit' => 255])
            ->addColumn('user_id', 'biginteger', ['signed' => false])
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->addForeignKey('user_id', 'users', 'id', ['delete' => 'SET NULL', 'update' => 'NO_ACTION'])
            ->create();
    }
}

