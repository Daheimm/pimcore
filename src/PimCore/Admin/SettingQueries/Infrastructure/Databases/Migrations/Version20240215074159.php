<?php

declare(strict_types=1);

namespace App\PimCore\Admin\SettingQueries\Infrastructure\Databases\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240215074159 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // Створення таблиці 'graphql_requests'
        $this->addSql("CREATE TABLE graphql_requests_pimcore (
        id SERIAL NOT NULL,
        name VARCHAR(255) NOT NULL
        type VARCHAR(255) NOT NULL,
        query TEXT NOT NULL,
        x_api_key VARCHAR(255) NOT NULL
        PRIMARY KEY(id)
    )");
    }

    public function down(Schema $schema): void
    {
        // Видалення таблиці 'graphql_requests'
        $this->addSql("DROP TABLE graphql_requests_pimcore");
    }

}
