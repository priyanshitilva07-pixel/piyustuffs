<?php
include 'db_connect.php';

$conn = connect_admin_db();

$products = [
    ['Full sleeve cover shirt', 40.00, 'product-item1.jpg', 'Shirts'],
    ['Volunteer Half blue', 38.00, 'product-item2.jpg', 'Shirts'],
    ['Double yellow shirt', 44.00, 'product-item3.jpg', 'Shirts'],
    ['Long belly grey pant', 33.00, 'product-item4.jpg', 'Pants'],
    ['Half sleeve T-shirt', 40.00, 'selling-products1.jpg', 'Tshirts'],
    ['Stylish Grey T-shirt', 35.00, 'selling-products2.jpg', 'Tshirts'],
    ['Silk White Shirt', 35.00, 'selling-products3.jpg', 'Shirts'],
    ['Grunge Hoodie', 30.00, 'selling-products4.jpg', 'Hoodie'],
    ['Full sleeve Jeans jacket', 40.00, 'selling-products5.jpg', 'Jackets'],
    ['Grey Check Coat', 30.00, 'selling-products6.jpg', 'Outer'],
    ['Long Sleeve T-shirt', 40.00, 'selling-products7.jpg', 'Tshirts'],
    ['Half Sleeve T-shirt', 35.00, 'selling-products8.jpg', 'Tshirts'],
    ['Orange white Nike', 55.00, 'selling-products13.jpg', 'Shoes'],
    ['Running Shoe', 65.00, 'selling-products14.jpg', 'Shoes'],
    ['Tennis Shoe', 80.00, 'selling-products15.jpg', 'Shoes'],
    ['Nike Brand Shoe', 65.00, 'selling-products16.jpg', 'Shoes'],
    ['White Hoodie', 40.00, 'selling-products17.jpg', 'Hoodie'],
    ['Dark Green Hoodie', 35.00, 'selling-products18.jpg', 'Hoodie'],
    ['Stylish Women Bag', 35.00, 'selling-products19.jpg', 'Accessories'],
    ['Stylish Gadgets', 30.00, 'selling-products20.jpg', 'Accessories'],
    ['Full sleeve cover shirt', 40.00, 'selling-products9.jpg', 'Shirts'],
    ['Long Sleeve T-shirt', 40.00, 'selling-products10.jpg', 'Tshirts'],
    ['Grey Check Coat', 45.00, 'selling-products11.jpg', 'Outer'],
    ['Silk White Shirt', 35.00, 'selling-products12.jpg', 'Shirts'],
    ['Blue Jeans pant', 35.00, 'selling-products8.jpg', 'Pants']
];

$stmt = $conn->prepare("INSERT INTO products (name, price, image, category) VALUES (?, ?, ?, ?)");

foreach ($products as $product) {
    $stmt->bind_param("sdss", $product[0], $product[1], $product[2], $product[3]);
    $stmt->execute();
}

echo "Products seeded successfully!";

$stmt->close();
$conn->close();
?>
