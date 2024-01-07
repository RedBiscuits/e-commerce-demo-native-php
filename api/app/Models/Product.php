<?php

namespace App\Models;

use App\Core\Database\Database;
use App\Core\Exceptions\ServerErrorException;

class Product extends Database
{
    // Define the table name for the Product model
    protected string $tableName = 'products';

    /**
     * Get all products with their attributes.
     *
     * @return array
     */
    public function all(): array
    {
        // Prepare and execute the SQL query
        $products = $this->pdo->prepare("
            SELECT p.*, a.name AS attribute_name, a.value AS attribute_value
            FROM products p
            LEFT JOIN attributes a ON p.id = a.product_id
        ");
        $products->execute();

        // Transform and return the data
        return $this->transformData($products->fetchAll());
    }

    /**
     * Transform the database result set into a structured array.
     *
     * @param array $result
     * @return array
     */
    private function transformData(array $result): array
    {
        $organizedData = [];

        foreach ($result as $row) {
            $productId = $row['id'];

            if (!isset($organizedData[$productId])) {
                $organizedData[$productId] = [
                    'id' => $row['id'],
                    'sku' => $row['sku'],
                    'name' => $row['name'],
                    'price' => $row['price'],
                    'attributes' => [],
                ];
            }

            if ($row['attribute_name'] !== null && $row['attribute_value'] !== null) {
                $organizedData[$productId]['attributes'][] = [
                    'name' => $row['attribute_name'],
                    'value' => $row['attribute_value'],
                ];
            }
        }

        return array_values($organizedData);
    }

    /**
     * Create a new product and associated attributes.
     *
     * @param array $request
     * @return void
     */
    public function create(array $request)
    {
        try {
            // Start a transaction
            $this->pdo->beginTransaction();

            // Insert new product into the products table
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

            // Insert attributes into the attributes table if they exist in the request
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
            // Error occurred, rollback the transaction
            $this->pdo->rollBack();
            $error = $e->getMessage();
            throw new ServerErrorException("Transaction failed: $error");
        }
    }

    /**
     * Delete products based on the given request.
     *
     * @param array $request
     * @return void
     */
    public function delete(array $request)
    {
        foreach ($request['ids'] as $productSku) {

            // Use parameters to prevent SQL Injection
            $product = $this->pdo->prepare("DELETE FROM $this->tableName WHERE sku = :sku");
            $product->bindParam('sku', $productSku);
            $product->execute();
        }
    }
}
