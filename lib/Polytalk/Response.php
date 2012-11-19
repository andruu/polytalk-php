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

class Response {

  private $response;

  public function __construct ($response) {
    if (is_string($response) && (preg_match('/^{/', $response) || preg_match('/^\[{/', $response))) {
      $response = json_decode($response, true);
    }
    $this->response = $response;
  }

  public function toJSON () {
    return json_encode($this->response);
  }

  public function toArray () {
    return $this->response;
  }
  
}