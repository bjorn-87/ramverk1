<?php

namespace Bjos\Validate;


class ValidateIp
{

    /**
     * This is the index method action, it handles:
     * IP validation of the queryparameter ip.
     *
     * @return bool
     */
    public function validate(string $ip = null) : bool
    {
        if ($ip) {
            if (filter_var($ip, FILTER_VALIDATE_IP)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    /**
     * This is the index method action, it handles:
     * IP validation of the queryparameter ip.
     *
     * @return string|void  $type
     */
    public function getIpType(string $ip)
    {
        $type = null;

        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $type = "IPV4";
        } elseif (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $type = "IPV6";
        }

        return $type;
    }

    /**
     * This is the index method action, it handles:
     * IP validation of the queryparameter ip.
     *
     * @return string $host
     */
    public function getHostName(string $ip) : string
    {
        $host = gethostbyaddr($ip);
        return $host;
    }
}
