<?php

namespace App\Models;

use App\Core\Database\Database;
use App\Core\Exceptions\ServerErrorException;


class Product extends Database
{
    protected string $tableName = 'products';


    public function all(): array
    {
        $products = $this->pdo->prepare("
            SELECT p.*, a.name AS attribute_name, a.value AS attribute_value
            FROM products p
            LEFT JOIN attributes a ON p.id = a.product_id
        ");
        $products->execute();
        return $products->fetchAll();
    }

    public function create(array $request)
    {
        try {
            // Start a transaction
            $this->pdo->beginTransaction();

            $product = $this->pdo->prepare("
                INSERT INTO $this->tableName (sku, name, price)
                VALUES (:sku, :name, :price)
            ");

            $product->bindParam('sku', $request['sku']);
            $product->bindParam('name', $request['name']);
            $product->bindParam('price', $request['price']);

            $newProduct = $product->execute();

            if (!$newProduct) {
                throw new ServerErrorException("Failed to insert into products table");
            }
            // Last inserted product ID
            $productId = $this->pdo->lastInsertId();

            // Insert into the attributes table if attributes exist in the request
            foreach ($request['attributes'] as $attribute) {
                $attributes = $this->pdo->prepare("
                        INSERT INTO attributes (product_id, name, value)
                        VALUES (:product_id, :name, :value)
                    ");

                $attributes->bindParam('product_id', $productId);
                $attributes->bindParam('name', $attribute['name']);
                $attributes->bindParam('value', $attribute['value']);

                $newAttribute = $attributes->execute();

                if (!$newAttribute) {
                    throw new ServerErrorException("Failed to insert into attributes table");
                }
            }


            // Commit the transaction if everything is successful
            $this->pdo->commit();
        } catch (ServerErrorException $e) {
            // error occurred rollback the transaction
            $this->pdo->rollBack();

            $error = $e->getMessage();

            throw new ServerErrorException("Transaction failed: $error");
        }
    }


    public function delete(array $request)
    {
        foreach ($request as $productId) {
            // $ in table name and : in ID to prevent SQL Injection
            $product = $this->pdo->prepare("DELETE FROM $this->tableName WHERE id = :id");
            $product->bindParam('id', $productId);
            $product->execute();
        }
    }


}