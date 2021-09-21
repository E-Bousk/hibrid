<?php

namespace App\Security;

/**
 * Class PreventSqlInjection | file PreventSqlInjection.php
 *
 * This class is used to prevent SQL injection
 * In this class, we have method for :
 *
 * Replacing quote and semicolon with HTML entities
 * Replacing 'SCRIPT' tag with 'BOLD' tag
 * 
 */
class PreventSqlInjection
{
    /**
     * Replace quote and semicolon with HTML entities
     * Replace SCRIPT tag with BOLD tag
     */
    function replaceInData($data) {
        dump('Avant => ' . $data);

        if(strstr(strtolower($data), "<script")) {
            $data= str_replace("<script", "<b", strtolower($data));
            $data= str_replace("</script>", "</b>", strtolower($data));
        }
        
        $data= htmlspecialchars($data, ENT_QUOTES);
        $data= str_replace(";", "__SEMICOLON__", $data);
        
        dump('Après => ' . $data);
        return $data;
    }
}
