<?php

namespace Modules\Api\Entities;

use App\Utils\CommonProcess;
use Modules\Admin\Entities\AdminLogger;
use Modules\Admin\Entities\AdminUser;

/**
 * This is the model class for table "api_request_logs".
 *
 * @property int $id                Id
 * @property string $ip_address     IP address
 * @property string $method         Method
 * @property string $request        Request body
 * @property string $response       Response body
 * @property int $response_time     Time response
 * @property int $status            Status
 * @property int $created_by        Created by
 * @property string $created_at     Created date
 * @property string $updated_at     Updated date
 */
class ApiRequestLog extends ApiModel
{
    //-----------------------------------------------------
    // Properties
    //-----------------------------------------------------
    /** Fillable array */
    protected $fillable = [
        'ip_address', 'method', 'request', 'response', 'response_time', 'status', 'created_by',
    ];
    
    //-----------------------------------------------------
    // Utility methods
    //----------------------------------------------------
    /**
     * {@inheritdoc}
     */
    public function getShowLink()
    {
        return url('api/api-request-logs', ['id' => $this->id]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function save(array $options = array()) {
        $this->ip_address = CommonProcess::getUserIP();
        
        return parent::save($options);
    }
    
    /**
     * Get response value
     * @return string
     */
    public function getResponse() {
        try {
            // strip tags to avoid breaking any html
            $string = strip_tags($this->response);
            $maxLen = 300;
            if (strlen($string) > $maxLen) {
                // truncate string
                $stringCut = substr($string, 0, $maxLen);
                $endPoint = strrpos($stringCut, ' ');

                //if the string doesn't contain any space then it will cut without word basis.
                $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                $string .= '...[More]';
            }
            return $string;
        } catch (Exception $ex) {
            AdminLogger::error('Exception', '' . $ex->getMessage(), __METHOD__ . '(' . __LINE__ . ')');
        }
    }
    
    /**
     * Get ip address
     * @return String IP address
     */
    public function getIP() {
        return implode('<br>', [$this->ip_address, CommonProcess::getUserCountry($this->ip_address)]);
    }
    
    /**
     * Get module name
     * @return AdminModule Module object
     */
    public function getUser()
    {
        return AdminUser::find($this->created_by);
    }
    
    /**
     * Get link to user show
     * @return string Html string
     */
    public function getUserLink() {
        $user = $this->getUser();
        if ($user) {
            return $user->getShowLinkTag('name');
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
        ];
    }
    
    /**
     * Insert record
     * @param String $method        Method
     * @param String $request       Message
     * @param String $user_id       Level
     */
    public static function insertOne($user_id)
    {
        $model = new ApiRequestLog();
        $data = '';
        $method = filter_input(INPUT_SERVER, 'REQUEST_METHOD');
        switch ($method) {
            case 'POST':
                $data = filter_input_array(INPUT_POST);
                break;
            case 'GET':
                $data = filter_input_array(INPUT_GET);
                break;
            default:
                break;
        }
        $uri = filter_input(INPUT_SERVER, 'REQUEST_URI');
        $model->method          = $method . ': ' . $uri;
        $model->request         = var_export($data, true);
        $model->created_by      = $user_id;
        $model->save();
    }
}
