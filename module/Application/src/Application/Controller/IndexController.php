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
use Application\Service\UsuarioService;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
    
    public function holaAction()
    {
    	$usuario = new UsuarioService();	
    	$usuario->setNombre("Jose Ruben");
    	$usuario->setApellidoPaterno("Rubio");
    	$usuario->setApellidoMaterno("Herrera");
    	
    	echo get_class($usuario);
    	    	
    	$parametros['nombre'] = 'Jose Ruben Rubio Herrera';
    	$parametros['objeto_usuario'] = $usuario;
    	
    	return new ViewModel($parametros);
    }
}
