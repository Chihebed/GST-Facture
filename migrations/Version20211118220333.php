<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211118220333 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, factures_id INT DEFAULT NULL, date_commande VARCHAR(255) NOT NULL, date_reglement VARCHAR(255) NOT NULL, moyen_paiement VARCHAR(255) NOT NULL, ville_commande VARCHAR(255) NOT NULL, total_commande VARCHAR(255) NOT NULL, paiement_valide VARCHAR(255) NOT NULL, date_livraison VARCHAR(255) NOT NULL, prix_livraison VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_6EEAA67DE9D518F9 (factures_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DE9D518F9 FOREIGN KEY (factures_id) REFERENCES facture (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE commande');
    }
}
