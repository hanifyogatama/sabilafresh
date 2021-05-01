<?php

namespace App\Helpers;

class General
{
    public static function selectMultiLevel($nama, $array = [], $options = [])
    {
        $class_form = "";
        if (isset($options['class'])) {
            $class_form = $options['class'];
        }

        $selected = [];
        if (isset($options['selected'])) {
            $selected = is_array($options['selected']) ? $options['selected'] : [$options['selected']];
        }

        if (isset($options['placeholder'])) {
            $placeholder = [
                'id' => '',
                'nama' => $options['placeholder'],
                'parent_id' => 0
            ];
            $array[] = $placeholder;
        }

        $multiple = '';
        if (isset($options['multiple'])) {
            $multiple = 'multiple';
        }

        $select = '<select class="' . $class_form . '" name="' . $nama . '" ' . $multiple . '>';
        $select .= General::getMultiLevelOptions($array, 0, [], $selected);
        $select .= '</select>';

        return $select;
    }

    public static function getMultiLevelOptions($array, $parent_id = 0, $parents = [], $selected = [])
    {


        static $i = 0;
        if ($parent_id == 0) {
            foreach ($array as $element) {
                if (($element['parent_id'] != 0) && !in_array($element['parent_id'], $parents)) {
                    $parents[] = $element['parent_id'];
                }
            }
        }

        $menu_html = '';
        foreach ($array as $element) {
            $selected_item = '';
            if ($element['parent_id'] == $parent_id) {
                if (in_array($element['id'], $selected)) {
                    $selected_item = 'selected';
                }
                $menu_html .= '<option value="' . $element['id'] . '" ' . $selected_item . '>';
                for ($j = 0; $j < $i; $j++) {
                    $menu_html .= '&mdash; ';
                }
                $menu_html .= $element['nama'] . '</option>';
                if (in_array($element['id'], $parents)) {
                    $i++;
                    $menu_html .= General::getMultilevelOptions($array, $element['id'], $parents, $selected);
                }
            }
        }

        $i--;
        return $menu_html;
    }

    public static function integerToRoman($integer)
    {
        $integer = intval($integer);
        $result = '';

        // Create a lookup array that contains all of the Roman numerals.
        $lookup = ['M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1];

        foreach ($lookup as $roman => $value) {
            $matches = intval($integer / $value);
            $result .= str_repeat($roman, $matches);
            $integer = $integer % $value;
        }

        return $result;
    }

    /**
     * Apply price format to number
     *
     * @param double $number   number
     * @param string $currency format
     *
     * @return string
     */
    public static function priceFormat($number, $currency = '')
    {
        $currency = !empty($currency) ? $currency . ' ' : '';
        return  $currency . number_format($number, 0, ",", ".");
    }

    /**
     * Apply date format to datetime
     *
     * @param string $datetime datetime
     * @param string $format   format
     *
     * @return string
     */
    public static function datetimeFormat($datetime, $format = 'd M Y H:i:s A')
    {
        if (!empty($datetime)) {
            return date($format, strtotime($datetime));
        } else {
            return '';
        }
    }

    /**
     * Show attributes json as ul tag
     *
     * @param string $jsonAttributes json attributes
     *
     * @return string
     */
    public static function showAttributes($jsonAttributes)
    {
        $attributes = json_decode($jsonAttributes, true);
        $showAttributes = '';
        if ($attributes) {
            $showAttributes .= '<ul class="item-attributes">';
            foreach ($attributes as $key => $attribute) {
                $showAttributes .= '<li>' . ucwords($key) . ': <span>' . $attribute . '</span><li>';
            }
            $showAttributes .= '</ul>';
        }

        return $showAttributes;
    }
}
