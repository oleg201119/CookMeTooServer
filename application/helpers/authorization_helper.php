<?php

require_once APPPATH . 'libraries/JWT.php';

use \Firebase\JWT\JWT;

class Authorization
{
    public static function validateToken($token)
    {
        $CI =& get_instance();
        $key = $CI->config->item('jwt_key');
        $algorithm = $CI->config->item('jwt_algorithm');
        return JWT::decode($token, $key, array($algorithm));
    }

    public static function generateToken($data)
    {
        $CI =& get_instance();
        $key = $CI->config->item('jwt_key');
        $algorithm = $CI->config->item('jwt_algorithm');
        return JWT::encode($data, $key);
    }

    public static function tokenIsExist($headers)
    {
        if (array_key_exists('Authorization', $headers)) {
            return !empty($headers['Authorization']);
        }

        if (array_key_exists('authorization', $headers)) {
            return !empty($headers['authorization']);
        }

        return false;
    }

    public static function tokenInHeader($headers)
    {
        if (array_key_exists('Authorization', $headers)) {
            return ($headers['Authorization']);
        }

        if (array_key_exists('authorization', $headers)) {
            return ($headers['authorization']);
        }

        return '';
    }
}
