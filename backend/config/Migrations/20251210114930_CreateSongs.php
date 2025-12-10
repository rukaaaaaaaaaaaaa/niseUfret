<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class CreateSongs extends BaseMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/migrations/4/en/migrations.html#the-change-method
     *
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('songs');
        $table->addColumn('title', 'string', [
            'limit' => 255,
            'null' => false,
        ])
        ->addColumn('singer_id', 'integer', [
            'null' => false,
        ])
        ->addColumn('code', 'json', [
            'null' => true,
        ])
        ->addColumn('stroke', 'json', [
            'null' => true,
        ])
        ->addColumn('lyric', 'text', [
            'null' => true,
        ])
        ->addColumn('bpm', 'integer', [
            'null' => true,
        ])
        ->addColumn('album', 'string', [
            'limit' => 255,
            'null' => true,
        ])
        ->addColumn('created', 'datetime', [
            'default' => 'CURRENT_TIMESTAMP',
            'null' => false,
        ])
        ->addColumn('modified', 'datetime', [
            'default' => 'CURRENT_TIMESTAMP',
            'update' => 'CURRENT_TIMESTAMP',
            'null' => false,
        ])
        ->addForeignKey('singer_id', 'singer', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION'
        ])
        ->create();
    }
}
