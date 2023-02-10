<?php

if (!function_exists('pd')) {
    /**
     * Dump the passed variables and end the script.
     *
     * @param  mixed
     * @return void
     */
    function pd()
    {
        echo '<pre>';
        array_map(function ($x) {
            print_r($x);
        }, func_get_args());
        echo '</pre>';
        die(1);
    }
}

if (!function_exists('pr')) {
    /**
     * Dump the passed variables and end the script.
     *
     * @param  mixed
     * @return void
     */
    function pr()
    {
        echo '<pre>';
        array_map(function ($x) {
            print_r($x);
        }, func_get_args());
        echo '</pre>';
    }
}

if (!function_exists('limit_text')) {

    /**
     * @param $text
     * @param $limit
     * @return string
     */
    function limit_text($text, $limit)
    {
        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos = array_keys($words);
            $text = substr($text, 0, $pos[$limit]) . '...';
        }
        return $text;
    }
}


if (!function_exists('html_generate')) {

    /**
     * @param $name
     * @param $frontend_input
     * @param $frontend_label
     * @param $options
     * @return string
     */
    function html_generate($name, $frontend_input, $frontend_label, $value = null, $options = [])
    {
        $html = "<div class='form-group'>";
        $html .= "<label>" . $frontend_label . ":</label>";

        if ($frontend_input == \App\Models\EAVAttribute::FRONTEND_INPUT_TYPE_TEXT)
            $html .= '<input class="form-control" type="text" name="' . $name . '" value="' . $value . '">';

        if ($frontend_input == \App\Models\EAVAttribute::FRONTEND_INPUT_TYPE_SELECT) {
            $html .= '<select class="form-control" name="' . $name . '">';

            foreach ($options as $key => $option) {
                $html .= '<option value="' . $key . '">';
                $html .= $option;
                $html .= '</option>';
            }

            $html .= '</select>';
        }

        if ($frontend_input == \App\Models\EAVAttribute::FRONTEND_INPUT_TYPE_TEXTAREA)
            $html .= '<textarea class="form-control" name="' . $name . '"></textarea>';

        $html .= "</div>";

        return $html;
    }
}

if (!function_exists('price')) {
    function price($value)
    {
        return number_format($value, 0, ".", ",");
    }
}

if (!function_exists('phone')) {
    function phone($phone)
    {
        if (preg_match('/^(\d{4})(\d{3})([\d]+)$/', $phone, $matches)) {
            $result = $matches[1] . '.' . $matches[2] . '.' . $matches[3];
            return $result;
        }
        return $phone;
    }
}

if (!function_exists('phone_validate')) {
    function phone_validate($phone)
    {
        $prefixHeaderNumbers = '086|096|097|';
        $prefixHeaderNumbers .= '098|032|033|';
        $prefixHeaderNumbers .= '034|035|036|';
        $prefixHeaderNumbers .= '037|038|039|';
        $prefixHeaderNumbers .= '089|090|093|';
        $prefixHeaderNumbers .= '070|079|077|';
        $prefixHeaderNumbers .= '076|078|091|';
        $prefixHeaderNumbers .= '094|088|083|';
        $prefixHeaderNumbers .= '084|085|081|082';

        $phone = preg_replace('/^\+84/', 0, $phone);

//        if (!preg_match('/^0/', $phone)) {
//            $phone = '0' . $phone;
//        }

        if (!preg_match('/^[0-9]+$/', $phone)) {
            return [
                'status' => false,
                'messages' => "Số điện thoại phải là số"
            ];
        }

        $phoneLength = strlen($phone);
        if ($phoneLength < 10 || $phoneLength > 10) {
            return [
                'status' => false,
                'messages' => "Số điện thoại phải là 10 chữ số"
            ];
        }

        if (!preg_match('/^' . $prefixHeaderNumbers . '/', $phone)) {
            return [
                'status' => false,
                'messages' => "Đầu số điện thoại của bạn không được hỗ trợ"
            ];
        }

        return [
            'status' => true,
            'messages' => ""
        ];
    }
}




