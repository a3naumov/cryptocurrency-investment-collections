<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;

final class Version20231210183947 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription(): string
    {
        return 'Creates "user" table with necessary columns and sequence for the "id" field.';
    }

    /**
     * @inheritDoc
     */
    public function up(Schema $schema): void
    {
        $schema->createSequence('user_id_seq');

        $table = $schema->createTable('user');

        $table->addColumn('id', Types::INTEGER);
        $table->addColumn('email', Types::STRING, [
            'length' => 180,
        ]);
        $table->addColumn('roles', Types::JSON);
        $table->addColumn('password', Types::STRING, [
            'length' => 255,
        ]);

        $table->setPrimaryKey(['id']);

        $table->addUniqueIndex(['email']);
    }

    /**
     * @inheritDoc
     */
    public function down(Schema $schema): void
    {
        $schema->dropSequence('user_id_seq');
        $schema->dropTable('user');
    }
}
