<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240624170648 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE hebergement (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, surface DOUBLE PRECISION DEFAULT NULL, capacite INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pension (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, reduction_enfant DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, unite_hebergement_id INT NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, statut VARCHAR(255) DEFAULT NULL, INDEX IDX_42C849557711A49E (unite_hebergement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tarif_hebergement (id INT AUTO_INCREMENT NOT NULL, hebergement_id INT NOT NULL, prix DOUBLE PRECISION NOT NULL, unite VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, date_fin DATE DEFAULT NULL, INDEX IDX_607B3CD23BB0F66 (hebergement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tarif_pension (id INT AUTO_INCREMENT NOT NULL, pension_id INT NOT NULL, prix DOUBLE PRECISION NOT NULL, date_debut DATE NOT NULL, date_fin DATE DEFAULT NULL, unite VARCHAR(255) NOT NULL, INDEX IDX_ABDEE3F6DB67326 (pension_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tarif_transport (id INT AUTO_INCREMENT NOT NULL, transport_id INT NOT NULL, prix DOUBLE PRECISION NOT NULL, unite VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, date_fin DATE DEFAULT NULL, INDEX IDX_55AEF91F9909C13F (transport_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transport (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, depart VARCHAR(255) NOT NULL, arrivee VARCHAR(255) NOT NULL, capacite INT NOT NULL, duree VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unite_hebergement (id INT AUTO_INCREMENT NOT NULL, type_hebergement_id INT NOT NULL, numero VARCHAR(255) NOT NULL, statut VARCHAR(255) DEFAULT NULL, INDEX IDX_F95F06FC757826F2 (type_hebergement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849557711A49E FOREIGN KEY (unite_hebergement_id) REFERENCES unite_hebergement (id)');
        $this->addSql('ALTER TABLE tarif_hebergement ADD CONSTRAINT FK_607B3CD23BB0F66 FOREIGN KEY (hebergement_id) REFERENCES hebergement (id)');
        $this->addSql('ALTER TABLE tarif_pension ADD CONSTRAINT FK_ABDEE3F6DB67326 FOREIGN KEY (pension_id) REFERENCES pension (id)');
        $this->addSql('ALTER TABLE tarif_transport ADD CONSTRAINT FK_55AEF91F9909C13F FOREIGN KEY (transport_id) REFERENCES transport (id)');
        $this->addSql('ALTER TABLE unite_hebergement ADD CONSTRAINT FK_F95F06FC757826F2 FOREIGN KEY (type_hebergement_id) REFERENCES hebergement (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849557711A49E');
        $this->addSql('ALTER TABLE tarif_hebergement DROP FOREIGN KEY FK_607B3CD23BB0F66');
        $this->addSql('ALTER TABLE tarif_pension DROP FOREIGN KEY FK_ABDEE3F6DB67326');
        $this->addSql('ALTER TABLE tarif_transport DROP FOREIGN KEY FK_55AEF91F9909C13F');
        $this->addSql('ALTER TABLE unite_hebergement DROP FOREIGN KEY FK_F95F06FC757826F2');
        $this->addSql('DROP TABLE hebergement');
        $this->addSql('DROP TABLE pension');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE tarif_hebergement');
        $this->addSql('DROP TABLE tarif_pension');
        $this->addSql('DROP TABLE tarif_transport');
        $this->addSql('DROP TABLE transport');
        $this->addSql('DROP TABLE unite_hebergement');
    }
}
