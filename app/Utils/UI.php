<?php

namespace App\Utils;

class UI
{

    /**
     * Adding Classes By Badge Category
     * 
     * @return string
     */
    static function badgeCategoryClassName($type)
    {
        $badge = 'badge ';

        switch ($type) {
            case "SD":
                $badge .= " badge-danger";
                break;
            case "SMP":
                $badge .= "badge-primary";
                break;
            case "SMA":
                $badge .= "badge-secondary";
                break;
        }

        return $badge;
    }

    static function subscribeColorTheme($type)
    {
        switch ($type) {
            case "Low":
                $classes = "black";
                break;

            case "Medium":
                $classes = "primary";
                break;

            case "High":
                $classes = "warning";
                break;
        }

        return $classes;
    }
}
