<?php

use Phinx\Migration\AbstractMigration;

final class User extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('user', ['id' => false, 'primary_key' => 'id']);
        $table->addColumn('id', 'biginteger', ['signed' => false, 'identity' => true]) 
              ->addColumn('last_name', 'string', ['limit' => 100])
              ->addColumn('first_name', 'string', ['limit' => 100])
              ->addColumn('email', 'string', ['limit' => 150])
              ->addColumn('password', 'string', ['limit' => 255])
              ->addColumn('role', 'enum', ['values' => ['user', 'admin'], 'default' => 'user'])
              ->addColumn('picture', 'string', ['limit' => 255, 'null' => true])
              ->addColumn('is_valid', 'boolean', ['null' => false])
              ->addColumn('created_at', 'datetime')
              ->addColumn('updated_at', 'datetime')
              ->addIndex(['email'], ['unique' => true])
              ->create();
    }
}

