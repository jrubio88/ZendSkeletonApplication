<?php

namespace Curso\Service;

use Application\Service\UsuarioInterface;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\RowGateway\RowGateway;

class UsuarioService implements UsuarioInterface, ServiceManagerAwareInterface
{
	protected $id;
	protected $nombre;
	protected $apellidoPaterno;
	protected $apellidoMaterno;
	
	public function setServiceManager(ServiceManager $serviceManager)
	{
		$this->sm = $serviceManager;
	}
	
	public function getServiceManager()
	{
		return $this->sm;
	}
	
	public function testDB()
	{
		$adapter = $this->getServiceManager()->get('Zend\Db\Adapter\Adapter');
		/*$adapter = new \Zend\Db\Adapter\Adapter
		 (
		 		array
		 		(
		 				'driver' => 'Mysqli',
		 				'database' => 'electronica',
		 				'username' => 'root',
		 				'password' => '',
		 				'host'=>'127.0.0.1',
		 				'options'=>array('buffer_results'=>true)
		 		)
		 );*/
		$result = $adapter->query("SELECT * FROM co_usuarios WHERE id = ?",array(1));
		 
		echo get_class($result).'<br />';
		 
		$data = $result->current();
		 
		print_r($data);
	}
	
	function loadById($user_id)
	{
		$adapter = $this->getServiceManager()->get('Zend\Db\Adapter\Adapter');
		$result = $adapter->query("SELECT * FROM co_usuarios WHERE id = ?",array($user_id));
		$data = $result->current();
		if($data != null)
		{
			$this->hydrator($data);
			return true;
		}
		return false;
	}
	
	function hydrator($data)
	{
		$this->setId($data->id);
		$this->setNombre($data->nombre);
		$this->setApellidoPaterno($data->paterno);
		$this->setApellidoMaterno($data->materno);
	}
	
	function find()
	{
		$adapter = $this->getServiceManager()->get('Zend\Db\Adapter\Adapter');
		$result = $adapter->query("SELECT * FROM co_usuarios",array());
		$resultSet = new ResultSet();
		$resultSet->initialize($result);
		$usuario = null;
		$usuarios = array();
		foreach($resultSet as $row)
		{
			$usuario = new UsuarioService();
			$usuario->setId($row->id);
			$usuario->setNombre($row->nombre);
			$usuario->setApellidoPaterno($row->paterno);
			$usuario->setApellidoMaterno($row->materno);
			$usuarios[] = $usuario;
			$usuario = null;
		}
		return $usuarios;
	}
	
	function save($datos)
	{
		$adapter = $this->getServiceManager()->get('Zend\Db\Adapter\Adapter');
		$rowGateway = new RowGateway('id', 'co_usuarios', $adapter);
		$rowGateway->populate($datos);
		$rowGateway->save();
	}
	
	function edit()
	{
		$adapter = $this->getServiceManager()->get('Zend\Db\Adapter\Adapter');
		$rowGateway = new RowGateway('id', 'co_usuarios', $adapter);
		$datos['id'] = $this->id;
		$datos['nombre'] = $this->nombre;
		$datos['paterno'] = $this->apellidoPaterno;
		$datos['materno'] = $this->apellidoMaterno;
		$rowGateway->populate($datos,array(true));
		$rowGateway->save();
	}
	
	/**
	 * @return the $nombre
	 */
	public function getNombre() {
		return $this->nombre;
	}
	
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return the $apellidoPaterno
	 */
	public function getApellidoPaterno() {
		return $this->apellidoPaterno;
	}

	/**
	 * @return the $apellidoMaterno
	 */
	public function getApellidoMaterno() {
		return $this->apellidoMaterno;
	}
	
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @param field_type $nombre
	 */
	public function setNombre($nombre) {
		$this->nombre = $nombre;
	}

	/**
	 * @param field_type $apellidoPaterno
	 */
	public function setApellidoPaterno($apellidoPaterno) {
		$this->apellidoPaterno = $apellidoPaterno;
	}

	/**
	 * @param field_type $apellidoMaterno
	 */
	public function setApellidoMaterno($apellidoMaterno) {
		$this->apellidoMaterno = $apellidoMaterno;
	}
	
	
	/* (non-PHPdoc)
	 * @see \Zend\Db\RowGateway\RowGatewayInterface::delete()
	 */
	public function delete() 
	{
	    $adapter = $this->getServiceManager()->get('Zend\Db\Adapter\Adapter');
        $rowGateway = new RowGateway('id', 'co_usuarios', $adapter);
        $datos['id'] = $this->id;
        $datos['nombre'] = $this->nombre;
        $datos['paterno'] = $this->apellidoPaterno;
        $datos['materno'] = $this->apellidoMaterno;
        $rowGateway->populate($datos,array(true));
        $rowGateway->delete();
	}


	
	
}