<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Curso\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UsuarioController extends AbstractActionController
{
    public function indexAction()
    {
    	$usuario = $this->getServiceLocator()->get('Curso\Service\UsuarioService');
    	$usuarios = $usuario->find();
    	$parametros['usuarios'] = $usuarios;
        return new ViewModel($parametros);
    }
    
    public function saveAction()
    {    	    	
    	return new ViewModel();
    }
    
    public function editAction()
    {
    	return new ViewModel();
    }
    
    public function deleteAction()
    {
    	return new ViewModel();
    }
}
