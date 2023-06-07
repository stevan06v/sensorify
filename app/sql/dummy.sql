use sensorifydb;


INSERT INTO users (name, lastname, user_name, email, password, creation_date, image_dest, phone_number, country, zip_code, city, house_number, street, user_id) VALUES
    ('John', 'Doe', 'johndoe', 'johndoe@example.com', 'password1', CURRENT_TIMESTAMP, 'image1.jpg', '1234567890', 'USA', '12345', 'New York', '123', 'Main Street', 1),
    ('Jane', 'Smith', 'janesmith', 'janesmith@example.com', 'password2', CURRENT_TIMESTAMP, 'image2.jpg', '0987654321', 'Canada', '54321', 'Toronto', '456', 'Maple Avenue', 2),
    ('Michael', 'Johnson', 'michaeljohnson', 'michaeljohnson@example.com', 'password3', CURRENT_TIMESTAMP, 'image3.jpg', '9876543210', 'UK', 'AB12 3CD', 'London', '789', 'Oak Road', 3),
    ('Emily', 'Brown', 'emilybrown', 'emilybrown@example.com', 'password4', CURRENT_TIMESTAMP, 'image4.jpg', '0123456789', 'Australia', '56789', 'Sydney', '1011', 'Elm Street', 4),
    ('David', 'Davis', 'daviddavis', 'daviddavis@example.com', 'password5', CURRENT_TIMESTAMP, 'image5.jpg', '9876543210', 'Germany', '12345', 'Berlin', '1213', 'Cedar Avenue', 5),
    -- Continue with the remaining 45 records
    ('Sarah', 'Wilson', 'sarahwilson', 'sarahwilson@example.com', 'password6', CURRENT_TIMESTAMP, 'image6.jpg', '1234567890', 'USA', '12345', 'New York', '1415', 'Pine Street', 6),
    ('Daniel', 'Taylor', 'danieltaylor', 'danieltaylor@example.com', 'password7', CURRENT_TIMESTAMP, 'image7.jpg', '0987654321', 'Canada', '54321', 'Toronto', '1617', 'Birch Avenue', 7),
    ('Sophia', 'Anderson', 'sophiaanderson', 'sophiaanderson@example.com', 'password8', CURRENT_TIMESTAMP, 'image8.jpg', '9876543210', 'UK', 'AB12 3CD', 'London', '1819', 'Willow Road', 8),
    ('James', 'Thomas', 'jamesthomas', 'jamesthomas@example.com', 'password9', CURRENT_TIMESTAMP, 'image9.jpg', '0123456789', 'Australia', '56789', 'Sydney', '2021', 'Chestnut Street', 9),
    ('Olivia', 'Roberts', 'oliviaroberts', 'oliviaroberts@example.com', 'password10', CURRENT_TIMESTAMP, 'image10.jpg', '9876543210', 'Germany', '12345', 'Berlin', '2223', 'Sycamore Avenue', 10),
    -- Continue with the remaining 40 records
    ('William', 'Harris', 'williamharris', 'williamharris@example.com', 'password11', CURRENT_TIMESTAMP, 'image11.jpg', '1234567890', 'USA', '12345', 'New York', '2425', 'Poplar Street', 11),
    ('Ava', 'Clark', 'avaclark', 'avaclark@example.com', 'password12', CURRENT_TIMESTAMP, 'image12.jpg', '0987654321', 'Canada', '54321', 'Toronto', '2627', 'Ash Avenue', 12),
    ('Liam', 'Lewis', 'liamlewis', 'liamlewis@example.com', 'password13', CURRENT_TIMESTAMP, 'image13.jpg', '9876543210', 'UK', 'AB12 3CD', 'London', '2829', 'Beech Road', 13),
    ('Isabella', 'Walker', 'isabellawalker', 'isabellawalker@example.com', 'password14', CURRENT_TIMESTAMP, 'image14.jpg', '0123456789', 'Australia', '56789', 'Sydney', '3031', 'Palm Street', 14),
    ('Benjamin', 'Hall', 'benjaminhall', 'benjaminhall@example.com', 'password15', CURRENT_TIMESTAMP, 'image15.jpg', '9876543210', 'Germany', '12345', 'Berlin', '3233', 'Magnolia Avenue', 15),
    -- Continue with the remaining 35 records
    ('Mia', 'Young', 'miayoung', 'miayoung@example.com', 'password16', CURRENT_TIMESTAMP, 'image16.jpg', '1234567890', 'USA', '12345', 'New York', '3435', 'Willow Street', 16),
    ('Lucas', 'Walker', 'lucaswalker', 'lucaswalker@example.com', 'password17', CURRENT_TIMESTAMP, 'image17.jpg', '0987654321', 'Canada', '54321', 'Toronto', '3637', 'Cedar Avenue', 17),
    ('Sophia', 'Cook', 'sophiacook', 'sophiacook@example.com', 'password18', CURRENT_TIMESTAMP, 'image18.jpg', '9876543210', 'UK', 'AB12 3CD', 'London', '3839', 'Birch Road', 18),
    ('Oliver', 'Carter', 'olivercarter', 'olivercarter@example.com', 'password19', CURRENT_TIMESTAMP, 'image19.jpg', '0123456789', 'Australia', '56789', 'Sydney', '4041', 'Elm Avenue', 19),
    ('Emma', 'Ross', 'emmaross', 'emmaross@example.com', 'password20', CURRENT_TIMESTAMP, 'image20.jpg', '9876543210', 'Germany', '12345', 'Berlin', '4243', 'Oak Street', 20),
    -- Continue with the remaining 30 records
    ('Alexander', 'Watson', 'alexanderwatson', 'alexanderwatson@example.com', 'password21', CURRENT_TIMESTAMP, 'image21.jpg', '1234567890', 'USA', '12345', 'New York', '4445', 'Pine Avenue', 21),
    ('Grace', 'Morgan', 'gracemorgan', 'gracemorgan@example.com', 'password22', CURRENT_TIMESTAMP, 'image22.jpg', '0987654321', 'Canada', '54321', 'Toronto', '4647', 'Maple Street', 22),
    ('Daniel', 'Kelly', 'danielkelly', 'danielkelly@example.com', 'password23', CURRENT_TIMESTAMP, 'image23.jpg', '9876543210', 'UK', 'AB12 3CD', 'London', '4849', 'Willow Road', 23),
    ('Ava', 'Baker', 'avabaker', 'avabaker@example.com', 'password24', CURRENT_TIMESTAMP, 'image24.jpg', '0123456789', 'Australia', '56789', 'Sydney', '5051', 'Chestnut Avenue', 24),
    ('Joseph', 'Sullivan', 'josephsullivan', 'josephsullivan@example.com', 'password25', CURRENT_TIMESTAMP, 'image25.jpg', '9876543210', 'Germany', '12345', 'Berlin', '5253', 'Beech Street', 25),
    -- Continue with the remaining 25 records
    ('Chloe', 'Barnes', 'chloebarnes', 'chloebarnes@example.com', 'password26', CURRENT_TIMESTAMP, 'image26.jpg', '1234567890', 'USA', '12345', 'New York', '5455', 'Poplar Avenue', 26),
    ('Samuel', 'Murphy', 'samuelmurphy', 'samuelmurphy@example.com', 'password27', CURRENT_TIMESTAMP, 'image27.jpg', '0987654321', 'Canada', '54321', 'Toronto', '5657', 'Ash Street', 27),
    ('Elizabeth', 'Turner', 'elizabethturner', 'elizabethturner@example.com', 'password28', CURRENT_TIMESTAMP, 'image28.jpg', '9876543210', 'UK', 'AB12 3CD', 'London', '5859', 'Maple Road', 28),
    ('Henry', 'Parker', 'henryparker', 'henryparker@example.com', 'password29', CURRENT_TIMESTAMP, 'image29.jpg', '0123456789', 'Australia', '56789', 'Sydney', '6061', 'Oak Avenue', 29),
    ('Grace', 'Rogers', 'gracerogers', 'gracerogers@example.com', 'password30', CURRENT_TIMESTAMP, 'image30.jpg', '9876543210', 'Germany', '12345', 'Berlin', '6263', 'Pine Street', 30),
    -- Continue with the remaining 20 records
    ('Andrew', 'Gray', 'andrewgray', 'andrewgray@example.com', 'password31', CURRENT_TIMESTAMP, 'image31.jpg', '1234567890', 'USA', '12345', 'New York', '6465', 'Cedar Avenue', 31),
    ('Ella', 'Cooper', 'ellacooper', 'ellacooper@example.com', 'password32', CURRENT_TIMESTAMP, 'image32.jpg', '0987654321', 'Canada', '54321', 'Toronto', '6667', 'Birch Street', 32),
    ('David', 'Hill', 'davidhill', 'davidhill@example.com', 'password33', CURRENT_TIMESTAMP, 'image33.jpg', '9876543210', 'UK', 'AB12 3CD', 'London', '6869', 'Willow Road', 33),
    ('Victoria', 'Howard', 'victoriahoward', 'victoriahoward@example.com', 'password34', CURRENT_TIMESTAMP, 'image34.jpg', '0123456789', 'Australia', '56789', 'Sydney', '7071', 'Elm Avenue', 34),
    ('Joseph', 'Ward', 'josephward', 'josephward@example.com', 'password35', CURRENT_TIMESTAMP, 'image35.jpg', '9876543210', 'Germany', '12345', 'Berlin', '7273', 'Oak Street', 35),
    -- Continue with the remaining 15 records
    ('Madison', 'Collins', 'madisoncollins', 'madisoncollins@example.com', 'password36', CURRENT_TIMESTAMP, 'image36.jpg', '1234567890', 'USA', '12345', 'New York', '7475', 'Pine Avenue', 36),
    ('Jackson', 'Edwards', 'jacksonedwards', 'jacksonedwards@example.com', 'password37', CURRENT_TIMESTAMP, 'image37.jpg', '0987654321', 'Canada', '54321', 'Toronto', '7677', 'Maple Street', 37),
    ('Sofia', 'Stewart', 'sofiastewart', 'sofiastewart@example.com', 'password38', CURRENT_TIMESTAMP, 'image38.jpg', '9876543210', 'UK', 'AB12 3CD', 'London', '7879', 'Willow Road', 38),
    ('Aiden', 'Mitchell', 'aidenmitchell', 'aidenmitchell@example.com', 'password39', CURRENT_TIMESTAMP, 'image39.jpg', '0123456789', 'Australia', '56789', 'Sydney', '8081', 'Chestnut Avenue', 39),
    ('Avery', 'Gonzalez', 'averygonzalez', 'averygonzalez@example.com', 'password40', CURRENT_TIMESTAMP, 'image40.jpg', '9876543210', 'Germany', '12345', 'Berlin', '8283', 'Beech Street', 40);


-- Dummy data inserts for `devices` table
INSERT INTO devices (device_type, ip_address, sensor_id, room_id)
VALUES
    ('Device1', 'IP1', 1, 1),
    ('Device2', 'IP2', 2, 2),
    ('Device3', 'IP3', 3, 3),
    ('Device4', 'IP4', 4, 4),
    ('Device5', 'IP5', 5, 5),
    -- Repeat the pattern below for 45 more records
    ('Device6', 'IP6', 6, 6),
    ('Device7', 'IP7', 7, 7),
    ('Device8', 'IP8', 8, 8),
    ('Device9', 'IP9', 9, 9),
    ('Device10', 'IP10', 10, 10),
    -- Continue with the remaining 40 records
    ('Device11', 'IP11', 11, 11),
    ('Device12', 'IP12', 12, 12),
    ('Device13', 'IP13', 13, 13),
    ('Device14', 'IP14', 14, 14),
    ('Device15', 'IP15', 15, 15),
    -- Continue with the remaining 35 records
    ('Device16', 'IP16', 16, 16),
    ('Device17', 'IP17', 17, 17),
    ('Device18', 'IP18', 18, 18),
    ('Device19', 'IP19', 19, 19),
    ('Device20', 'IP20', 20, 20),
    -- Continue with the remaining 30 records
    ('Device21', 'IP21', 21, 21),
    ('Device22', 'IP22', 22, 22),
    ('Device23', 'IP23', 23, 23),
    ('Device24', 'IP24', 24, 24),
    ('Device25', 'IP25', 25, 25),
    -- Continue with the remaining 25 records
    ('Device26', 'IP26', 26, 26),
    ('Device27', 'IP27', 27, 27),
    ('Device28', 'IP28', 28, 28),
    ('Device29', 'IP29', 29, 29),
    ('Device30', 'IP30', 30, 30),
    -- Continue with the remaining 20 records
    ('Device31', 'IP31', 31, 31),
    ('Device32', 'IP32', 32, 32),
    ('Device33', 'IP33', 33, 33),
    ('Device34', 'IP34', 34, 34),
    ('Device35', 'IP35', 35, 35),
    -- Continue with the remaining 15 records
    ('Device36', 'IP36', 36, 36),
    ('Device37', 'IP37', 37, 37),
    ('Device38', 'IP38', 38, 38),
    ('Device39', 'IP39', 39, 39),
    ('Device40', 'IP40', 40, 40),
    -- Continue with the remaining 10 records
    ('Device41', 'IP41', 41, 41),
    ('Device42', 'IP42', 42, 42),
    ('Device43', 'IP43', 43, 43),
    ('Device44', 'IP44', 44, 44),
    ('Device45', 'IP45', 45, 45),
    -- Continue with the remaining 5 records
    ('Device46', 'IP46', 46, 46),
    ('Device47', 'IP47', 47, 47),
    ('Device48', 'IP48', 48, 48),
    ('Device49', 'IP49', 49, 49),
    ('Device50', 'IP50', 50, 50);


-- Dummy data inserts for `rooms` table
INSERT INTO rooms (room_name, user_id, room_id, room_image, creation_date)
VALUES
    ('Living Room', 1, 1, 'image1.jpg', NOW()),
    ('Bedroom', 1, 2, 'image2.jpg', NOW()),
    ('Kitchen', 2, 3, 'image3.jpg', NOW()),
    ('Bathroom', 2, 4, 'image4.jpg', NOW()),
    ('Office', 3, 5, 'image5.jpg', NOW()),
    -- Repeat the pattern below for 45 more records
    ('Room6', 3, 6, 'image6.jpg', NOW()),
    ('Room7', 4, 7, 'image7.jpg', NOW()),
    ('Room8', 4, 8, 'image8.jpg', NOW()),
    ('Room9', 5, 9, 'image9.jpg', NOW()),
    ('Room10', 5, 10, 'image10.jpg', NOW()),
    -- Continue with the remaining 40 records
    ('Room11', 6, 11, 'image11.jpg', NOW()),
    ('Room12', 6, 12, 'image12.jpg', NOW()),
    ('Room13', 7, 13, 'image13.jpg', NOW()),
    ('Room14', 7, 14, 'image14.jpg', NOW()),
    ('Room15', 8, 15, 'image15.jpg', NOW()),
    -- Continue with the remaining 35 records
    ('Room16', 8, 16, 'image16.jpg', NOW()),
    ('Room17', 9, 17, 'image17.jpg', NOW()),
    ('Room18', 9, 18, 'image18.jpg', NOW()),
    ('Room19', 10, 19, 'image19.jpg', NOW()),
    ('Room20', 10, 20, 'image20.jpg', NOW()),
    -- Continue with the remaining 30 records
    ('Room21', 11, 21, 'image21.jpg', NOW()),
    ('Room22', 11, 22, 'image22.jpg', NOW()),
    ('Room23', 12, 23, 'image23.jpg', NOW()),
    ('Room24', 12, 24, 'image24.jpg', NOW()),
    ('Room25', 13, 25, 'image25.jpg', NOW()),
    -- Continue with the remaining 25 records
    ('Room26', 13, 26, 'image26.jpg', NOW()),
    ('Room27', 14, 27, 'image27.jpg', NOW()),
    ('Room28', 14, 28, 'image28.jpg', NOW()),
    ('Room29', 15, 29, 'image29.jpg', NOW()),
    ('Room30', 15, 30, 'image30.jpg', NOW()),
    -- Continue with the remaining 20 records
    ('Room31', 16, 31, 'image31.jpg', NOW()),
    ('Room32', 16, 32, 'image32.jpg', NOW()),
    ('Room33', 17, 33, 'image33.jpg', NOW()),
    ('Room34', 17, 34, 'image34.jpg', NOW()),
    ('Room35', 18, 35, 'image35.jpg', NOW()),
    -- Continue with the remaining 15 records
    ('Room36', 18, 36, 'image36.jpg', NOW()),
    ('Room37', 19, 37, 'image37.jpg', NOW()),
    ('Room38', 19, 38, 'image38.jpg', NOW()),
    ('Room39', 20, 39, 'image39.jpg', NOW()),
    ('Room40', 20, 40, 'image40.jpg', NOW()),
    -- Continue with the remaining 10 records
    ('Room41', 21, 41, 'image41.jpg', NOW()),
    ('Room42', 21, 42, 'image42.jpg', NOW()),
    ('Room43', 22, 43, 'image43.jpg', NOW()),
    ('Room44', 22, 44, 'image44.jpg', NOW()),
    ('Room45', 23, 45, 'image45.jpg', NOW()),
    -- Continue with the remaining 5 records
    ('Room46', 23, 46, 'image46.jpg', NOW()),
    ('Room47', 24, 47, 'image47.jpg', NOW()),
    ('Room48', 24, 48, 'image48.jpg', NOW()),
    ('Room49', 25, 49, 'image49.jpg', NOW()),
    ('Room50', 25, 50, 'image50.jpg', NOW());

-- Dummy data inserts for `sensors` table
INSERT INTO sensors (ip_address, ssid, password, port, server_ip, sensor_id, room_id)
VALUES
    ('192.168.0.1', 'Sensor1', 'password1', 8080, '192.168.1.1', 1, 1),
    ('192.168.0.2', 'Sensor2', 'password2', 8080, '192.168.1.2', 2, 2),
    ('192.168.0.3', 'Sensor3', 'password3', 8080, '192.168.1.3', 3, 3),
    ('192.168.0.4', 'Sensor4', 'password4', 8080, '192.168.1.4', 4, 4),
    ('192.168.0.5', 'Sensor5', 'password5', 8080, '192.168.1.5', 5, 5),
    -- Repeat the pattern below for 45 more records
    ('192.168.0.6', 'Sensor6', 'password6', 8080, '192.168.1.6', 6, 6),
    ('192.168.0.7', 'Sensor7', 'password7', 8080, '192.168.1.7', 7, 7),
    ('192.168.0.8', 'Sensor8', 'password8', 8080, '192.168.1.8', 8, 8),
    ('192.168.0.9', 'Sensor9', 'password9', 8080, '192.168.1.9', 9, 9),
    ('192.168.0.10', 'Sensor10', 'password10', 8080, '192.168.1.10', 10, 10),
    -- Continue with the remaining 40 records
    ('192.168.0.11', 'Sensor11', 'password11', 8080, '192.168.1.11', 11, 11),
    ('192.168.0.12', 'Sensor12', 'password12', 8080, '192.168.1.12', 12, 12),
    ('192.168.0.13', 'Sensor13', 'password13', 8080, '192.168.1.13', 13, 13),
    ('192.168.0.14', 'Sensor14', 'password14', 8080, '192.168.1.14', 14, 14),
    ('192.168.0.15', 'Sensor15', 'password15', 8080, '192.168.1.15', 15, 15),
    -- Continue with the remaining 35 records
    ('192.168.0.16', 'Sensor16', 'password16', 8080, '192.168.1.16', 16, 16),
    ('192.168.0.17', 'Sensor17', 'password17', 8080, '192.168.1.17', 17, 17),
    ('192.168.0.18', 'Sensor18', 'password18', 8080, '192.168.1.18', 18, 18),
    ('192.168.0.19', 'Sensor19', 'password19', 8080, '192.168.1.19', 19, 19),
    ('192.168.0.20', 'Sensor20', 'password20', 8080, '192.168.1.20', 20, 20),
    -- Continue with the remaining 30 records
    ('192.168.0.21', 'Sensor21', 'password21', 8080, '192.168.1.21', 21, 21),
    ('192.168.0.22', 'Sensor22', 'password22', 8080, '192.168.1.22', 22, 22),
    ('192.168.0.23', 'Sensor23', 'password23', 8080, '192.168.1.23', 23, 23),
    ('192.168.0.24', 'Sensor24', 'password24', 8080, '192.168.1.24', 24, 24),
    ('192.168.0.25', 'Sensor25', 'password25', 8080, '192.168.1.25', 25, 25),
    -- Continue with the remaining 25 records
    ('192.168.0.26', 'Sensor26', 'password26', 8080, '192.168.1.26', 26, 26),
    ('192.168.0.27', 'Sensor27', 'password27', 8080, '192.168.1.27', 27, 27),
    ('192.168.0.28', 'Sensor28', 'password28', 8080, '192.168.1.28', 28, 28),
    ('192.168.0.29', 'Sensor29', 'password29', 8080, '192.168.1.29', 29, 29),
    ('192.168.0.30', 'Sensor30', 'password30', 8080, '192.168.1.30', 30, 30),
    -- Continue with the remaining 20 records
    ('192.168.0.31', 'Sensor31', 'password31', 8080, '192.168.1.31', 31, 31),
    ('192.168.0.32', 'Sensor32', 'password32', 8080, '192.168.1.32', 32, 32),
    ('192.168.0.33', 'Sensor33', 'password33', 8080, '192.168.1.33', 33, 33),
    ('192.168.0.34', 'Sensor34', 'password34', 8080, '192.168.1.34', 34, 34),
    ('192.168.0.35', 'Sensor35', 'password35', 8080, '192.168.1.35', 35, 35),
    -- Continue with the remaining 15 records
    ('192.168.0.36', 'Sensor36', 'password36', 8080, '192.168.1.36', 36, 36),
    ('192.168.0.37', 'Sensor37', 'password37', 8080, '192.168.1.37', 37, 37),
    ('192.168.0.38', 'Sensor38', 'password38', 8080, '192.168.1.38', 38, 38),
    ('192.168.0.39', 'Sensor39', 'password39', 8080, '192.168.1.39', 39, 39),
    ('192.168.0.40', 'Sensor40', 'password40', 8080, '192.168.1.40', 40, 40),
    -- Continue with the remaining 10 records
    ('192.168.0.41', 'Sensor41', 'password41', 8080, '192.168.1.41', 41, 41),
    ('192.168.0.42', 'Sensor42', 'password42', 8080, '192.168.1.42', 42, 42),
    ('192.168.0.43', 'Sensor43', 'password43', 8080, '192.168.1.43', 43, 43),
    ('192.168.0.44', 'Sensor44', 'password44', 8080, '192.168.1.44', 44, 44),
    ('192.168.0.45', 'Sensor45', 'password45', 8080, '192.168.1.45', 45, 45);
