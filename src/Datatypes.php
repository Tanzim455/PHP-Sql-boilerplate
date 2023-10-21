<?php

declare(strict_types=1);

namespace App;


class DataTypes
{
    const INTAUTO = "INT AUTO_INCREMENT PRIMARY KEY";

    const  STRING = "VARCHAR(100)";
    const UNIQUE = "UNIQUE";
    const NULLABLE = "NULLABLE";
    const NULLABLEFLOATINT = "DEFAULT 0";
    const NOTNULL = "NOT NULL";
    const STRINGUNIQUENOTNULL = DataTypes::STRING . ' ' . DataTypes::UNIQUE . ' ' . DataTypes::NOTNULL;
    const STRINGNOTNULL = DataTypes::STRING . ' ' . DataTypes::NOTNULL;
    const FLOATNULLABLE = DataTypes::FLOAT . ' ' . DataTypes::NULLABLEFLOATINT;
    const INTNULLABLE = DataTypes::INT . ' ' . DataTypes::NULLABLEFLOATINT;
    const FLOATNOTNULL = DataTypes::FLOAT . ' ' . DataTypes::NOTNULL;
    const INT = "INT";
    const PRIMARYKEY = "PRIMARY KEY";
    const  FLOAT = "FLOAT";
    const TIMESTAMP = "TIMESTAMP";
    const TIMESTAMPNOTNULLABLE = DataTypes::TIMESTAMP . ' ' . DataTypes::NOTNULL;
}
