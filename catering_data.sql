CREATE DATABASE cateringdata;

USE cateringdata;

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    occasion VARCHAR(255) NOT NULL,
    event_date DATE NOT NULL,
    event_time TIME NOT NULL,
    budgetPerPax DECIMAL(10, 2) NOT NULL,
    no_of_guests INT NOT NULL,
    eventAddress VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL,
    contactName VARCHAR(255) NOT NULL,
    contactNumber VARCHAR(255) NOT NULL,
    contactEmail VARCHAR(255) NOT NULL,
    companyName VARCHAR(255),
    specialRequest TEXT,
    promoCode VARCHAR(255),
    newsletter VARCHAR(255) NOT NULL
);