<?php

class Crypto {
  const UUID_CLEAR_VER = 15;
  const UUID_VERSION_4 = 64;
  const UUID_CLEAR_VAR = 63;
  const UUID_VAR_RFC = 128;
  const ENCODE_BASE_64 = 1;

  public static function uuid() { //v4 IIUD
    $uuid = static::random(16);
    $uuid[6] = chr(ord($uuid[6]) & static::UUID_CLEAR_VER | static::UUID_VERSION_4);
    $uuid[8] = chr(ord($uuid[8]) & static::UUID_CLEAR_VAR | static::UUID_VAR_RFC);
    return join('-', array(
                           bin2hex(substr($uuid, 0, 4)),
                           bin2hex(substr($uuid, 4, 2)),
                           bin2hex(substr($uuid, 6, 2)),
                           bin2hex(substr($uuid, 8, 2)),
                           bin2hex(substr($uuid, 10, 6))
                           ));
  }

  public static function random($bytes, array $options = array()) {
    $defaults = array('encode' => null);
    $options += $defaults;
    $result = static::_source($bytes);
    if ($options['encode'] != static::ENCODE_BASE_64) {
      return $result;
    }
    return strtr(rtrim(base64_encode($result), '='), '+', '.');
  }

  public static function _source($bytes) {
    $fp = fopen('/dev/urandom', 'rb');
    $ran = fread($fp, $bytes);
    fclose($fp);
    return $ran;
  }

}

?>
