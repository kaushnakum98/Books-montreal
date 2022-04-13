
<?php

/*
#Revision history:
#
22 Rahul on 12/8/2020 at 8:41 AM Rahul Pipaliya(2012728) 2020-12-08 added comments in the code
20 Rahul on 12/3/2020 at 3:36 AM Rahul Pipaliya(2012728) 2020-12-03 added singular/plural pages and functionalities with working buy page

*/


//common class for storing , removing and get count and removing the object of class locally
class collection
{
    //creates the array named $items
    public $items = array();

    // this will add item into array with the key , so it will act like a dictionary in php
    public function add($primary_key, $item)
    {
        $this->items[$primary_key] = $item;
    }

    //this will removes the items from collection $items
    public function remove($primary_key)
    {
        if (isset($this->items[$primary_key])) {
            unset($this->items[$primary_key]);
        }
    }

    //this will return the data of the item if there is one
    public function get($primary_key)
    {
        if (isset($this->items[$primary_key])) {
            return $this->items[$primary_key];
        }
    }

    //return current count of the items in the collection
    public function count()
    {
        return count($this->items);
    }

}