<?php

namespace App\Security;

/**
 * Class PreventSqlInjection | file PreventSqlInjection.php
 *
 * This class is used to prevent SQL injection
 * In this class, we have method for :
 *
 * Replacing quote and semicolon with HTML entities
 * Replaing 'SCRIPT' tags with 'BOLD' tag
 * 
 */
class PreventSqlInjection
{
    /**
     * Replace quote and semicolon with HTML entities
     * Replace SCRIPT tags with BOLD tag
     */
    function replaceInData($data) {
        dump($data);

        if(strstr(strtolower($data), "<script")) {
            $data= str_replace("<script", "<b", strtolower($data));
            $data= str_replace("</script>", "</b>", strtolower($data));
        }
        
        $data= htmlspecialchars($data, ENT_QUOTES);
        $data= str_replace(";", "__SEMICOLON__", $data);
        dump($data);
        return $data;
    }
}
