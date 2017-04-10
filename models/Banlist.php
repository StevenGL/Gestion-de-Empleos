<?php

class Banlist
{
    
    public function __construct()
    { 
    
    }
    
    public function showBanList($start, $limit)
    {
        $banlist = R::findAll('banlist', " ORDER BY created DESC LIMIT :start, :limit ", array(':start'=>$start, ':limit'=>$limit));
        return $banlist;
    }
    
    public function countBanList()
    {
        $banlist = R::count('banlist');
        return $banlist;
    }
    
    public function addToList($type, $value)
    {
        $ban = R::dispense('banlist');
        $ban->type = $type;
        $ban->value = $value;
        $ban->created = R::isoDateTime();
        $id = R::store($ban);
        return $id;
    }
    
    public function deleteFromList($id)
    {
        $ban = R::load('banlist', $id);
        $value = $ban->value;
        R::trash($ban);
        return $value;
    }
    
    public static function isBanned($type, $value)
    {
        $ban = R::findOne('banlist', ' type=:type AND value=:value ', array(':type'=>$type, ':value'=>$value));
        if (isset($ban) && $ban->id) {
            return true;
        }
        return false;
    }
	
}