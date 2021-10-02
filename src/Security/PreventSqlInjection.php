<?php

namespace App\Security;

/**
 * Class PreventSqlInjection | file PreventSqlInjection.php
 *
 * This class is used to prevent SQL injection
 * In this class, we have methods for :
 *
 * Replacing quote and semicolon with HTML entities and mofifying 'SCRIPT' tag
 * Restoring strings replaced with 'replaceInData' method
 * 
 */
class PreventSqlInjection
{
    /**
     * Replace quote and semicolon with HTML entities
     * Modify SCRIPT tag
     *
     * @param string|null $data
     * @return string
     */
    function replaceInData(? string $data) :string
    {
        // dump('Avant => ' . $data);

        if(strstr(strtolower($data), "<script")) {
            $data= str_replace("<script", "<scr_ipt", strtolower($data));
            $data= str_replace("</script>", "</scr_ipt>", strtolower($data));
        }
        
        $data= htmlspecialchars($data, ENT_QUOTES);
        $data= str_replace(";", "__SEMICOLON__", $data);
        
        // dump('Après => ' . $data);
        
        return $data;
    }

    /**
     * Restore replaced string with 'replaceInData' method
     *
     * @param string|null $data
     * @return string
     */
    function restoreData(? string $data) : string
    {
        $data= str_replace("__SEMICOLON__", ";", $data);
        $data= htmlspecialchars_decode($data, ENT_QUOTES);
        return $data;
    }
}
