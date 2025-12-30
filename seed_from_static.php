<?php
include 'db_connect.php';

$conn_admin = connect_admin_db();

// Truncate the products table to start fresh
$conn_admin->query("TRUNCATE TABLE products");

$products = [
    [
        'name' => 'Full Sleeve Cover Shirt',
        'price' => 40.00,
        'image' => 'product-item1.jpg',
        'category' => 'Tshirts'
    ],
    [
        'name' => 'Volunteer Half blue',
        'price' => 38.00,
        'image' => 'product-item2.jpg',
        'category' => 'Tshirts'
    ],
    [
        'name' => 'Double yellow shirt',
        'price' => 44.00,
        'image' => 'product-item3.jpg',
        'category' => 'Tshirts'
    ],
    [
        'name' => 'Long belly grey pant',
        'price' => 33.00,
        'image' => 'product-item4.jpg',
        'category' => 'Pants'
    ],
    [
        'name' => 'Half sleeve T-shirt',
        'price' => 40.00,
        'image' => 'selling-products1.jpg',
        'category' => 'Tshirts'
    ],
    [
        'name' => 'Stylish Grey T-shirt',
        'price' => 35.00,
        'image' => 'selling-products2.jpg',
        'category' => 'Tshirts'
    ],
    [
        'name' => 'Silk White Shirt',
        'price' => 35.00,
        'image' => 'selling-products3.jpg',
        'category' => 'Tshirts'
    ],
    [
        'name' => 'Grunge Hoodie',
        'price' => 30.00,
        'image' => 'selling-products4.jpg',
        'category' => 'Hoodie'
    ],
    [
        'name' => 'Full sleeve Jeans jacket',
        'price' => 40.00,
        'image' => 'selling-products5.jpg',
        'category' => 'Jackets'
    ],
    [
        'name' => 'Grey Check Coat',
        'price' => 30.00,
        'image' => 'selling-products6.jpg',
        'category' => 'Outer'
    ],
    [
        'name' => 'Long Sleeve T-shirt',
        'price' => 40.00,
        'image' => 'selling-products7.jpg',
        'category' => 'Tshirts'
    ],
    [
        'name' => 'Half Sleeve T-shirt',
        'price' => 35.00,
        'image' => 'selling-products8.jpg',
        'category' => 'Tshirts'
    ],
    [
        'name' => 'Orange white Nike',
        'price' => 55.00,
        'image' => 'selling-products13.jpg',
        'category' => 'Shoes'
    ],
    [
        'name' => 'Running Shoe',
        'price' => 65.00,
        'image' => 'selling-products14.jpg',
        'category' => 'Shoes'
    ],
    [
        'name' => 'Tennis Shoe',
        'price' => 80.00,
        'image' => 'selling-products15.jpg',
        'category' => 'Shoes'
    ],
    [
        'name' => 'Nike Brand Shoe',
        'price' => 65.00,
        'image' => 'selling-products16.jpg',
        'category' => 'Shoes'
    ]
];

$stmt = $conn_admin->prepare("INSERT INTO products (name, price, image, category) VALUES (?, ?, ?, ?)");

foreach ($products as $product) {
    $stmt->bind_param("sdss", $product['name'], $product['price'], $product['image'], $product['category']);
    $stmt->execute();
}

echo "Products seeded successfully!";

$stmt->close();
$conn_admin->close();
?>
