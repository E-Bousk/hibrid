<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Class RestorePreventSqlInjectionExtension | file RestorePreventSqlInjectionExtension.php
 *
 * This class is used to restore semicolon replacement done with 'replaceInData' method on 'PreventSqlInjection' 
 * In this class, we have methods to :
 *
 * Creating a custom TWIG filter 
 * Restoring with custom TWIG filter the semicolon that has been replaced with '__SEMICOLON__' string
 * 
 */
class RestorePreventSqlInjectionExtension extends AbstractExtension
{
    /**
     * Create a custom TWIG filter
     *
     * @return TwigFilter
     */
    public function getFilters()
    {
        return [
            new TwigFilter('restoreSemicolon', [$this, 'restoreSemicolon'])
        ];
    }

    /**
     * Replacement of '__SEMICOLON__' string to semicolon on custom TWIG filter
     *
     * @param string $data
     * @return string $data
     */
    public function restoreSemicolon(string $data)
    {
        $data= str_replace("__SEMICOLON__", ";", $data);
        return $data;
    }
}
