<?php namespace Agriya\Addtocart;
use Eloquent;
class UserCart extends Eloquent
{
    protected $table = "user_cart";
    public $timestamps = false;
    protected $primarykey = 'id';
    protected $table_fields = array("id", "user_id", "item_id", "item_owner_id", "qty", "date_added", "date_modified", "cookie_id");
}