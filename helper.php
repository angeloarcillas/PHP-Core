<?php
/**
 * TODO:
 * 1. set base path for app/*
 */

/**
 * Require a view.
 *
 * @param  string $name
 * @param  array  $data
 */
if (! function_exists("view")) {
    function view(string $name, array $data = [])
    {
        extract($data);
        return require "App/Views/{$name}.view.php";
    }
}

/**
 * Throw new exception
 *
 * @param string $msg
 */
if (! function_exists("error")) {
    function error(string $msg)
    {
        throw new \Exception($msg);
    }
}

/**
 * get all request
 *
 * @return array|string
 */
if (! function_exists("request")) {
    function request($key = false)
    {
        $request = \Http\Request::request();

        if (!$key) {
            return $request;
        }

        if (array_key_exists($key, $request)) {
            return $request[$key];
        }

        error("Request key doesnt exist");
    }
}

/**
 * dump and die
 */
if (! function_exists("dd")) {
    function dd(...$params)
    {
        var_dump($params);
        exit;
    }
}


/**
 * Return file from assets folder
 */
if (! function_exists("assets")) {
    function assets($path)
    {
        return 'App/Assets/'.e($path);
    }
}

/**
 * Encode string
 */
if (! function_exists("e")) {
    function e(string $string)
    {
        return htmlspecialchars($string, ENT_QUOTES);
    }
}



/**
 * Set csrf token
 */
if (! function_exists('csrf_token')) {
    function csrf_token()
    {
        // hash_equals($token, $input)
        $_SESSION["csrf_token"] = bin2hex(random_bytes(32));
        $_SESSION["csrf_lifespan"] = time() + 3600;
        return $_SESSION["csrf_token"];
    }
}

/**
 * Create csrf field
 *
 * @return string
 */

if (! function_exists('csrf_field')) {
    function csrf_field()
    {
        return new HtmlString('<input type="hidden" name="_csrf" value="'. csrf_token() .'">');
    }
}

/**
 * Create method field
 *
 * @return string
 */
if (! function_exists('method_field')) {
    function method_field(string $method)
    {
        return new HtmlString('<input type="hidden" name="_method" value="'. $method .'">');
    }
}

/**
 * Redirect to new Page
 */
if (! function_exists('redirect')) {
    function redirect(string $to, int $status = 302, array $headers = [])
    {
        if ($headers) {
            foreach ($headers as $header) {
                header($header);
            }
        }

        $to = trim($to, "/");

        header("location:/{$to}", true, $status);
        exit;
    }
}

/**
 * Return class basename
 *
 * @return string
 */
if (! function_exists('class_basename')) {
    function class_basename($class)
    {
        $class = is_object($class) ? get_class($class) : $class;
        return basename(str_replace('\\', '/', $class));
    }
}
