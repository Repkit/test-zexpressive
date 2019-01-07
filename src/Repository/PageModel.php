<?php

declare(strict_types=1);

namespace Pages\Repository;

use \Zend\Db\TableGateway\AbstractTableGateway;

class PageModel //extends AbstractTableGateway
{
    public function getPage($id)
    {
        $page = new PageEntity();
        $page->Id = $id;
        $page->Name = 'home';
        $page->Content = 'hi there';
        
        return $page;
    }
    
    public function getAll()
    {
        $pages = [];
        for($id = 1; $id < 4; $id++){
            $page = new PageEntity();
            $page->Id = $id;
            $page->Name = 'home';
            $page->Content = 'hi there';
            $pages[] = $page;
        }
        
        return $pages;
    }
}