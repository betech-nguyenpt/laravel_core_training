<?php

namespace Modules\Admin\Entities;

/**
 * This is the model class for table "admin_menu".
 *
 * @property int $id                Id
 * @property int $action_id         Id of action belongs to
 * @property string $view           View query (Ex: ?id=1)
 * @property string $link           Menu external link
 * @property string $icon           Icon of menu
 * @property string $icon_thumb     Icon of menu (thumbnail)
 * @property int $display_order     Display order
 * @property string $name           Name
 * @property int $type              Type of menu
 * @property int $parent_id         Id of parent menu
 * @property int $status            Status
 * @property int $created_by        Created by
 * @property string $created_at     Created date
 * @property string $updated_at     Updated date
 */
class AdminMenu extends AdminModel
{
    //-----------------------------------------------------
    // Constants
    //-----------------------------------------------------
    /** Back end */
    const TYPE_BACK_END             =   '1';
    /** Front end */
    const TYPE_FRONT_END            =   '2';
    
    //-----------------------------------------------------
    // Properties
    //-----------------------------------------------------
    /** Fillable array */
    protected $fillable = [
        'name', 'action_id', 'view', 'link', 'icon', 'icon_thumb', 'display_order',
        'type', 'parent_id', 'status', 'created_by'
    ];
    
    protected $table = 'admin_menu';
    
    //-----------------------------------------------------
    // Utility methods
    //-----------------------------------------------------
    /**
     * {@inheritdoc}
     */
    public function getShowLink() {
        return url('admin/admin-menu', ['id' => $this->id]);
    }
    
    /**
     * Get action model
     * @return AdminAction Action model
     */
    public function getAction() {
        return AdminAction::find($this->action_id);
    }
    
    /**
     * Get name of action
     * @return string Name of action
     */
    public function getActionName() {
        $model = $this->getAction();
        if ($model) {
            return $model->key;
        }
        return '';
    }
    
    /**
     * Get controller model
     * @return string Name of controller
     */
    public function getController() {
        $mAction = $this->getAction();
        if ($mAction) {
            return $mAction->getController();
        }
        return null;
    }
    
    /**
     * Get link to controller show
     * @return string Html string
     */
    public function getControllerLink() {
        $controller = $this->getController();
        if ($controller) {
            return $controller->getShowLinkTag('name');
        }
        return '';
    }
    
    /**
     * Get parent object link
     * @return string Html string
     */
    public function getParentLink() {
        $mParent = self::find($this->parent_id);
        if ($mParent) {
            return $mParent->getShowLinkTag('name');
        }
        return '';
    }
    
    /**
     * Get full url of menu
     * @return string Url string
     */
    public function getFullUrl() {
        if (empty($this->link)) {
            $controller = $this->getController();
            if ($controller) {
                $mModule = $controller->getModule();
                if ($mModule) {
                    return route($controller->name . '.' . $this->getActionName());
                }
            }
        } else {
            return $this->link;
        }
        return '';
    }

    /**
     * Get type string
     * @return string Type as string
     */
    public function getTypeValue() {
        if (isset(self::getArrayTypes()[$this->type])) {
            return self::getArrayTypes()[$this->type];
        }
        return '';
    }
    
    /**
     * Get type as html format
     * @return string Type as html format
     */
    public function getType() {
        if (isset(self::getArrayTypes()[$this->type])) {
            $name = self::getArrayTypes()[$this->type];
            switch ($this->type) {
                case self::TYPE_BACK_END:
                    return '<span class="badge badge-danger">' . $name . '</span>';
                case self::TYPE_FRONT_END:
                    return '<span class="badge badge-warning">' . $name . '</span>';

                default:
                    break;
            }
            return;
        }
        return '';
    }
    
    //-----------------------------------------------------
    // Static methods
    //-----------------------------------------------------
    /**
     * {@inheritdoc}
     */
    public static function getRules()
    {
        return [
            'name'          => 'required',
        ];
    }
    
    /**
     * Get array type
     * @return Array Key=>Value array
     */
    public static function getArrayTypes() {
        return [
            self::TYPE_BACK_END     => 'Backend',
            self::TYPE_FRONT_END    => 'Frontend',
        ];
    }
    
    /**
     * Generate menu string
     * @param int $type Type of menu
     * @return string Html string
     */
    public static function generateMenu($type) {
        $retVal = '';
        switch ($type) {
            case self::TYPE_BACK_END:
                $arrMenu = AdminMenu::where('parent_id', 0)
                    ->get();
                foreach ($arrMenu as $parentMenu) {
                    $retVal .= '<li class="active has-sub">';
                    $retVal .=  '<a class="js-arrow" href="#">';
                    $retVal .=      '<i class="' . $parentMenu->icon . '"></i>' . $parentMenu->name;
                    $retVal .=      '<span class="arrow">';
                    $retVal .=          '<i class="fas fa-angle-down"></i>';
                    $retVal .=      '</span>';
                    $retVal .=  '</a>';
                    $arrChildren = AdminMenu::where('parent_id', $parentMenu->id)
                        ->get();
                    $retVal .=  '<ul class="list-unstyled navbar__sub-list js-sub-list">';
                    foreach ($arrChildren as $childMenu) {
                        $retVal .=  '<li>';
                        $retVal .=      '<a href="' . $childMenu->getFullUrl() . '">';
                        $retVal .=          '<i class="fas fa-tachometer-alt"></i>' . $childMenu->name;
                        $retVal .=      '</a>';
                        $retVal .=  '</li>';
                    }
                    $retVal .=  '</ul>';
                    $retVal .= '</li>';
                }
                
                break;
            case self::TYPE_FRONT_END:
                break;

            default:
                break;
        }
        
        return $retVal;
    }
}
