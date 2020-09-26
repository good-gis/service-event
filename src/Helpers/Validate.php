<?php

namespace Helpers;

class Validate
{
    public static function validateEvent(array $arr): bool
    {
        if (array_key_exists('priority', $arr) && array_key_exists('conditions', $arr)) {
            if (is_int($arr['priority']) && is_array($arr['conditions'])) {
                return true;
            }
        }
        return false;
    }
}