<?php
namespace CjsPhpunit;


function env($key, $default = null)
{
    $value = getenv($key);
    if ($value === false) return value($default);
    switch (strtolower($value))
    {
        case 'true':
        case '(true)':
            return true;
        case 'false':
        case '(false)':
            return false;
        case 'null':
        case '(null)':
            return null;
        case 'empty':
        case '(empty)':
            return '';
    }
    return $value;
}


function value($value)
{
    return $value instanceof \Closure ? $value() : $value;
}

function with($object)
{
    return $object;
}


function array_get($array, $key, $default = null)
{
    if (is_null($key)) return $array;
    if (isset($array[$key])) return $array[$key];
    $keyA = explode('.', $key);
    foreach ($keyA as $segment)
    {// a.b.c
        if ( ! is_array($array) || ! array_key_exists($segment, $array))
        {   //不存在的key则返回默认值
            return $default instanceof \Closure ? $default() : $default;
        }

        $array = $array[$segment];
    }

    return $array;
}

