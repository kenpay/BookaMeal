<?php
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
