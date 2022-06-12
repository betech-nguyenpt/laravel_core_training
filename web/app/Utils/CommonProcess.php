<?php

namespace App\Utils;


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CommonProcess
 *
 * @author nguyenpt
 */
class CommonProcess
{
    /**
     * Get class of object
     * @param Model $obj Object model
     * @return String Class name
     */
    public static function getClass($obj)
    {
        return (new \ReflectionClass($obj))->getShortName();
    }
    
    /**
     * Get IP address of current user
     * @return string IP address
     */
    public static function getUserIP()
    {
        return \Request::ip();
    }
    
    /**
     * Get session ID of current user
     * @return string Session ID
     */
    public static function getUserSession()
    {
        return 'Session';
    }
    /**
     * Create random string.
     * @param Int $len          Length of result
     * @param String $charset   Default string
     * @return String           Random string
     */
    public static function randString($len = 6, $charset = 'ABCDEFGHIJKLMNPQRSTUVWXYZabcdefghijklmnpqrstuvwxyz123456789') {
        $str = '';
        $count = strlen($charset);
        while ($len--) {
            $str .= $charset[mt_rand(0, $count - 1)];
        }
        return $str;
    }
    
    /**
     * Get random value from array
     * @param Array $array Array object
     * @return Object Object after random
     */
    public static function randArray($array) {
        $count = count($array);
        $retVal = $array[mt_rand(0, $count - 1)];
        return $retVal;
    }
    
    /**
     * Generate session id
     * @return String session id
     */
    public static function generateSessionId() {
        $retVal = md5(time() . CommonProcess::randString(16));
        return $retVal;
    }
    
    /**
     * Get country of current user from IP address
     * @param string $ip IP address
     * @return string Country name
     */
    public static function getUserCountry($ip)
    {
        try {
            $details = json_decode(file_get_contents('http://www.geoplugin.net/json.gp?ip={' . $ip . '}'));
                if (isset($details->geoplugin_countryName)) {
                return $details->geoplugin_countryName;
            }
        } catch (\Exception $exc) {
            \Modules\Admin\Entities\AdminLogger::error(
                    'Error when dowload geo-plugin',
                    self::json_encode_unicode($exc->getTraceAsString()),
                    __CLASS__ . '::' . __FUNCTION__ . '(' . __LINE__ . ')');
        }
        
        return '';
    }
    
    /**
     * Get value in array
     * @param Array $array Array of data
     * @param String $key Value of key
     * @param Object $defaultValue Default value
     * @return String Value after get from array
     */
    public static function getValue($array, $key, $defaultValue = '')
    {
        $retVal = $defaultValue;
        if (isset($array[$key])) {
            $retVal = $array[$key];
        }
        return $retVal;
    }
    
    /**
     * Get list browsers
     * @return Array List browsers
     */
    public static function getListBrowsers()
    {
        return array(
            '/msie/i'       => 'Internet Explorer',
            '/firefox/i'    => 'Firefox',
            '/safari/i'     => 'Safari',
            '/chrome/i'     => 'Chrome',
            '/edge/i'       => 'Edge',
            '/opera/i'      => 'Opera',
            '/netscape/i'   => 'Netscape',
            '/maxthon/i'    => 'Maxthon',
            '/konqueror/i'  => 'Konqueror',
            '/mobile/i'     => 'Handheld Browser'
        );
    }
    
    /**
     * Get current browser
     * @return string Name of browser
     */
    public static function getBrowser() {
        $browser = "Unknown Browser";
        $user_agent = self::getValue($_SERVER, 'HTTP_USER_AGENT');
        if (empty($user_agent)) {
            return $browser;
        }

        $browser_array = self::getListBrowsers();

        foreach ($browser_array as $regex => $value) {
            if (preg_match($regex, $user_agent)) {
                $browser = $value;
            }
        }

        return $browser;
    }
    
    /**
     * Get list Operation System
     * @return Array Key=>Value
     */
    public static function getListOSs() {
        return [
            'windows nt 10' => 'Windows 10',
            'windows nt 6.3' => 'Windows 8.1',
            'windows nt 6.2' => 'Windows 8',
            'windows nt 6.1|windows nt 7.0' => 'Windows 7',
            'windows nt 6.0' => 'Windows Vista',
            'windows nt 5.2' => 'Windows Server 2003/XP x64',
            'windows nt 5.1' => 'Windows XP',
            'windows xp' => 'Windows XP',
            'windows nt 5.0|windows nt5.1|windows 2000' => 'Windows 2000',
            'windows me' => 'Windows ME',
            'windows nt 4.0|winnt4.0' => 'Windows NT',
            'windows ce' => 'Windows CE',
            'windows 98|win98' => 'Windows 98',
            'windows 95|win95' => 'Windows 95',
            'win16' => 'Windows 3.11',
            'mac os x 10.1[^0-9]' => 'Mac OS X Puma',
            'macintosh|mac os x' => 'Mac OS X',
            'mac_powerpc' => 'Mac OS 9',
            'linux' => 'Linux',
            'ubuntu' => 'Linux - Ubuntu',
            'iphone' => 'iPhone',
            'ipod' => 'iPod',
            'ipad' => 'iPad',
            'android' => 'Android',
            'blackberry' => 'BlackBerry',
            'webos' => 'Mobile',
            '(media center pc).([0-9]{1,2}\.[0-9]{1,2})' => 'Windows Media Center',
            '(win)([0-9]{1,2}\.[0-9x]{1,2})' => 'Windows',
            '(win)([0-9]{2})' => 'Windows',
            '(windows)([0-9x]{2})' => 'Windows',
            // Doesn't seem like these are necessary...not totally sure though..
            //'(winnt)([0-9]{1,2}\.[0-9]{1,2}){0,1}'=>'Windows NT',
            //'(windows nt)(([0-9]{1,2}\.[0-9]{1,2}){0,1})'=>'Windows NT', // fix by bg
            'Win 9x 4.90' => 'Windows ME',
            '(windows)([0-9]{1,2}\.[0-9]{1,2})' => 'Windows',
            'win32' => 'Windows',
            '(java)([0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,2})' => 'Java',
            '(Solaris)([0-9]{1,2}\.[0-9x]{1,2}){0,1}' => 'Solaris',
            'dos x86' => 'DOS',
            'Mac OS X' => 'Mac OS X',
            'Mac_PowerPC' => 'Macintosh PowerPC',
            '(mac|Macintosh)' => 'Mac OS',
            '(sunos)([0-9]{1,2}\.[0-9]{1,2}){0,1}' => 'SunOS',
            '(beos)([0-9]{1,2}\.[0-9]{1,2}){0,1}' => 'BeOS',
            '(risc os)([0-9]{1,2}\.[0-9]{1,2})' => 'RISC OS',
            'unix' => 'Unix',
            'os/2' => 'OS/2',
            'freebsd' => 'FreeBSD',
            'openbsd' => 'OpenBSD',
            'netbsd' => 'NetBSD',
            'irix' => 'IRIX',
            'plan9' => 'Plan9',
            'osf' => 'OSF',
            'aix' => 'AIX',
            'GNU Hurd' => 'GNU Hurd',
            '(fedora)' => 'Linux - Fedora',
            '(kubuntu)' => 'Linux - Kubuntu',
            '(ubuntu)' => 'Linux - Ubuntu',
            '(debian)' => 'Linux - Debian',
            '(CentOS)' => 'Linux - CentOS',
            '(Mandriva).([0-9]{1,3}(\.[0-9]{1,3})?(\.[0-9]{1,3})?)' => 'Linux - Mandriva',
            '(SUSE).([0-9]{1,3}(\.[0-9]{1,3})?(\.[0-9]{1,3})?)' => 'Linux - SUSE',
            '(Dropline)' => 'Linux - Slackware (Dropline GNOME)',
            '(ASPLinux)' => 'Linux - ASPLinux',
            '(Red Hat)' => 'Linux - Red Hat',
            // Loads of Linux machines will be detected as unix.
            // Actually, all of the linux machines I've checked have the 'X11' in the User Agent.
            //'X11'=>'Unix',
            '(linux)' => 'Linux',
            '(amigaos)([0-9]{1,2}\.[0-9]{1,2})' => 'AmigaOS',
            'amiga-aweb' => 'AmigaOS',
            'amiga' => 'Amiga',
            'AvantGo' => 'PalmOS',
            //'(Linux)([0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,3}(rel\.[0-9]{1,2}){0,1}-([0-9]{1,2}) i([0-9]{1})86){1}'=>'Linux',
            //'(Linux)([0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,3}(rel\.[0-9]{1,2}){0,1} i([0-9]{1}86)){1}'=>'Linux',
            //'(Linux)([0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,3}(rel\.[0-9]{1,2}){0,1})'=>'Linux',
            '[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,3})' => 'Linux',
            '(webtv)/([0-9]{1,2}\.[0-9]{1,2})' => 'WebTV',
            'Dreamcast' => 'Dreamcast OS',
            'GetRight' => 'Windows',
            'go!zilla' => 'Windows',
            'gozilla' => 'Windows',
            'gulliver' => 'Windows',
            'ia archiver' => 'Windows',
            'NetPositive' => 'Windows',
            'mass downloader' => 'Windows',
            'microsoft' => 'Windows',
            'offline explorer' => 'Windows',
            'teleport' => 'Windows',
            'web downloader' => 'Windows',
            'webcapture' => 'Windows',
            'webcollage' => 'Windows',
            'webcopier' => 'Windows',
            'webstripper' => 'Windows',
            'webzip' => 'Windows',
            'wget' => 'Windows',
            'Java' => 'Unknown',
            'flashget' => 'Windows',
            // delete next line if the script show not the right OS
            //'(PHP)/([0-9]{1,2}.[0-9]{1,2})'=>'PHP',
            'MS FrontPage' => 'Windows',
            '(msproxy)/([0-9]{1,2}.[0-9]{1,2})' => 'Windows',
            '(msie)([0-9]{1,2}.[0-9]{1,2})' => 'Windows',
            'libwww-perl' => 'Unix',
            'UP.Browser' => 'Windows CE',
            'NetAnts' => 'Windows',
        ];
    }
    
    /**
     * Get current Operation system
     * @param type $user_agent
     * @return string
     */
    public static function getOS($user_agent = null) {
        if (!isset($user_agent) && isset($_SERVER['HTTP_USER_AGENT'])) {
            $user_agent = $_SERVER['HTTP_USER_AGENT'];
        } else {
            return "Unknown OS";
        }

        // https://stackoverflow.com/questions/18070154/get-operating-system-info-with-php
        $os_array = self::getListOSs();

        // https://github.com/ahmad-sa3d/php-useragent/blob/master/core/user_agent.php
        $arch_regex = '/\b(x86_64|x86-64|Win64|WOW64|x64|ia64|amd64|ppc64|sparc64|IRIX64)\b/ix';
        $arch = preg_match($arch_regex, $user_agent) ? '64' : '32';

        foreach ($os_array as $regex => $value) {
            if (preg_match('{\b(' . $regex . ')\b}i', $user_agent)) {
                return $value . ' x' . $arch;
            }
        }

        return 'Unknown';
    }

    /**
     * Check phone or email
     * @param string $phone Phone or Email
     * @return boolean Return true if string is phone
     */
    public static function isPhone($phone) {
        $str = 'abcdefghijklmnopqrstuvwxyz@';
        if (strpbrk($phone, $str)){
            return false;
        }
        return true;
    }
    
    //-----------------------------------------------------
    // ++ Handle json string
    //-----------------------------------------------------
    /**
     * Convert json encode
     * @param Array $data Key=>Value array
     * @return String Json string
     */
    public static function json_encode_unicode($data) {
        if (defined('JSON_UNESCAPED_UNICODE')) {
            return json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        return preg_replace_callback('/(?<!\\\\)\\\\u([0-9a-f]{4})/i', function ($m) {
            $d = pack("H*", $m[1]);
            $r = mb_convert_encoding($d, "UTF8", "UTF-16BE");
            return $r !== "?" && $r !== "" ? $r : $m[0];
        }, json_encode($data)
        );
    }
    
    /**
     * Create pretty json
     * @param String $json Json string
     * @return string Json string after formated
     */
    public static function prettyPrint($json) {
        $result = '';
        $level = 0;
        $in_quotes = false;
        $in_escape = false;
        $ends_line_level = NULL;
        $json_length = strlen($json);

        for ($i = 0; $i < $json_length; $i++) {
            $char = $json[$i];
            $new_line_level = NULL;
            $post = "";
            if ($ends_line_level !== NULL) {
                $new_line_level = $ends_line_level;
                $ends_line_level = NULL;
            }
            if ($in_escape) {
                $in_escape = false;
            } else if ($char === '"') {
                $in_quotes = !$in_quotes;
            } else if (!$in_quotes) {
                switch ($char) {
                    case '}': case ']':
                        $level--;
                        $ends_line_level = NULL;
                        $new_line_level = $level;
                        break;

                    case '{': case '[':
                        $level++;
                    case ',':
                        $ends_line_level = $level;
                        break;

                    case ':':
                        $post = " ";
                        break;

                    case " ": case "\t": case "\n": case "\r":
                        $char = "";
                        $ends_line_level = $new_line_level;
                        $new_line_level = NULL;
                        break;
                }
            } else if ($char === '\\') {
                $in_escape = true;
            }
            if ($new_line_level !== NULL) {
                $result .= "\n" . str_repeat("\t", $new_line_level);
            }
            $result .= $char . $post;
        }

        return $result;
    }

    /**
     * Create config json
     * @param String $id Id value
     * @param String $name Name value
     * @param Object $data Data value
     * @return String
     *  {
     *      id: "$id",
     *      name: "$name",
     *      data: $data
     *  }
     */
    public static function createConfigJson($id, $name, $data = '') {
        if ($data === '') {
            return array(
                DomainConst::KEY_ID => $id,
                DomainConst::KEY_NAME => isset($name) ? $name : '',
            );
        }
        return array(
            DomainConst::KEY_ID => $id,
            DomainConst::KEY_NAME => isset($name) ? $name : '',
            DomainConst::KEY_DATA => isset($data) ? $data : ''
        );
    }

    //-----------------------------------------------------
    // -- Handle json string
    //-----------------------------------------------------

    /**
     * Create GUID
     * @return String GUID string
     */
    public static function createGUID()
    {
        if (function_exists('com_create_guid') === true) {
            return trim(com_create_guid(), '{}');
        }
        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }
}
