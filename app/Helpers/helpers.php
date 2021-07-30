<?php

if (!function_exists('getDateColumn')) {
    /**
     * @param $modelObject
     * @param string $attributeName
     * @return null|string|string[]
     */
    function getDateColumn($modelObject, $attributeName = 'updated_at')
    {
        if (Config::get('is_human_date_format', false)) {
            $html = '<p data-toggle="tooltip" data-placement="bottom" title="${date}">${dateHuman}</p>';
        } else {
            $html = '<p data-toggle="tooltip" data-placement="bottom" title="${dateHuman}">${date}</p>';
        }
        if (!isset($modelObject[$attributeName])) {
            return '';
        }
        $dateObj = new Carbon\Carbon($modelObject[$attributeName]);
        $replace = preg_replace('/\$\{date\}/', $dateObj->format(Config::get('date_format', 'l jS F Y (h:i:s)')), $html);
        $replace = preg_replace('/\$\{dateHuman\}/', $dateObj->diffForHumans(), $replace);
        return $replace;
    }
}


if (!function_exists('getArrayColumn')) {
    function getArrayColumn($array = [], $titleAttribute = 'title', $extraClass = '', $separator = ', ')
    {
        $result = [];
        foreach ($array as $link) {
            $title = $link[$titleAttribute];
            //        $replace = preg_replace('/\$\{href\}/', url($baseUrl, $link[$idAttribute]), $html);
            //        $replace = preg_replace('/\$\{title\}/', $link[$titleAttribute], $replace);
            $html = "<span class='{$extraClass}'>{$title}</span>";
            $result[] = $html;
        }
        return implode($separator, $result);
    }
}

if (!function_exists('getEmailColumn')) {
    function getEmailColumn($column, $attributeName)
    {
        if (isset($column)) {
            if ($column[$attributeName]) {
                return "<a class='btn btn-outline-secondary btn-sm' href='mailto:" . $column[$attributeName] . "'><i class='fa fa-envelope mr-1'></i>" . $column[$attributeName] . "</a>";
            } else {
                return '';
            }
        }
    }
}

if (!function_exists('getMediaColumn')) {
    function getMediaColumn($mediaModel, $mediaCollectionName = '', $extraClass = '', $mediaThumbnail = 'icon')
    {
        if ($mediaModel->hasMedia($mediaCollectionName)) {
            return "<img class='" . $extraClass . "' style='width:50px' src='" . $mediaModel->getFirstMediaUrl($mediaCollectionName, $mediaThumbnail) . "' alt='" . $mediaModel->getFirstMedia($mediaCollectionName)->name . "'>";
        }
        return '';
    }
}

if (!function_exists('getBooleanColumn')) {
    /**
     * generate boolean column for datatable
     * @param $column
     * @return string
     */
    function getBooleanColumn($column, $attributeName)
    {
        if (isset($column)) {
            if ($column[$attributeName] == 1) {
                return "<span class='badge badge-success'>" . trans('lang.active') . "</span>";
            } else {
                return "<span class='badge badge-danger'>" . trans('lang.inactive') . "</span>";
            }
        }
    }
}


if (!function_exists('getSwitchColumn')) {
    /**
     * generate switch column for datatable
     * @param $model
     * @return string
     */
    function getSwitchColumn($model, $attributeName)
    {
        if (isset($model)) {
            $out = '<label class="switch switch-3d switch-primary switch-sm switchStatus" data-model="' . class_basename($model) . '" data-id="' . $model['id'] . '">';
            if ($model[$attributeName]) {
                $out .= '<input type="checkbox" name="' . $attributeName . '" class="switch-input" checked="" value="1">';
            } else {
                $out .= '<input type="checkbox" name="' . $attributeName . '" class="switch-input" value="0">';
            }

            $out .= '<span class="switch-label" data-on="" data-off=""></span>
                     <span class="switch-handle"></span>
                     </label>';

            return $out;
        }
    }
}

if (!function_exists('locale')) {
    /**
     * Retrieve our Locale instance
     *
     * @return App\Locale
     */
    function locale()
    {
        return app()->make(App\Services\Locale::class);
    }
}

if (!function_exists('formatedSize')) {
    /**
     * @param $bytes
     * @param int $precision
     * @return string
     */
    function formatedSize($bytes, $precision = 1)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}

if (!function_exists('title_case')) {
    /**
     * Convert a value to title case.
     *
     * @param  string  $value
     * @return string
     *
     * @deprecated Str::title() should be used directly instead. Will be removed in Laravel 6.0.
     */
    function title_case($value)
    {
        return Str::title($value);
    }
}
