<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $redis = $this->getServiceLocator ()->get ( 'Application\Cache\Redis' );
        
        // It will clear all keys stored in redis cache
        $redis->flush();
        
        if ($redis->hasItem ( 'custom_key' )) {
            echo "Values already present\n";
        	echo $redis->getItem('custom_key');
        }else{
            echo "Values not present";
        	$redis->setItem('custom_key', 'Custom Value');
        }
        return new ViewModel();
    }
}
