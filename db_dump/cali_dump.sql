CREATE TABLE Users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(200) NOT NULL UNIQUE
);

CREATE TABLE Vehicles (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,  -- Changed from TEXT to VARCHAR for a name
    initial_price INT NOT NULL,
    add_price INT NOT NULL,
    capacity INT NOT NULL,
    model VARCHAR(50) NOT NULL,
    image_url TEXT
);

CREATE TABLE ReserveServices (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    vehicle_id INT NOT NULL,
    pickup_location_lat FLOAT NOT NULL,
    pickup_location_lon FLOAT NOT NULL,
    dropoff_location_lat FLOAT NOT NULL,
    dropoff_location_lon FLOAT NOT NULL,
    distance FLOAT NOT NULL,
    total_price INT NOT NULL,
    payment_method ENUM('CARD', 'QR') NOT NULL,
    transport_status ENUM('WAITING', 'GOING', 'ARRIVED', 'FINISHED') NOT NULL,
    CONSTRAINT user_fk_rs FOREIGN KEY (user_id) REFERENCES Users(id) ON DELETE CASCADE,
    CONSTRAINT vehicle_fk_rs FOREIGN KEY (vehicle_id) REFERENCES Vehicles(id) ON DELETE CASCADE
);

CREATE TABLE ServiceOptions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,  -- Changed from TEXT to VARCHAR for a name
    price INT NOT NULL
);

CREATE TABLE ReserveServiceOptions (
    reserve_service_id INT,
    service_option_id INT,
    PRIMARY KEY (reserve_service_id, service_option_id),
    CONSTRAINT reserveservices_fk_rso FOREIGN KEY (reserve_service_id) REFERENCES ReserveServices(id) ON DELETE CASCADE,
    CONSTRAINT serviceoptions_fk_rso FOREIGN KEY (service_option_id) REFERENCES ServiceOptions(id) ON DELETE CASCADE
);
