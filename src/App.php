<?php

namespace PhpSnipper;

use PhpSnipper\Commands\SnippetCaller;
use Symfony\Component\Console\Application;

class App extends Application {

  public function init()
  {
    $this->add(new SnippetCaller());
    $this->run();
  }

}