<?php
// Memento Class
class MenuMemento {
    private $items;
    private $type;

    public function __construct(string $type, array $items) {
        $this->type = $type;
        $this->items = $items;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getItems(): array {
        return $this->items;
    }
}

// Originator Class (Menu)
class Menu {
    private $type;
    private $items;

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

    public function save(): MenuMemento {
        return new MenuMemento($this->type, $this->items);
    }

    public function restore(MenuMemento $memento): void {
        $this->type = $memento->getType();
        $this->items = $memento->getItems();
    }
}

// Caretaker Class
class Caretaker {
    private $mementos = [];

    public function addMemento(MenuMemento $memento): void {
        $this->mementos[] = $memento;
    }

    public function getMemento(int $index): MenuMemento {
        return $this->mementos[$index];
    }
}

// Client Code
$menu = new Menu("Dinner", ["Steak", "Salad", "Wine"]);
$caretaker = new Caretaker();

// Save the current state
$caretaker->addMemento($menu->save());

// Change the state of the menu
$menu->setType("Lunch");
$menu->setItems(["Sandwich", "Soup", "Juice"]);
echo "Current Menu: " . $menu->getType() . " - " . implode(", ", $menu->getItems()) . "\n";

// Restore the previous state
$menu->restore($caretaker->getMemento(0));
echo "Restored Menu: " . $menu->getType() . " - " . implode(", ", $menu->getItems()) . "\n";
?>
