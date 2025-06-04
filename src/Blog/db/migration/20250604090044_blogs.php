<?php

use Phinx\Migration\AbstractMigration;

final class Blogs extends AbstractMigration
{
   public function change()
    {
        $table = $this->table('blogs');
        $table->addColumn('picture', 'string', ['limit' => 255])
            ->addColumn('tags', 'string', ['limit' => 255])
            ->addColumn('title', 'string', ['limit' => 150])
            ->addColumn('description', 'text')
            ->addColumn('comment_text', 'text', ['null' => true])
            ->addColumn('user_id', 'biginteger', ['signed' => false]) 
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->addForeignKey('user_id', 'users', 'id', ['delete' => 'CASCADE','update' => 'NO_ACTION',])
            ->create();
    }

}
