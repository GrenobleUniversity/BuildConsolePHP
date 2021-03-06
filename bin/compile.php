<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of compile
 *
 * @author nadir
 */


require __DIR__.'/../vendor/autoload.php';

use Symfony\Component\Console\Application as BaseApplication;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\EventDispatcher\EventDispatcher;



class compile extends BaseApplication {
   
    
     public function getHelp()
    {
        $colors = new Cli\Colors();
        return  
        
        $colors->getColoredString('==============================================================================', "red", null ) . "\n".
        $colors->getColoredString("   ______                           _ __  ____        _ __    __         
  / ____/___  ________  ______   __(_) /_/ __ )__  __(_) /___/ /__  _____
 / /   / __ \/ ___/ _ \/ ___/ | / / / __/ __  / / / / / / __  / _ \/ ___/
/ /___/ /_/ (__  )  __/ /   | |/ / / /_/ /_/ / /_/ / / / /_/ /  __/ /    
\____/\____/____/\___/_/    |___/_/\__/_____/\__,_/_/_/\__,_/\___/_/     
", "cyan") .
        $colors->getColoredString('                                                          Version 1.0.0', "red", null ) . "\n" .         
       "\n". parent::getHelp()."\n".$colors->getColoredString('==============================================================================', "red", null ) . "\n" ; 
    }

}

$container = new ContainerBuilder();
$loader = new XmlFileLoader($container, new FileLocator(__DIR__."/../conf"));
$loader->load('services/services.xml');
$dispatcher = new EventDispatcher();


$listener = new AcmeListener();
$dispatcher->addListener(  \EventDispatcher\MyEvent::NAME  , array($listener, 'onFooAction'));


$event = new \EventDispatcher\MyEvent("Nadir Fouka","45 Rue marius blanchet 80008 paris") ; 
$dispatcher->dispatch( \EventDispatcher\MyEvent::NAME , $event) ; 


$application = new compile() ; 
$application->add(new \Cli\AppCommandSymfony     );
$application->run();


class AcmeListener
{

    public function onFooAction( \EventDispatcher\MyEvent $event)
    {
                    print_r($event) ; 
    }
}