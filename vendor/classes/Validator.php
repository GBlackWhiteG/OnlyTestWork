<?php

/**
 * @var Db $db;
 */

class Validator
{
    public static function required($field): bool
    {
        return empty($field);
    }

    public static function min($field, $min_nums): bool
    {
        return mb_strlen($field) >= $min_nums;
    }

    public static function unique($field_name, $field): bool
    {
        global $db;
        return $db->query("SELECT COUNT(*) FROM users WHERE $field_name = ?", [$field])->fetchColumn() === 0;
    }

    public static function phoneNumber($field): bool
    {
        return preg_match('/^89\d{9}$/', $field);
    }

    public static function email($field): bool
    {
        return filter_var($field, FILTER_VALIDATE_EMAIL);
    }

    public static function match($first_field, $second_field): bool
    {
        return $first_field === $second_field;
    }
}