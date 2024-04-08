<?php

require_once(__DIR__ . '/../repository.php');
require_once(__DIR__ . ' /../../models/yummy/menuItem.php');
require_once(__DIR__ . ' /../../models/yummy/drinkItem.php');
require_once(__DIR__ . '/../../exceptions/baseException.php');
require_once(__DIR__ . '/../../exceptions/repositoryException.php');

class MenuRepository extends Repository
{
    public function getMenuForRestaurant($restaurantId) {
        $stmt = $this->connection->prepare("
            SELECT mi.*, d.price_bottle 
            FROM menu_items mi
            LEFT JOIN drinks d ON mi.id = d.id
            WHERE mi.restaurant_id = ?");
        $stmt->execute([$restaurantId]);

        $menuItems = [];
        $restaurantsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($restaurantsData as $data) {
            if (is_null($data['price_bottle'])) {
                // It's a regular menu item (food), not a drink
                $menuItem = new MenuItem($data['name'], $data['description'], $data['price_per_portion']);
                $menuItem->setId($data['id']);
                // Handle NULL value for price per portion
                $menuItem->setPricePerPortion($data['price_per_portion'] ?? null);
                $menuItems['food'][] = $menuItem;
            } else {
                // It's a drink
                $drinkItem = new DrinkItem($data['name'], $data['description'], $data['price_per_portion'], $data['price_bottle']);
                $drinkItem->setId($data['id']);
                // Handle NULL value for price per portion
                $drinkItem->setPricePerPortion($data['price_per_portion'] ?? null);
                $menuItems['drinks'][] = $drinkItem;
            }
        }
    
        return $menuItems;
    }

    public function addMenuItemToRestaurant($restaurantId, $menuItem) {
        try {
            $stmt = $this->connection->prepare("
                INSERT INTO menu_items (restaurant_id, name, description, price_per_portion)
                VALUES (?, ?, ?, ?)");
            $stmt->execute([$restaurantId, $menuItem->getName(), $menuItem->getDescription(), $menuItem->getPricePerPortion()]);

            $lastInsertId = $this->connection->lastInsertId();

            return $lastInsertId;
        } catch (PDOException $e) {
            throw new RepositoryException("Failed to add food menu item to restaurant", $e->getCode(), $e);
        }
    }

    public function addDrinkToRestaurant($drinkItem) {
        try {
            $stmt = $this->connection->prepare("
                INSERT INTO drinks (id, price_bottle)
                VALUES (?, ?)");
            $stmt->execute([$drinkItem->getId(), $drinkItem->getPriceBottle()]);
        } catch (PDOException $e) {
            throw new RepositoryException("Failed to add drink menu item to restaurant", $e->getCode(), $e);
        }
    }

    public function deleteMenuItem($menuItemId) {
        try {
            $stmt = $this->connection->prepare("DELETE FROM menu_items WHERE id = ?");
            $stmt->execute([$menuItemId]);

            return true;
        } catch (PDOException $e) {
            throw new RepositoryException("Failed to delete menu item", $e->getCode(), $e);
        }
    }
    
    public function updateMenuItem($menuItem) {
        try {
            $stmt = $this->connection->prepare("
                UPDATE menu_items
                SET name = ?, description = ?, price_per_portion = ?
                WHERE id = ?");
            $stmt->execute([$menuItem->getName(), $menuItem->getDescription(), $menuItem->getPricePerPortion(), $menuItem->getId()]);

            return true;
        } catch (PDOException $e) {
            throw new RepositoryException("Failed to update menu item", $e->getCode(), $e);
        }
    }

    public function updateDrink($drinkItem) {
        try {
            $stmt = $this->connection->prepare("
                UPDATE drinks
                SET price_bottle = ?
                WHERE id = ?");
            $stmt->execute([$drinkItem->getPriceBottle(), $drinkItem->getId()]);

            return true;
        } catch (PDOException $e) {
            throw new RepositoryException("Failed to update drink item", $e->getCode(), $e);
        }
    }
}