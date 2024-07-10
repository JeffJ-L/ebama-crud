<?php
class Produits {
    public string $name;
    public float $price;
    public string $description;
    public int $stock;

    public function getProductDetails(): string {
        return "Name: $this->name, Description: $this->description, Price: $this->price, Stock: $this->stock";
    }

    public function updateStock(int $quantity): void {
        $this->stock = $quantity;
    }
}
?>
