<?php 
namespace ProjetTransfo\Classes;

use PDO;

class Config {
    const DB_HOST = "localhost";
    const DB_NAME = "dialogue";
    const DB_USER = "root";
    const DB_PASSWORD = "";
    const DB_OPTIONS = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
    const BASE_URL = "http://localhost/nemesis/S16-PHPOO/10-transformation-poo/1-Pierra/";
}