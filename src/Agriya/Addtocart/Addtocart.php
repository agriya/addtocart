<?php namespace Agriya\Addtocart;

use Input;
use Config;
use Validator;
use Exception;

class AddtocartException extends Exception {}
class CartInvalidDataException extends AddtocartException {}
class CartRequiredIndexException extends AddtocartException {}
class CartItemNotFoundException extends AddtocartException {}
class CartInvalidItemIdException extends AddtocartException {}
class CartInvalidUserIdException extends AddtocartException {}
class CartInvalidItemQuantityException extends AddtocartException {}

class Addtocart extends \BaseController {
	/**
	 * Inserts items into the cart.
	 *
	 * @access   public
	 * @param    array
	 * @return   mixed
	 * @throws   Exception
	 */
	public function add($item = array())
	{
		if ( ! is_array($item) or count($item) == 0) {
			throw new CartInvalidDataException;
		}

		$required_indexes = array('user_id', 'item_id', 'qty');
		foreach ($required_indexes as $index) {
			if ( !isset($item[ $index ])) {
				throw new CartRequiredIndexException('Required index [' . $index . '] is missing.');
			}
		}

		if ( !is_numeric($item['qty']) or $item['qty'] == 0) {
			throw new CartInvalidItemQuantityException;
		}

		$data_arr = array('user_id' => $item['user_id'],
		                      'item_id' => $item['item_id'],
		                      'qty' => $item['qty']);

		return $rowid = UserCart::insertGetId($data_arr);
		// Some this went wrong
		throw new AddtocartException;
	}

	/**
	 * Removes an item from the cart.
	 *
	 * @access   public
	 * @param    integer
	 * @return   boolean
	 * @throws   Exception
	 */
	public function remove($item_id = null, $user_id = 0)
	{
		// Check if we have an id passed.
		//
		if (is_null($item_id))
		{
			throw new CartInvalidItemIdException;
		}

		if ($user_id > 0) {
			// Try to remove the item.
			$res = UserCart::whereRaw('item_id = ? AND user_id = ?', array($item_id, $user_id))->delete();
			if ($res) {
				return true;
			}
		}

		// Something went wrong.
		throw new AddtocartException;
	}

	/**
	 * Empties the cart, and removes the session.
	 *
	 * @access   public
	 * @return   void
	 */
	public function destroy($user_id = 0)
	{
		if($user_id > 0) {
			$res = UserCart::whereRaw('user_id = ?', array($user_id))->delete();
			if ($res) {
				return true;
			}
		}

		// Something went wrong.
		throw new AddtocartException;
	}

	/**
	 * Returns the cart contents.
	 *
	 * @access   public
	 * @return   array
	 */
	public function contents($user_id)
	{
		// Get the cart contents.
		$cart = $this->getCartList($user_id);
		if(count($cart) > 0) {
			return $cart;
		}
		throw new CartItemNotFoundException;
	}

	/**
	 * Getting contents.
	 *
	 * @author 		manikandan_133at10
	 * @return 		void
	 * @access 		public
	 */
	public function getCartList($user_id)
	{
		$cart_arr = array();
		$cart = UserCart::Select('id', 'user_id', 'item_id', 'qty')
									->whereRaw('user_id = ?', array($user_id))
									->orderBy('date_added', 'ASC')
									->get();
		if(count($cart) > 0) {
			foreach($cart as $key=>$values) {
				$cart_arr[$key]['id'] = $values->id;
				$cart_arr[$key]['user_id'] = $values->user_id;
				$cart_arr[$key]['item_id'] = $values->item_id;
				$cart_arr[$key]['qty'] = $values->qty;
				$cart_arr[$key]['date_added'] = $values->date_added;
			}
		}
		return $cart_arr;
	}
}
?>