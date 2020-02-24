<?php

/**
 * A wrapper class for working with cookie
 * @property Cookie $cookieInstance - current Cookie instance
 */
class Cookie
{
  private static Cookie $cookieInstance;

  /**
   * @return Cookie $cookieInstance - current Cookie instance
   */
  static function getCookieInstance(): self
  {
    if (!isset(self::$cookieInstance)) {
      self::$cookieInstance = new self();
    }
    return self::$cookieInstance;
  }

  /**
   * @param string $name — The name of the cookie.
   * @param string $value [optional] — The value of the cookie.
   * @param string $lifetime [optional] — The lifetime of the cookie in seconds, sets a year if 0.
   * @param string $path [optional] — The path on the server in which the cookie will be available on.
   * @param string $domain [optional] — The domain that the cookie is available.
   * @param bool $secure [optional] — Indicates that the cookie should only be transmitted over a secure HTTPS connection from the client.
   * @param bool $httponly [optional] — When true the cookie will be made accessible only through the HTTP protocol.
   */
  function setCookie($name, $value = '', $lifetime = 0, $path = '', $domain = '', $secure = false, $httponly = false)
  {
    if ($lifetime === 0) {
      $interval = new DateInterval('P1Y');
      $expireDate = new DateTime();
      $expireDate->add($interval);
      $expire = $expireDate->getTimestamp();
    } else {
      $expire = time() + $lifetime;
    }
    setcookie($name, $value, $expire, $path, $domain, $secure, $httponly);
  }

  /**
   * @param string $name — The name of the cookie.
   */
  function deleteCookie($name)
  {
    setcookie($name, '', time() - 3600);
  }

  /**
   * @param string $name — The name of the cookie.
   * @return string The value of the cookie.
   */
  function getCookie($name): string
  {
    return $_COOKIE[$name];
  }

  private function __construct()
  {
  }
  private function __clone()
  {
  }
  private function __wakeup()
  {
  }
}
