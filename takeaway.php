<?php
// Order Class
class Order {
    private $customerName;
    private $items;
    private $status;

    public function __construct(string $customerName, array $items) {
        $this->customerName = $customerName;
        $this->items = $items;
        $this->status = 'Pending';
    }

    public function getCustomerName(): string {
        return $this->customerName;
    }

    public function getItems(): array {
        return $this->items;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function setStatus(string $status): void {
        $this->status = $status;
    }

    public function displayOrder(): void {
        echo "Order for {$this->customerName}:\n";
        echo "Items: " . implode(", ", $this->items) . "\n";
        echo "Status: {$this->status}\n";
    }
}

// TakeawayOrder Class
class TakeawayOrder {
    private $orders = [];

    public function createOrder(string $customerName, array $items): Order {
        $order = new Order($customerName, $items);
        $this->orders[] = $order;
        echo "Takeaway order created for {$customerName}.\n";
        return $order;
    }

    public function updateOrderStatus(Order $order, string $status): void {
        $order->setStatus($status);
        echo "Order status updated to '{$status}' for {$order->getCustomerName()}.\n";
    }

    public function displayAllOrders(): void {
        foreach ($this->orders as $order) {
            $order->displayOrder();
            echo "-------------------------\n";
        }
    }
}

// Client Code
$takeaway = new TakeawayOrder();

// Create takeaway orders
$order1 = $takeaway->createOrder("Alice", ["Pizza", "Soda"]);
$order2 = $takeaway->createOrder("Bob", ["Burger", "Fries"]);

// Update order status
$takeaway->updateOrderStatus($order1, "Ready for Pickup");

// Display all orders
$takeaway->displayAllOrders();
?>
