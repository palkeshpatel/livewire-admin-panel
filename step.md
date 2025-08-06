1 create
-- 1. Users Table (Admin, Vendor, Customer)
CREATE TABLE users (
id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255) NOT NULL,
email VARCHAR(255) UNIQUE NOT NULL,
password VARCHAR(255) NOT NULL,
role ENUM('admin', 'vendor', 'customer') DEFAULT 'customer',
phone VARCHAR(20) NULL,
email_verified_at TIMESTAMP NULL,
remember_token VARCHAR(100) NULL,
created_at TIMESTAMP NULL,
updated_at TIMESTAMP NULL
);

-- 2. Vendor Applications (Pending/Approved/Rejected)
CREATE TABLE vendor_applications (
id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
user_id BIGINT UNSIGNED NOT NULL,
shop_name VARCHAR(255) NOT NULL,
shop_description TEXT NULL,
business_license VARCHAR(255) NULL,
status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
rejection_reason TEXT NULL,
created_at TIMESTAMP NULL,
updated_at TIMESTAMP NULL,
FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- 3. Vendors (Approved Vendor Profiles)
CREATE TABLE vendors (
id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
user_id BIGINT UNSIGNED NOT NULL,
shop_name VARCHAR(255) NOT NULL,
shop_slug VARCHAR(255) UNIQUE NOT NULL,
shop_logo VARCHAR(255) NULL,
shop_banner VARCHAR(255) NULL,
shop_description TEXT NULL,
status ENUM('active', 'inactive') DEFAULT 'active',
created_at TIMESTAMP NULL,
updated_at TIMESTAMP NULL,
FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- 4. Categories
CREATE TABLE categories (
id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
parent_id BIGINT UNSIGNED NULL,
name VARCHAR(255) NOT NULL,
slug VARCHAR(255) UNIQUE NOT NULL,
description TEXT NULL,
created_at TIMESTAMP NULL,
updated_at TIMESTAMP NULL,
FOREIGN KEY (parent_id) REFERENCES categories(id) ON DELETE SET NULL
);

-- 5. Products
CREATE TABLE products (
id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
vendor_id BIGINT UNSIGNED NOT NULL,
category_id BIGINT UNSIGNED NOT NULL,
name VARCHAR(255) NOT NULL,
slug VARCHAR(255) UNIQUE NOT NULL,
description LONGTEXT NULL,
price DECIMAL(10,2) NOT NULL,
stock INT UNSIGNED DEFAULT 0,
status ENUM('active', 'inactive') DEFAULT 'active',
created_at TIMESTAMP NULL,
updated_at TIMESTAMP NULL,
FOREIGN KEY (vendor_id) REFERENCES vendors(id) ON DELETE CASCADE,
FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);

-- 6. Product Images
CREATE TABLE product_images (
id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
product_id BIGINT UNSIGNED NOT NULL,
image_path VARCHAR(255) NOT NULL,
is_primary BOOLEAN DEFAULT FALSE,
created_at TIMESTAMP NULL,
updated_at TIMESTAMP NULL,
FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- 7. Orders
CREATE TABLE orders (
id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
customer_id BIGINT UNSIGNED NOT NULL,
total_amount DECIMAL(10,2) NOT NULL,
status ENUM('pending', 'processing', 'shipped', 'completed', 'cancelled') DEFAULT 'pending',
payment_status ENUM('pending', 'paid', 'failed') DEFAULT 'pending',
shipping_address TEXT NOT NULL,
created_at TIMESTAMP NULL,
updated_at TIMESTAMP NULL,
FOREIGN KEY (customer_id) REFERENCES users(id) ON DELETE CASCADE
);

-- 8. Order Items
CREATE TABLE order_items (
id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
order_id BIGINT UNSIGNED NOT NULL,
product_id BIGINT UNSIGNED NOT NULL,
vendor_id BIGINT UNSIGNED NOT NULL,
quantity INT UNSIGNED NOT NULL,
price DECIMAL(10,2) NOT NULL,
created_at TIMESTAMP NULL,
updated_at TIMESTAMP NULL,
FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
FOREIGN KEY (vendor_id) REFERENCES vendors(id) ON DELETE CASCADE
);

-- 9. Payments
CREATE TABLE payments (
id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
order_id BIGINT UNSIGNED NOT NULL,
payment_method VARCHAR(100) NOT NULL,
amount DECIMAL(10,2) NOT NULL,
payment_status ENUM('pending', 'paid', 'failed') DEFAULT 'pending',
transaction_id VARCHAR(255) NULL,
created_at TIMESTAMP NULL,
updated_at TIMESTAMP NULL,
FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
);
