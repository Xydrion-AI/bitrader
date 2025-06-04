<?php

use Phinx\Migration\AbstractMigration;

final class Teams extends AbstractMigration
{
    public function change(): void
    {
        $this->table('teams')
            ->addColumn('user_id', 'biginteger', ['signed' => false, 'null' => false])
            ->addColumn('picture', 'string', ['limit' => 255])
            ->addColumn('last_name', 'string', ['limit' => 100])
            ->addColumn('first_name', 'string', ['limit' => 100])
            ->addColumn('title', 'string', ['limit' => 100])
            ->addColumn('description', 'text', ['null' => true])
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->addForeignKey('user_id', 'users', 'id', ['delete' => 'CASCADE'])
            ->create();
    }
}

