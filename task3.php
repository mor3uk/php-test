<?php
require('./db.php');

$sql = "CREATE TABLE people
(
    id integer NOT NULL AUTO_INCREMENT,
    full_name varchar(32) NOT NULL,
    PRIMARY KEY (id)
); ";

$sql .= "CREATE TABLE phone_numbers
(
    id integer NOT NULL AUTO_INCREMENT,
    phone_number integer NOT NULL,
    PRIMARY KEY (id)
); ";

$sql .= "CREATE TABLE person_number
( 
    person_id integer NOT NULL,
    phone_number_id integer NOT NULL,
    PRIMARY KEY (phone_number_id, person_id),
    FOREIGN KEY (phone_number_id) REFERENCES phone_numbers(id),
    FOREIGN KEY (person_id) REFERENCES people(id)
); ";

if (!mysqli_multi_query($db, $sql)) {
    die('Error: ' . mysqli_error($db));
}
