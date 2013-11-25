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
    var $Usuario;
    
	
	public function indexAction()
    {
    	$this->Usuario = $this->getServiceLocator()->get('Curso\Service\UsuarioService');
    	$usuarios = $this->Usuario->find();
    	$parametros['usuarios'] = $usuarios;
        return new ViewModel($parametros);
    }
    
    public function saveAction()
    {    	    	
    	$this->Usuario = $this->getServiceLocator()->get('Curso\Service\UsuarioService');
    	if(!empty($_POST))
        {
            $this->Usuario->save($_POST);
            return $this->redirect()->toRoute('usuario');
        }
    	return new ViewModel();
    }
    
    public function editAction()
    {
        $this->Usuario = $this->getServiceLocator()->get('Curso\Service\UsuarioService');
        if(!empty($_POST))
        {
            $this->Usuario->setId($_POST['id']);
            $this->Usuario->setNombre($_POST['nombre']);
            $this->Usuario->setApellidoPaterno($_POST['paterno']);
            $this->Usuario->setApellidoMaterno($_POST['materno']);
            $this->Usuario->edit();
            
            return $this->redirect()->toRoute('usuario');
        }
        else
        {
            $this->Usuario->loadById($this->params()->fromRoute()['id']);
            $parammetros['usuario'] = $this->Usuario;
        }
    	return new ViewModel($parammetros);
    }
    
    public function deleteAction()
    {
        $this->Usuario = $this->getServiceLocator()->get('Curso\Service\UsuarioService');
        $this->Usuario->loadById($this->params()->fromRoute()['id']);
        $this->Usuario->delete();
        $this->redirect()->toRoute('usuario');
    	return new ViewModel();
    }
}
