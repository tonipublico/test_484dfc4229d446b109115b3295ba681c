<?php

//require_once '/home/toni/devel/projects/nextret20130907/deps/symfony-1.2.12/symfony-1.2.12/lib/autoload/sfCoreAutoload.class.php';
require_once 
                              __DIR__ . 
        DIRECTORY_SEPARATOR . '..' . 
        DIRECTORY_SEPARATOR . '..' . 
        DIRECTORY_SEPARATOR . 'deps' . 
        DIRECTORY_SEPARATOR . 'symfony-1.2.12' . 
        DIRECTORY_SEPARATOR . 'symfony-1.2.12' . 
        DIRECTORY_SEPARATOR . 'lib' . 
        DIRECTORY_SEPARATOR . 'autoload' . 
        DIRECTORY_SEPARATOR . 'sfCoreAutoload.class.php';

sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    // for compatibility / remove and enable only the plugins you want
    $this->enableAllPluginsExcept(array('sfDoctrinePlugin', 'sfCompat10Plugin'));
  }
}
