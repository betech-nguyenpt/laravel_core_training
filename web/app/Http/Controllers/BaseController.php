<?php

namespace App\Http\Controllers;

use Modules\Admin\Entities\AdminActivityLog;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Modules\Admin\Entities\AdminAction;
use Illuminate\Support\Facades\Route as FacadesRoute;
use Modules\Admin\Entities\AdminLogger;

class BaseController extends Controller
{
    //-----------------------------------------------------
    // Constants
    //-----------------------------------------------------
    const VIEW_INDEX        = 'index';
    const VIEW_FORM         = 'form';
    const VIEW_SHOW         = 'show';
    //-----------------------------------------------------
    // Properties
    //-----------------------------------------------------
    /** Class of model */
    public $modelClass      = '\App\Entities\BaseModel';
    /** Name of module */
    public $moduleName      =   '';
    /** Name of controller */
    public $controllerName  =   '';
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Route $route)
    {
        $this->middleware('auth');
        //Insert record
        $this->insertAdminActivityLog($route);
    }
    
    /**
     * {@inheritdoc}
     */
    public function callAction($method, $parameters) {
//        $this->authorizeCheck();
        return parent::callAction($method, $parameters);
    }
    
    //-----------------------------------------------------
    // Utility methods
    //-----------------------------------------------------
    /**
     * Insert data for table admin_activity_logs
     * @param Route $route Route object
     */
    public function insertAdminActivityLog($route){
        if ($this->controllerName != "admin-activity-logs") {
            $moduleName         = $this->moduleName;
            $controllerName     = $this ->controllerName;
            $actionName         = $this->getActionName($route);
            AdminActivityLog::insert($moduleName, $controllerName, $actionName);
        }
    }
    
    /**
     * Get action name
     * @return string Name of action
     */
    public function getActionName($route){
        $getAction = $route->getActionName();
        $getstrPos = strripos($getAction,'@');
        $actionName = substr($getAction,$getstrPos + 1);
        return $actionName;
    }
    
    /**
     * Check action can access
     * @param string $action_key    Key of action
     * @return boolean True if authentication user can access action, false otherwise
     */
    public function canAccess($action_key) {
        $retVal = false;
        $mAction = AdminAction::getByFullname($this->controllerName, $action_key);
        if ($mAction) {
            $retVal = $mAction->canAccess(Auth::user());
        }
        return $retVal;
    }
    
    /**
     * Check authorization
     */
    public function authorizeCheck() {
        $route = FacadesRoute::getCurrentRoute();
        $actionName         = $this->getActionName($route);
        $arrExceptActions = [
            'store',
            'update'
        ];
        // Check if action is store or update => do not check authorize
        if (in_array($actionName, $arrExceptActions)) {
            return;
        }
        $moduleName         = $this->moduleName;
        $controllerName     = $this ->controllerName;
        if ($controllerName != 'admin-loggers') {
            AdminLogger::info('Module', $moduleName, __CLASS__ . '::' . __FUNCTION__ . '(' . __LINE__ . ')');
            AdminLogger::info('Controller', $controllerName, __CLASS__ . '::' . __FUNCTION__ . '(' . __LINE__ . ')');
            AdminLogger::info('Action', $actionName, __CLASS__ . '::' . __FUNCTION__ . '(' . __LINE__ . ')');
        }
        
        $mAction = AdminAction::getByFullname($controllerName, $actionName);
        $this->authorize($moduleName . $controllerName . $actionName, $mAction);
    }
    
    /**
     * Get string name of module and controller
     * module::controller
     * @return String
     */
    public function getModuleController($needModule = true) {
        if ($needModule) {
            return $this->moduleName . '::' . $this->controllerName;
        }
        return $this->controllerName;
    }
    
    /**
     * Get index view path
     * module::controller.index
     * @return String
     */
    public function getIndexView($needModule = true) {
        return $this->getModuleController($needModule) . '.' . self::VIEW_INDEX;
    }
    
    /**
     * Get form view path
     * module::controller.form
     * @return String
     */
    public function getFormView($needModule = true) {
        return $this->getModuleController($needModule) . '.' . self::VIEW_FORM;
    }
    
    /**
     * Get show view path
     * module::controller.show
     * @return String
     */
    public function getShowView($needModule = true) {
        return $this->getModuleController($needModule) . '.' . self::VIEW_SHOW;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $controller = $this->controllerName;
        $module     = $this->moduleName;
        $models = $this->modelClass::latest('id')->paginate(5);
        $context = $this;
        return view($this->getIndexView(), compact('models', 'controller', 'module', 'context'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new $this->modelClass();
        $controller = $this->controllerName;
        return view($this->getFormView(), compact('model', 'controller'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->modelClass::getRules());
        $this->modelClass::create($request->all());
        return redirect()->route($this->getIndexView(false))
                ->with('success', 'Model created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  String  Id of model
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = $this->modelClass::find($id);
        $controller = $this->controllerName;
        return view($this->getShowView(), compact('model', 'controller'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  String  Id of model
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = $this->modelClass::find($id);
        $controller = $this->controllerName;
        return view($this->getFormView(), compact('model', 'controller'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  String  Id of model
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate($this->modelClass::getRules());
        $model = $this->modelClass::find($id);
        $model->update($request->all());
        return redirect()->route($this->getIndexView(false))
                ->with('success', 'Model updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  String  Id of model
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = $this->modelClass::find($id);
        $model->delete();
        return redirect()->route($this->getIndexView(false))
                ->with('success', 'Model deleted successfully.');
    }
}

