<?php
use Illuminate\Support\Facades\Route;

if (!function_exists('localized_field')) {
    function localized_field($model, $field) {
        return $model->{$field . '_' . app()->getLocale()} ?? '';
    }
}
if (!function_exists('localized_route')) {
    function localized_route($name, $parameters = [], $absolute = true)
    {
        $parameters = array_merge([
            'locale' => app()->getLocale(),
            'unit' => session('unit', 'main'),
        ], $parameters);
        return route($name, $parameters, $absolute);
    }
}
?>
