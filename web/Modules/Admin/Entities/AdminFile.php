<?php

namespace Modules\Admin\Entities;

use App\Entities\RootModel;
use App\Utils\CommonProcess;
use App\Utils\StringExt;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

/**
 * This is the model class for table "admin_files".
 *
 * @property int $id                    Id
 * @property int $type                  type
 * @property int $belong_id             Belong id
 * @property int $file_type             File type
 * @property int $order_number          Order number
 * @property string $file_name          File name
 * @property string $description        Description
 * @property int $status                Status
 * @property datetime $created_date     Created date
 * @property int $created_by            Created by
 */
class AdminFile extends RootModel
{
    public $timestamps = false;

    //-----------------------------------------------------
    // Constants
    //-----------------------------------------------------
    //File Types
    const FILE_TYPE_IMAGE               = 1;
    const FILE_TYPE_DOCUMENT            = 2;
    const FILE_TYPE_VIDEO               = 3;
    const FILE_TYPE_OTHER               = 4;

    //Allowed File Extension
    const ALLOW_FILE_EXTENSION_IMAGE    = ['jpg', 'png'];
    const ALLOW_FILE_EXTENSION_DOCUMENT = ['pdf', 'xls', 'xlsx', 'doc', 'docx', 'ptt', 'pptx'];
    const ALLOW_FILE_EXTENSION_VIDEO    = ['mp4', '3gp'];
    const ALLOW_FILE_EXTENSION_ORTHER   = ['txt', 'csv', 'psd'];

    //Relation Types
    const RELATION_TYPE_USER_AVATAR     = 1;

    //Status
    const STATUS_ACTIVE                 = 1;
    const STATUS_INACTIVE               = 0;

    // Path upload file
    const UPLOAD_PATH                   = 'uploads/';

    // Setting key: normal size image
    const KEY_NORMAL_SIZE               = 'size1024x900';
    // Setting key: thumb size image
    const KEY_SMALL_SIZE                = 'size128x96';
    const IMG_SIZE_SMALL_W              = 128;
    const IMG_SIZE_SMALL_H              = 96;
    const IMG_SIZE_NORMAL_W             = 1024;
    const IMG_SIZE_NORMAL_H             = 900;
    
    // Array type => Model's name
    public const TYPE_ARRAY = [
        self::RELATION_TYPE_USER_AVATAR => 'AdminUser',
    ];
    
    // Array of type need resize image before save
    public const TYPE_RESIZE_IMAGE = [
        self::RELATION_TYPE_USER_AVATAR,
    ];

    //-----------------------------------------------------
    // Override methods
    //-----------------------------------------------------
    /**
     * Override methods delete. Delete file if exists
     *
     * @return void
     */
    public function delete()
    {
        $this->deleteFile();
        parent::delete();
    }

    //-----------------------------------------------------
    // Properties
    //-----------------------------------------------------
    /** Fillable array */
    protected $fillable = [
        'type', 'belong_id', 'file_type', 'order_number', 'file_name', 'description', 'status', 'created_date', 'created_by',
    ];

    //-----------------------------------------------------
    // Utility methods
    //----------------------------------------------------
    /**
     * {@inheritdoc}
     */
    public function getShowLink()
    {
        return url('admin/admin-files', ['id' => $this->id]);
    }

    /**
     * Get Name File Type
     * @return string
     */
    public function getNameFileType()
    {
        if (isset(self::getArrayFileType()[$this->file_type])) {
                return self::getArrayFileType()[$this->file_type];
        }
        return '';
    }

    /**
     * Get Name Relation Type
     * @return string
     */
    public function getNameRelationType()
    {
        if (isset(self::getArrayRelationType()[$this->type])) {
            return self::getArrayRelationType()[$this->type];
        }
        return '';
    }

    /**
     * Get Name Status
     * @return string
     */
    public function getNameStatus()
    {
        if (isset(self::getArrayRelationType()[$this->status])) {
            return self::getArrayRelationType()[$this->status];
        }
        return '';
    }

    /**
     * Get API data
     * @return Array Key=>Value array
     */
    public function getApiData()
    {
        return [
            'thumb' => $this->getThumbURL($this->file_name),
            'large' => $this->getFileURL($this->file_name),
        ];
    }

    /**
     * Get file URL
     * @return String URL file
     */
    public function getFileURL()
    {
        return AdminSetting::getValue('domain') . DIRECTORY_SEPARATOR . self::UPLOAD_PATH . $this->file_name;
    }

    /**
     * Get thumb URL
     * @return String URL thumb
     */
    public function getThumbURL()
    {
        return AdminSetting::getValue('domain') . DIRECTORY_SEPARATOR . self::UPLOAD_PATH . self::getThumbName($this->file_name);
    }

    /**
     * Get file directory
     * @return String File directory
     */
    public function getFileDirectory()
    {
        return DIRECTORY_SEPARATOR . self::UPLOAD_PATH . $this->file_name;
    }

    /**
     * Get view image
     * @param String $width Width of image view
     * @return string Html string
     */
    public function getViewThumbCommon($width)
    {
        if (empty($this->file_name)) {
            return '';
        }
        $str = "<a class='gallery' target='_blank' href='"
            . $this->getFileURL($this->file_name) . "'>"
            . "<img width='" . $width . "' src='"
            . AdminSetting::getValue('domain') . DIRECTORY_SEPARATOR . self::UPLOAD_PATH . $this->getNameFileType($this->file_type) . ".png'>"
            . "</a>";
        return $str;
    }

    /**
     * Get view image
     * @param String $width Width of image view
     * @return string Html string
     */
    public function getViewThumbImage($width)
    {
        if (empty($this->file_name)) {
            return '';
        }
        $str = "<a class='gallery' target='_blank' href='"
            . $this->getFileURL() . "'>"
            . "<img width='" . $width . "' src='"
            . $this->getThumbURL() . "'>"
            . "</a>";
        return $str;
    }

    /**
     * Delete File
     *
     * @param  mixed $file_name
     * @return void
     */
    public function deleteFile()
    {
        if (self::UPLOAD_PATH . $this->file_name) {
            File::delete(self::UPLOAD_PATH . $this->file_name);
        }
        if (self::UPLOAD_PATH . self::getThumbName($this->file_name)) {
            File::delete(self::UPLOAD_PATH . self::getThumbName($this->file_name));
        }
    }

    /**
     * Get user name of created_by
     * @return string Name of created
     */
    public function getCreatorName()
    {
        $createdUser = AdminUser::find($this->created_by);
        if ($createdUser) {
            return $createdUser->username;
        }
        return '';
    }

    //-----------------------------------------------------
    // Static methods
    //-----------------------------------------------------
    /**
     * Get Allow File Extension By Type
     *
     * @param  mixed $file_type
     * @return array
     */
    public static function getAllowFileExtensionByType($file_type)
    {
        switch ($file_type) {
            case self::FILE_TYPE_IMAGE:
                $allowedfileExtension = self::ALLOW_FILE_EXTENSION_IMAGE;
                break;
            case self::FILE_TYPE_DOCUMENT:
                $allowedfileExtension = self::ALLOW_FILE_EXTENSION_DOCUMENT;
                break;
            case self::FILE_TYPE_VIDEO:
                $allowedfileExtension = self::ALLOW_FILE_EXTENSION_VIDEO;
                break;
            case self::FILE_TYPE_OTHER:
                $allowedfileExtension = self::ALLOW_FILE_EXTENSION_ORTHER;
                break;
            default:
                break;
        }
        return $allowedfileExtension;
    }

    /**
     * Check if file need resize.
     * @return boolean True if need resize, False otherwise
     */
    public static function needResize($type)
    {
        return in_array($type, self::TYPE_RESIZE_IMAGE);
    }

    /**
     * Upload file
     * @return string $fileName
     */
    public static function uploadFile($request)
    {
        $allowedfileExtension = self::getAllowFileExtensionByType($request->file_type);
        if ($request->hasFile('fileUpload')) {
            $file = $request->file('fileUpload');
            $extension = $file->getClientOriginalExtension();
            $checkExtension = in_array($extension, $allowedfileExtension);
            if (!$checkExtension) {
                return '';
            } else {
                $fileName = CommonProcess::createGUID() . '.' . $file->getClientOriginalExtension();
                $file->move(self::UPLOAD_PATH, $fileName);
                if (self::needResize($request->type) && $request->file_type == self::FILE_TYPE_IMAGE) {
                    $width = self::IMG_SIZE_SMALL_W;
                    $height = self::IMG_SIZE_SMALL_H;
                    $thumbName = self::getThumbName($fileName);
                    $path = self::UPLOAD_PATH . $fileName;
                    if (!file_exists(self::UPLOAD_PATH)) {
                        mkdir(self::UPLOAD_PATH, 666, true);
                    }
                    Image::make($path)
                        ->resize($width, $height)
                        ->save(self::UPLOAD_PATH . $thumbName);
                }
                return $fileName;
            }
        }
    }

    /**
     * Get thumb image name
     * @return String Thumb image name
     */
    public static function getThumbName($filename)
    {
        $ext = self::getExtension($filename);
        return str_replace($ext, '', $filename) . '_thumb' . $ext;
    }

    /**
    * Get extension of file from file name
    * Example:
    * 51B4762991AA.JPG => .JPG
    * @return String Extension of file
    */
    public static function getExtension($filename) {
        $len = strlen($filename);
        $dotPos = strpos($filename, '.');
        return substr($filename, $dotPos, $len - $dotPos);
    }

    /**
     * {@inheritdoc}
     */
    public static function getRules()
    {
        return [
            'status' => 'required',
            'created_date' => 'required',
            'created_by' => 'required',
        ];
    }

    /**
     * Return Array File Type
     *
     * @return array
     */
    public static function getArrayFileType()
    {
        return [
            self::FILE_TYPE_IMAGE => 'Image',
            self::FILE_TYPE_DOCUMENT => 'Document',
            self::FILE_TYPE_VIDEO => 'Video',
            self::FILE_TYPE_OTHER => 'Other',
        ];
    }

    /**
     * Return Array Relation Type
     *
     * @return void
     */
    public static function getArrayRelationType()
    {
        return [
            self::RELATION_TYPE_USER_AVATAR => 'User avatar',
        ];
    }

    /**
     * Return Array Status
     *
     * @return void
     */
    public static function getArrayStatus()
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_INACTIVE => 'Deactive',
        ];
    }
}