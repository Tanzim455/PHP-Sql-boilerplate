<?php


use App\DataTypes;

require_once 'vendor/autoload.php';


$posts = [
    'id' => DataTypes::INTAUTO,
    'title' => DataTypes::STRINGNOTNULL,
    'description' => DataTypes::STRINGNOTNULL

];
