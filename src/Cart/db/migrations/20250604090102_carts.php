<?php

use Phinx\Migration\AbstractMigration;

final class Carts extends AbstractMigration
{
    public function change(): void
    {
        $this->table('carts')
            ->addColumn('total_price', 'decimal', ['precision' => 10, 'scale' => 2])
            ->addColumn('arrival_date', 'date')
            ->addColumn('departure_date', 'date')
            ->addColumn('payment_method', 'enum', ['values' => ['mastercard', 'visa', 'paypal', 'crypto'], 'default' => 'visa'])
            ->addColumn('status', 'enum', ['values' => ['pending', 'paid', 'cancelled'], 'default' => 'pending'])
            ->addColumn('user_id', 'biginteger', ['signed' => false])
            ->addForeignKey('user_id', 'users', 'id', ['delete' => 'CASCADE'])
            ->create();
    }
}

