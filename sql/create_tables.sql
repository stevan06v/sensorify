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
    type varchar(50) not null,
    ip_address varchar(50) not null,
    sensor_id int,
    foreign key (sensor_id) references sensors(sensor_id)
);


