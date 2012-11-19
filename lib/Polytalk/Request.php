<?php
/*
 * This file is part of the Polytalk package.
 *
 * (c) Andrew Weir <andru.weir@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Polytalk;

class Request {

  private $request;

  public function __construct ($request) {
    if (is_string($request) && (preg_match('/^{/', $request) || preg_match('/^\[{/', $request))) {
      $request = json_decode($request, true);
    }
    $this->request = $request;
  }

  public function toJSON () {
    return json_encode($this->request);
  }

  public function toArray () {
    return $this->request;
  }
  
}