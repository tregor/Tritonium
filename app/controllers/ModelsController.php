<?php

namespace Tritonium\App\Controllers;

use GuzzleHttp\Client;
use Tritonium\App\Models\Task;
use Tritonium\App\Models\Update;
use Tritonium\App\Services\YelpAPI;
use Tritonium\Base\App;
use Tritonium\Base\Controllers\BaseController;

class ModelsController extends BaseController
{

    public function beforeAction()
    {
        $cookies = App::$components->request->cookies();
        $admin_token = $cookies['admin_token'];
        if (!$admin_token) {
            die('access_denied');
        }

        return true;
    }

    public function actionIndex()
    {
        App::$components->view->redirect('/admin/');
    }


    public function actionModelList($modelname)
    {
        $modelClass = '\\Tritonium\\App\\Models\\' . ucfirst($modelname);
        $models = $modelClass::all();
        $models = array_reverse($models);

        App::$components->view->render('admin.models.list', [
            'models' => $models,
            'modelname' => $modelname,
            'settings' => [
                'title' => 'Model ' . ucfirst($modelname),
            ],
        ]);
    }

    public function actionModelView($modelname, $id)
    {
        $modelClass = '\\Tritonium\\App\\Models\\' . ucfirst($modelname);
        $model = $modelClass::first($id);

        App::$components->view->render('admin.models.view', [
            'model_id' => $id,
            'model' => $model,
            'modelname' => $modelname,
            'settings' => [
                'title' => ucfirst($modelname) . ' ID: ' . $id,
                'breadcrumbs' => [
                    [ucfirst($modelname) . ' List', '/admin/' . $modelname . '/list'],
                ],
                'href_base' => '/admin/',
            ],
        ]);
    }

    public function actionModelEdit($modelname, $id)
    {
        $modelClass = '\\Tritonium\\App\\Models\\' . ucfirst($modelname);
        $model = $modelClass::first($id);

        App::$components->view->render('admin.models.edit', [
            'model_id' => $id,
            'model' => $model,
            'modelname' => $modelname,
            'settings' => [
                'title' => ucfirst($modelname) . ' ID: ' . $id,
                'breadcrumbs' => [
                    [ucfirst($modelname) . ' List', '/admin/' . $modelname . '/list'],
                    [ucfirst($modelname) . ' ID: ' . $id, '/admin/' . $modelname . '/' . $model_id . '/view'],
                ],
            ],
        ]);
    }

    public function actionModelCreate($modelname)
    {
        $modelClass = '\\Tritonium\\App\\Models\\' . ucfirst($modelname);
        $attributes = $modelClass::getAttributes();

        App::$components->view->render('admin.models.create', [
            'attributes' => $attributes,
            'modelname' => $modelname,
            'settings' => [
                'title' => 'New ' . ucfirst($modelname),
                'breadcrumbs' => [
                    [ucfirst($modelname) . ' List', '/admin/' . $modelname . '/list']
                ],
            ],
        ]);
    }

    public function actionModelCopy($modelname, $id)
    {
        $modelClass = '\\Tritonium\\App\\Models\\' . ucfirst($modelname);
        $attributes = $modelClass::getAttributes();
        $model = $modelClass::first($id);

        App::$components->view->render('admin.models.create', [
            'model_id' => $id,
            'model' => $model,
            'attributes' => $attributes,
            'modelname' => $modelname,
            'settings' => [
                'title' => 'New ' . ucfirst($modelname),
                'breadcrumbs' => [
                    [ucfirst($modelname) . ' List', '/admin/' . $modelname . '/list'],
                    [ucfirst($modelname) . ' ID: ' . $id, '/admin/' . $modelname . '/' . $model_id . '/view'],
                ],
            ],
        ]);
    }

    public function actionModelSave($modelname, $id = null)
    {
        $request = App::$components->request;
        $modelClass = '\\Tritonium\\App\\Models\\' . ucfirst($modelname);
        $attributes = $modelClass::getAttributes();

        if ($id !== null) {
            $model = $modelClass::first($id);
            $model_save = $request->post($modelname);
            $model_data = array_merge($model, $model_save);

            $modelClass::save($model_data);
            $model_id = $id;
        } else {
            $model_data = array_filter($request->post($modelname));
            $model_id = $modelClass::create($model_data);
        }
        $model = $modelClass::first($model_id);

        App::$components->view->redirect('/admin/' . $modelname . '/' . $model_id . '/view');
    }

    public function actionModelDelete($modelname, $id)
    {
        $request = App::$components->request;
        $modelClass = '\\Tritonium\\App\\Models\\' . ucfirst($modelname);
        $attributes = $modelClass::getAttributes();
        $model = $modelClass::first($id);
        if ($model) {
            $modelClass::delete($id);
        }

        App::$components->view->redirect('/admin/' . $modelname . '/list');
    }
}
