<?php

use App\Database;

require_once './vendor/autoload.php';
include './migrations.php';
Database::makeTable(tablename: 'posts', array: $posts);
