<?php
// Observer Interface
interface Observer {
    public function update(string $promotion): void;
}

// Subject Interface
interface Subject {
    public function attach(Observer $observer): void;
    public function detach(Observer $observer): void;
    public function notify(): void;
}

// Concrete Subject (Restaurant)
class Restaurant implements Subject {
    private $observers = [];
    private $promotion;

    public function attach(Observer $observer): void {
        $this->observers[] = $observer;
    }

    public function detach(Observer $observer): void {
        $this->observers = array_filter($this->observers, function($o) use ($observer) {
            return $o !== $observer;
        });
    }

    public function notify(): void {
        foreach ($this->observers as $observer) {
            $observer->update($this->promotion);
        }
    }

    public function setPromotion(string $promotion): void {
        $this->promotion = $promotion;
        $this->notify();
    }
}

// Concrete Observers (Subscribers)
class Customer implements Observer {
    private $name;

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function update(string $promotion): void {
        echo "Customer {$this->name} has been notified of the promotion: $promotion\n";
    }
}

class FoodCritic implements Observer {
    public function update(string $promotion): void {
        echo "Food Critic has been notified of the promotion: $promotion\n";
    }
}

// Client Code
// Create a restaurant subject
$restaurant = new Restaurant();

// Create observers
$customer1 = new Customer("John Doe");
$customer2 = new Customer("Jane Smith");
$foodCritic = new FoodCritic();

// Attach observers to the restaurant
$restaurant->attach($customer1);
$restaurant->attach($customer2);
$restaurant->attach($foodCritic);

// Set a promotion, which will notify all observers
$restaurant->setPromotion("50% off on all desserts this weekend!");

// Detach one observer and set another promotion
$restaurant->detach($customer1);
$restaurant->setPromotion("Buy one get one free on all appetizers!");
?>
