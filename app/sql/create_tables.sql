create database sensorifydb;
use sensorifydb;

drop table if exists addresses;
drop table if exists devices;
drop table if exists sensors;
drop table if exists rooms;
drop table if exists users;

create table users(
    name varchar(50) not null,
    lastname varchar(50) not null,
    user_name varchar(50) not null,
    email varchar(100) not null,
    password varchar(50) not null,
    creation_date timestamp,
    login_date timestamp,
    image_dest varchar(100) not null,
    user_id int primary key auto_increment
);
create table rooms(
    room_name varchar(30) not null,
    user_id int,
    room_id int primary key auto_increment,
    foreign key(user_id) references users(user_id)
);
create table addresses(
    zip_code varchar(50) not null,
    street varchar(50) not null,
    country varchar(50) not null,
    place varchar(50) not null,
    user_id int,
    foreign key (user_id) references users(user_id)
);
create table sensors(
    ip_address varchar(50) not null,
    ssid varchar(50) not null,
    password varchar(50) not null,
    port int(20) not null,
    server_ip varchar(50) not null,
    sensor_id int primary key auto_increment,
    room_id int,
    foreign key (room_id) references rooms(room_id)
);

create table devices(
    device_type varchar(50) not null,
    ip_address varchar(50) not null,
    sensor_id int,
    foreign key (sensor_id) references sensors(sensor_id)
);

delete from users where name is not null;
delete from rooms where room_name is not null;
delete from addresses where zip_code is not null;
delete from sensors where ssid is not null;
delete from devices where device_type is not null;



use sensorifydb;
delete from users where name is not null;
delete from rooms where room_name is not null;
delete from addresses where zip_code is not null;
delete from sensors where ssid is not null;
delete from devices where device_type is not null;

INSERT INTO users (name, lastname, user_name, email, password, image_dest)
VALUES ('Alice', 'Johnson', 'alicejohnson', 'alicejohnson@example.com', 'password123', './upload/6429db32b8e901.29262970.png');

INSERT INTO users (name, lastname, user_name, email, password, image_dest)
VALUES ('Bob', 'Smith', 'bobsmith', 'bobsmith@example.com', 'password456', './upload/6429e3f0100da3.03500164.png');

INSERT INTO users (name, lastname, user_name, email, password, image_dest)
VALUES ('Charlie', 'Brown', 'charliebrown', 'charliebrown@example.com', 'password789', './upload/6429e3f0100da3.03500164.png');

INSERT INTO users (name, lastname, user_name, email, password, image_dest)
VALUES ('Diana', 'Lee', 'dianalee', 'dianalee@example.com', 'passwordabc', './upload/6429db32b8e901.29262970.png');

INSERT INTO users (name, lastname, user_name, email, password, image_dest)
VALUES ('Eric', 'Wong', 'ericwong', 'ericwong@example.com', 'passworddef', './upload/6429db32b8e901.29262970.png');

INSERT INTO users (name, lastname, user_name, email, password, image_dest)
VALUES ('Frank', 'Miller', 'frankmiller', 'frankmiller@example.com', 'password123', './upload/642940baa46078.78436909.png');

INSERT INTO users (name, lastname, user_name, email, password, image_dest)
VALUES ('Grace', 'Davis', 'gracedavis', 'gracedavis@example.com', 'password456', './upload/642940baa46078.78436909.png');

INSERT INTO users (name, lastname, user_name, email, password, image_dest)
VALUES ('Henry', 'Johnson', 'henryjohnson', 'henryjohnson@example.com', 'password789', './upload/6429db32b8e901.29262970.png');

INSERT INTO users (name, lastname, user_name, email, password, image_dest)
VALUES ('Isabella', 'Lee', 'isabellalee', 'isabellalee@example.com', 'passwordabc', './upload/6429db32b8e901.29262970.png');

INSERT INTO users (name, lastname, user_name, email, password, image_dest)
VALUES ('Jacob', 'Wong', 'jacobwong', 'jacobwong@example.com', 'passworddef', './upload/642940baa46078.78436909.png');

INSERT INTO users (name, lastname, user_name, email, password, image_dest)
VALUES ('Katie', 'Jones', 'katiejones', 'katiejones@example.com', 'password123', './upload/6429e3f0100da3.03500164.png');

INSERT INTO users (name, lastname, user_name, email, password, image_dest)
VALUES ('Lucas', 'Nguyen', 'lucasnguyen', 'lucasnguyen@example.com', 'password456', './upload/6429db32b8e901.29262970.png');

INSERT INTO users (name, lastname, user_name, email, password, image_dest)
VALUES ('Mia', 'Garcia', 'miagarcia', 'miagarcia@example.com', 'password789', './upload/6429db32b8e901.29262970.png');

INSERT INTO users (name, lastname, user_name, email, password, image_dest)
VALUES ('Noah', 'Zhang', 'noahzhang', 'noahzhang@example.com', 'passwordabc', './upload/6429db32b8e901.29262970.png');

INSERT INTO users (name, lastname, user_name, email, password, image_dest)
VALUES ('Olivia', 'Chen', 'oliviachen', 'oliviachen@example.com', 'passworddef', './upload/642940baa46078.78436909.png');

INSERT INTO users (name, lastname, user_name, email, password, image_dest)
VALUES ('Patrick', 'Wilson', 'patrickwilson', 'patrickwilson@example.com', 'password123', './upload/6429db32b8e901.29262970.png');

INSERT INTO users (name, lastname, user_name, email, password, image_dest)
VALUES ('Quinn', 'Nguyen', 'quinnnguyen', 'quinnnguyen@example.com', 'password456', './upload/6429db32b8e901.29262970.png');

INSERT INTO users (name, lastname, user_name, email, password, image_dest)
VALUES ('Ryan', 'Garcia', 'ryangarcia', 'ryangarcia@example.com', 'HSjhfdshhdsk23', './upload/6429db32b8e901.29262970.png');

INSERT INTO users (name, lastname, user_name, email, password, image_dest)
VALUES ('Sophia', 'Zhang', 'sophiazhang', 'sophiazhang@example.com', 'passwordabc', './upload/642940baa46078.78436909.png');

INSERT INTO users (name, lastname, user_name, email, password, image_dest)
VALUES ('Thomas', 'Chen', 'thomaschen', 'thomaschen@example.com', 'passworddef', './upload/642940baa46078.78436909.png');


INSERT INTO users (name, lastname, user_name, email, password, image_dest)
VALUES ('Ursula', 'Smith', 'ursulasmith', 'ursulasmith@example.com', 'password123', './upload/6429e3f0100da3.03500164.png');

INSERT INTO users (name, lastname, user_name, email, password, image_dest)
VALUES ('Victor', 'Nguyen', 'victornguyen', 'victornguyen@example.com', 'password456', './upload/6429db32b8e901.29262970.png');

INSERT INTO users (name, lastname, user_name, email, password, image_dest)
VALUES ('Wendy', 'Garcia', 'wendygarcia', 'wendygarcia@example.com', 'password789', './upload/6429e3f0100da3.03500164.png');

INSERT INTO users (name, lastname, user_name, email, password, image_dest)
VALUES ('Xavier', 'Zhang', 'xavierzhang', 'xavierzhang@example.com', 'passwordabc', './upload/6429db32b8e901.29262970.png');

INSERT INTO users (name, lastname, user_name, email, password, image_dest)
VALUES ('Yara', 'Chen', 'yaraChen', 'yarachen@example.com', 'passworddef', './upload/642940baa46078.78436909.png');

select * from users order by creation_date asc;