<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Request;

class Agent
{
    protected $userAgent;

    public function __construct()
    {
        $this->userAgent = Request::header('User-Agent') ?? '';
    }

    public function device()
    {
        if (preg_match('/(tablet|ipad|playbook|silk)|(android(?!.*mobi))/i', $this->userAgent)) {
            return 'Tablet';
        }
        if (preg_match('/(up\.browser|up\.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', $this->userAgent)) {
            return 'Mobile';
        }
        if (preg_match('/macintosh|mac os x/i', $this->userAgent)) {
            return 'Mac';
        }
        if (preg_match('/windows|win32/i', $this->userAgent)) {
            return 'Windows';
        }
        if (preg_match('/linux/i', $this->userAgent)) {
            return 'Linux';
        }
        return 'Desktop';
    }

    public function browser()
    {
        $browser = 'Unknown Browser';
        $browsers = [
            '/msie/i'      => 'Internet Explorer',
            '/firefox/i'   => 'Firefox',
            '/safari/i'    => 'Safari',
            '/chrome/i'    => 'Chrome',
            '/edge/i'      => 'Edge',
            '/opera/i'     => 'Opera',
            '/netscape/i'  => 'Netscape',
            '/maxthon/i'   => 'Maxthon',
            '/konqueror/i' => 'Konqueror',
            '/mobile/i'    => 'Handheld Browser'
        ];

        foreach ($browsers as $regex => $value) {
            if (preg_match($regex, $this->userAgent)) {
                $browser = $value;
                if ($value === 'Chrome') {
                    if (preg_match('/edge/i', $this->userAgent) || preg_match('/edg/i', $this->userAgent)) {
                        $browser = 'Edge';
                    } elseif (preg_match('/opera/i', $this->userAgent) || preg_match('/opr/i', $this->userAgent)) {
                        $browser = 'Opera';
                    }
                }
                if ($value === 'Safari') {
                    if (preg_match('/chrome/i', $this->userAgent) || preg_match('/crios/i', $this->userAgent)) {
                        $browser = 'Chrome';
                    }
                }
            }
        }

        return $browser;
    }

    public function platform()
    {
        $osPlatform = 'Unknown OS';
        $osArray = [
            '/windows nt 10/i'      => 'Windows 10/11',
            '/windows nt 6.3/i'     => 'Windows 8.1',
            '/windows nt 6.2/i'     => 'Windows 8',
            '/windows nt 6.1/i'     => 'Windows 7',
            '/windows nt 6.0/i'     => 'Windows Vista',
            '/windows nt 5.2/i'     => 'Windows Server 2003/XP x64',
            '/windows nt 5.1/i'     => 'Windows XP',
            '/windows xp/i'         => 'Windows XP',
            '/windows nt 5.0/i'     => 'Windows 2000',
            '/windows me/i'         => 'Windows ME',
            '/win98/i'              => 'Windows 98',
            '/win95/i'              => 'Windows 95',
            '/win16/i'              => 'Windows 3.11',
            '/macintosh|mac os x/i' => 'Mac OS X',
            '/mac_powerpc/i'        => 'Mac OS 9',
            '/linux/i'              => 'Linux',
            '/ubuntu/i'             => 'Ubuntu',
            '/iphone/i'             => 'iOS (iPhone)',
            '/ipod/i'               => 'iOS (iPod)',
            '/ipad/i'               => 'iOS (iPad)',
            '/android/i'            => 'Android',
            '/blackberry/i'         => 'BlackBerry',
            '/webos/i'              => 'Mobile'
        ];

        foreach ($osArray as $regex => $value) {
            if (preg_match($regex, $this->userAgent)) {
                $osPlatform = $value;
            }
        }

        return $osPlatform;
    }
}
