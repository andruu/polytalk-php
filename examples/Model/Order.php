<?php
/*
 * This file is part of the Polytalk package.
 *
 * (c) Andrew Weir <andru.weir@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Model;

class Order {

  private static $orders = [
    [ 'id' => 1, 'name' => 'Order 1', 'size' => 'small' ],
    [ 'id' => 2, 'name' => 'Order 2', 'size' => 'medium' ],
    [ 'id' => 3, 'name' => 'Order 3', 'size' => 'large' ],
    [ 'id' => 4, 'name' => 'Order 4', 'size' => 'large' ],
    [ 'id' => 5, 'name' => 'Order 5', 'size' => 'large' ],
    [ 'id' => 6, 'name' => 'Order 6', 'size' => 'large' ],
    [ 'id' => 7, 'name' => 'Order 7', 'size' => 'large' ],
    [ 'id' => 8, 'name' => 'Order 8', 'size' => 'medium' ],
    [ 'id' => 9, 'name' => 'Order 9', 'size' => 'small' ],
    [ 'id' => 10, 'name' => 'Order 10', 'size' => 'large' ]
  ];

  public static function findBySize ($size, $limit) {

    $ordersBySize = array_filter(self::$orders, function ($order) use ($size, $limit) {
      if ($size == $order['size']) {
        return $order;
      }
    });

    return array_slice($ordersBySize, 0, $limit);

  }
}