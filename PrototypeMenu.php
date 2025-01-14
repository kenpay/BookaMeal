<?php
// Prototype Interface
interface MenuPrototype {
    public function clone(): MenuPrototype;
}

// Concrete Menu Class implementing the Prototype Interface
class Menu implements MenuPrototype {
    private $items;
    private $type;

    public function __construct(string $type, array $items) {
        $this->type = $type;
        $this->items = $items;
    }

    public function setType(string $type): void {
        $this->type = $type;
    }

    public function setItems(array $items): void {
        $this->items = $items;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getItems(): array {
        return $this->items;
    }

    // Clone method
    public function clone(): MenuPrototype {
        return new Menu($this->type, $this->items);
    }
}

// Client Code
// Create a prototype menu
$originalMenu = new Menu("Dinner", ["Steak", "Salad", "Wine"]);

// Clone the original menu
$clonedMenu = $originalMenu->clone();

// Modify the cloned menu
$clonedMenu->setType("Lunch");
$clonedMenu->setItems(["Sandwich", "Soup", "Juice"]);

// Output the details
echo "Original Menu Type: " . $originalMenu->getType() . "\n";
echo "Original Menu Items: " . implode(", ", $originalMenu->getItems()) . "\n";

echo "Cloned Menu Type: " . $clonedMenu->getType() . "\n";
echo "Cloned Menu Items: " . implode(", ", $clonedMenu->getItems()) . "\n";
?>
