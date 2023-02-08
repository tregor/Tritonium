<?php

return [
	'admin' => 'DefaultController@index',
	
	'admin/<modelname>/list'        => 'ModelsController@modelList',
	'admin/<modelname>/create'      => 'ModelsController@modelCreate',
	'admin/<modelname>/save'        => 'ModelsController@modelSave',
	'admin/<modelname>/<id>/save'   => 'ModelsController@modelSave',
	'admin/<modelname>/<id>/view'   => 'ModelsController@modelView',
	'admin/<modelname>/<id>/edit'   => 'ModelsController@modelEdit',
	'admin/<modelname>/<id>/copy'   => 'ModelsController@modelCopy',
	'admin/<modelname>/<id>/delete' => 'ModelsController@modelDelete',
];