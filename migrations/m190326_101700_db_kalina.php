<?php

use yii\db\Migration;

/**
 * Class m190326_101700_db_kalina
 */
class m190326_101700_db_kalina extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'phone' => $this->string()->notNull()
        ], $tableOptions);


        $this->createTable('{{%position}}', [
            'id' => $this->primaryKey(),
            'amount' => $this->integer(),
            'price' => $this->float(),
            'variant_id' => $this->integer(),
            'order_id' => $this->integer()
        ], $tableOptions);

        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'time' => $this->time(),
            'comments' => $this->string(),
            'user_id' => $this->integer(),
            'status_order_id' => $this->integer()
        ], $tableOptions);

        $this->createTable('{{%status_order}}', [
            'id' => $this->primaryKey(),
            'status' => $this->string(),
        ]);

        $this->createTable('{{%variant}}', [
            'id' => $this->primaryKey(),
            'variant_photo' => $this->string(),
            'size' => $this->string(),
            'color_id' => $this->integer(),
            'amount' => $this->integer(),
            'product_id' => $this->integer(),
            'price' => $this->float(),
        ], $tableOptions);

        $this->createTable('{{%subscribers}}',
            [
                'id' => $this->primaryKey(),
                'email' => $this->string()->notNull()->unique(),
            ], $tableOptions);


        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'price' => $this->float(0),
            'code' => $this->integer(),
            'min_quantity' => $this->integer(),
            'vendor_id' => $this->integer(),
            'material' => $this->string(),
            'description' => $this->text(),
            'category_id' => $this->integer(),
            'status_product_id' => $this->integer(),
        ], $tableOptions);

        $this->createTable('{{%status_product}}', [
            'id' => $this->primaryKey(),
            'status' => $this->string(),
        ]);

        $this->createTable('{{%photo_product}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'img' => $this->string(),
        ]);


        $this->createTable('{{%vendor}}', [
            'id' => $this->primaryKey(),
            'country' => $this->string(),
        ]);

        $this->createTable('{{%favorite}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'user_id' => $this->integer()
        ], $tableOptions);

        $this->createTable('{{%color}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'color' => $this->string()
        ], $tableOptions);


        $this->createIndex(
            'idx-color-variant',
            '{{%variant}}',
            'id',
            'color_id'
        );
        $this->createIndex(
            'idx-favorite-user-product',
            '{{%favorite}}',
            'product_id',
            'user_id'

        );

        $this->createIndex(
            'idx-position-variant',
            '{{%position}}',
            'variant_id',
            'order_id'
        );

        $this->createIndex(
            'idx-product-vendor',
            '{{%product}}',
            'vendor_id'
        );

        $this->createIndex(
            'idx-variant-product',
            '{{%variant}}',
            'product_id'
        );


        $this->addForeignKey(
            'fk-product-photo-product',
            '{{%photo_product}}',
            'product_id',
            '{{%product}}',
            'id'
        );


        $this->addForeignKey(
            'fk-favorite-user',
            '{{%favorite}}',
            'user_id',
            '{{%user}}',
            'id'
        );
        $this->addForeignKey(
            'fk-favorite-product',
            '{{%favorite}}',
            'product_id',
            '{{%product}}',
            'id'
        );

        $this->addForeignKey(
            'fk-position-variant',
            '{{%position}}',
            'variant_id',
            '{{%variant}}',
            'id'
        );
        $this->addForeignKey(
            'fk-position-order',
            '{{%position}}',
            'order_id',
            '{{%order}}',
            'id'
        );

        $this->addForeignKey(
            'fk-variant-product',
            '{{%variant}}',
            'product_id',
            '{{%product}}',
            'id'
        );

        $this->addForeignKey(
            'fk-product-vendor',
            '{{%product}}',
            'vendor_id',
            '{{%vendor}}',
            'id'
        );

        $this->addForeignKey(
            'fk-order-status-order',
            '{{%order}}',
            'status_order_id',
            '{{%status_order}}',
            'id'
        );
        $this->addForeignKey(
            'fk-product-status-product',
            '{{%product}}',
            'status_product_id',
            '{{%status_product}}',
            'id'
        );


        $this->addForeignKey(
            'fk-variant-color',
            '{{%variant}}',
            'color_id',
            '{{%color}}',
            'id'
        );
        $this->addForeignKey(
            'fk-product-category',
            '{{%product}}',
            'category_id',
            '{{%category}}',
            'id'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190326_101700_db_kalina cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190326_101700_db_kalina cannot be reverted.\n";

        return false;
    }
    */
}
