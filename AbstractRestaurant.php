<?php
// Abstract Factory Interface
interface RestaurantFactory {
    public function createMenu(): Menu;
    public function createChef(): Chef;
}

// Abstract Products
interface Menu {
    public function getItems(): array;
}

interface Chef {
    public function getSpeciality(): string;
}

// Concrete Products for Fast Food
class FastFoodMenu implements Menu {
    public function getItems(): array {
        return ['Burger', 'Fries', 'Soda'];
    }
}

class FastFoodChef implements Chef {
    public function getSpeciality(): string {
        return "Fast food preparation";
    }
}

// Concrete Products for Fine Dining
class FineDiningMenu implements Menu {
    public function getItems(): array {
        return ['Steak', 'Lobster', 'Wine'];
    }
}

class FineDiningChef implements Chef {
    public function getSpeciality(): string {
        return "Gourmet cooking";
    }
}

// Concrete Factory for Fast Food
class FastFoodFactory implements RestaurantFactory {
    public function createMenu(): Menu {
        return new FastFoodMenu();
    }

    public function createChef(): Chef {
        return new FastFoodChef();
    }
}

// Concrete Factory for Fine Dining
class FineDiningFactory implements RestaurantFactory {
    public function createMenu(): Menu {
        return new FineDiningMenu();
    }

    public function createChef(): Chef {
        return new FineDiningChef();
    }
}

// Client Code
function clientCode(RestaurantFactory $factory) {
    $menu = $factory->createMenu();
    $chef = $factory->createChef();

    echo "Menu Items: " . implode(", ", $menu->getItems()) . "\n";
    echo "Chef Speciality: " . $chef->getSpeciality() . "\n";
}

// Using the Fast Food Factory
echo "Fast Food Restaurant:\n";
clientCode(new FastFoodFactory());

// Using the Fine Dining Factory
echo "\nFine Dining Restaurant:\n";
clientCode(new FineDiningFactory());
?>
