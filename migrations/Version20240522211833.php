<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240522211833 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE browsing_history ALTER history_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE browsing_history ALTER history_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE category ALTER category_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE category ALTER category_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE coupon ALTER coupon_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE coupon ALTER coupon_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE "order" ALTER order_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE "order" ALTER order_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE order_detail ALTER order_detail_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE order_detail ALTER order_detail_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE payment ALTER payment_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE payment ALTER payment_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE product ALTER product_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE product ALTER product_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE product_review ALTER review_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE product_review ALTER review_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE recommendation ALTER recommendation_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE recommendation ALTER recommendation_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE returns ALTER return_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE returns ALTER return_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE shipment ALTER shipment_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE shipment ALTER shipment_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE store ALTER store_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE store ALTER store_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE store_review ALTER review_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE store_review ALTER review_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE "user" ALTER user_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE "user" ALTER user_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE wishlist ALTER wishlist_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE wishlist ALTER wishlist_id TYPE VARCHAR(255)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE wishlist ALTER wishlist_id TYPE INT');
        $this->addSql('ALTER TABLE wishlist ALTER wishlist_id TYPE INT');
        $this->addSql('ALTER TABLE returns ALTER return_id TYPE INT');
        $this->addSql('ALTER TABLE returns ALTER return_id TYPE INT');
        $this->addSql('ALTER TABLE product ALTER product_id TYPE INT');
        $this->addSql('ALTER TABLE product ALTER product_id TYPE INT');
        $this->addSql('ALTER TABLE order_detail ALTER order_detail_id TYPE INT');
        $this->addSql('ALTER TABLE order_detail ALTER order_detail_id TYPE INT');
        $this->addSql('ALTER TABLE coupon ALTER coupon_id TYPE INT');
        $this->addSql('ALTER TABLE coupon ALTER coupon_id TYPE INT');
        $this->addSql('ALTER TABLE store_review ALTER review_id TYPE INT');
        $this->addSql('ALTER TABLE store_review ALTER review_id TYPE INT');
        $this->addSql('ALTER TABLE product_review ALTER review_id TYPE INT');
        $this->addSql('ALTER TABLE product_review ALTER review_id TYPE INT');
        $this->addSql('ALTER TABLE category ALTER category_id TYPE INT');
        $this->addSql('ALTER TABLE category ALTER category_id TYPE INT');
        $this->addSql('ALTER TABLE recommendation ALTER recommendation_id TYPE INT');
        $this->addSql('ALTER TABLE recommendation ALTER recommendation_id TYPE INT');
        $this->addSql('ALTER TABLE payment ALTER payment_id TYPE INT');
        $this->addSql('ALTER TABLE payment ALTER payment_id TYPE INT');
        $this->addSql('ALTER TABLE browsing_history ALTER history_id TYPE INT');
        $this->addSql('ALTER TABLE browsing_history ALTER history_id TYPE INT');
        $this->addSql('ALTER TABLE "order" ALTER order_id TYPE INT');
        $this->addSql('ALTER TABLE "order" ALTER order_id TYPE INT');
        $this->addSql('ALTER TABLE shipment ALTER shipment_id TYPE INT');
        $this->addSql('ALTER TABLE shipment ALTER shipment_id TYPE INT');
        $this->addSql('ALTER TABLE store ALTER store_id TYPE INT');
        $this->addSql('ALTER TABLE store ALTER store_id TYPE INT');
        $this->addSql('ALTER TABLE "user" ALTER user_id TYPE INT');
        $this->addSql('ALTER TABLE "user" ALTER user_id TYPE INT');
    }
}
