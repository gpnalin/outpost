<?php

namespace Outpost\Events;

use Symfony\Component\HttpFoundation\Request;

class RequestReceivedEvent extends Event {

  public function __construct(Request $request) {
    parent::__construct();
    $this->request = $request;
  }

  /**
   * @return string
   */
  public function getLogMessage() {
    return "Request received: " . $this->request->getPathInfo();
  }
}