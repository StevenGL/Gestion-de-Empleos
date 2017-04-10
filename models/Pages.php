<?php

class Pages
{
    
    public function __construct()
    { 
    
    }
    
    public function showPageList($start, $limit)
    {
        $pages = R::findAll('pages', " ORDER BY name ASC LIMIT :start, :limit ", array(':start'=>$start, ':limit'=>$limit));
        return $pages;
    }
    
    public function showPage($id)
    {
        $page = R::load('pages', $id);
        if (isset($page) && $page->id) {
            return $page;
        }
        return false;
    }
    
    public function countPageList()
    {
        $pages = R::count('pages');
        return $pages;
    }
    
    public function addToPageList($data)
    {
        if (isset($data['id']) && $data['id'] > 0) {
            $page = R::load('pages', $data['id']);
        } else {
            $page = R::dispense('pages');
        }
        $page->name = $data['name'];
        $page->description = $data['description'];
        $page->url = $data['url'];
        $page->content = $data['content'];
        $id = R::store($page);
        return $id;
    }
    
    public function deleteFromPage($id)
    {
        $page = R::load('pages', $id);
        R::trash($page);
        return true;
    }
    
}