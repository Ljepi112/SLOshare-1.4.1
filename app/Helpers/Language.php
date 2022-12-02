<?php

if (! function_exists('language')) {
    /**
     * Get the language instance.
     */
    function language(): App\Models\Language
    {
        return app('language');
    }
}
