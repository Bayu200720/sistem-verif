<?php

if (!function_exists('dd')) {
    function dd(mixed $data)
    {
        dump($data); die; 
    }
}