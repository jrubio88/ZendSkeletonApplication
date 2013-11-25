<?php

return array(
		'router' => array
						(
							'routes' => array
											(
													'usuario' => array(
															'type' => 'Segment',
															'options' => array(
																	'route'    => '/usuario[/:action[/:id]]',
																	'constrains'=>array
																	(
																			'controller'=>'[a-zA-Z][a-zA-Z0-9_-]+',
																			'action'=>'[a-zA-Z][a-zA-Z0-9_-]+'
																	),
																	'defaults' => array(
																			'__NAMESPACE__'=>'Curso\Controller',
																			'controller' => 'usuario',
																			'action'     => 'index',
																	),
															),
													),
											),	
						),
		'controllers' => array(
				'invokables' => array(
						'Curso\Controller\Usuario' => 'Curso\Controller\UsuarioController'
				),
		),
		'view_manager' => array
							(
								'template_path_stack' => array
																(
																	__DIR__ . '/../view',
																)
							)
);
