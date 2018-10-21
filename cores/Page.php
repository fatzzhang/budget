<?php
namespace FATZ;

class Page
{
    public static function main()
    {
        $path = ltrim(f3()->get('PATH'), '/');
        $path .= '../pages/index.html';

        echo file_get_contents($path);
    }
}
