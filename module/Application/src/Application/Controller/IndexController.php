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
use Curso\Service\UsuarioService;
//use Application\Service\UsuarioService;
//use Curso\Service\UsuarioService;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
    	echo "Hola Mundo Estoy en ACTION INDEX";
        return new ViewModel();
    }
    
    public function holaAction()
    {
    	
    	
    	
    	$usuario = $this->getServiceLocator()->get('Curso\Service\UsuarioService');
    	//$usuario->testDB();
    	
    	//$usuario = new UsuarioService();	
    	$usuario->setNombre("Jose Ruben");
    	$usuario->setApellidoPaterno("Rubio");
    	$usuario->setApellidoMaterno("Herrera");
    	
    	$usuario->loadById($this->params()->fromRoute()['id']);
    	
    	
    	
    	$usuario->save();
    	
    	echo get_class($usuario);
    	    	
    	$parametros['nombre'] = 'Jose Ruben Rubio Herrera';
    	$parametros['objeto_usuario'] = $usuario;
    	    	
    	return new ViewModel($parametros);
    }
}
