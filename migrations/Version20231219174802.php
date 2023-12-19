<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Enum\User\Status;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;

final class Version20231219174802 extends AbstractMigration
{
    public function getDescription(): string
    {
        return "Adding the 'status' field to the 'user' table.";
    }

    public function up(Schema $schema): void
    {
        $table = $schema->getTable('user');
        $table->addColumn('status', Types::SMALLINT, [
            'default' => Status::Pending->value,
            'unsigned' => true,
        ]);
    }

    public function down(Schema $schema): void
    {
        $table = $schema->getTable('user');
        $table->dropColumn('status');
    }
}
