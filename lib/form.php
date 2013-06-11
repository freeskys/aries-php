<?php
/*****************************************************************
 * Author	: Harditya Rahmat Ramadhan
 * Twitter	: @freeskys
 *
 * You may change code below but PLEASE DO NOT REMOVE THIS COMMENT.
 * Thanks for using AriesPHP
 *****************************************************************/

namespace Lib;


class Form {

    var $form;
    var $markup;

    //==== Form variable ====
    var $action;
    var $legend;

    //==== Text based input ====
    public static $textfield    = 'textfield';
    public static $password     = 'password';

    //==== Choice based input ====
    public static $radio        = 'radio';
    public static $checkbox     = 'checkbox';
    public static $combobox     = 'combobox';

    public function __construct($action, $legend) {
        $this->action   = $action;
        $this->legend   = $legend;
    }

    public function text($detail) {
        $this->buildTextInput($detail, Form::$textfield);
    }

    public function password($detail) {
        $this->buildTextInput($detail, Form::$password);
    }

    public function radio($detail) {
        $this->buildChoiceInput($detail, Form::$radio);
    }

    public function checkbox($detail) {
        $this->buildChoiceInput($detail, Form::$checkbox);
    }

    public function combo($detail, $value = '') {

    }

    public function reset($value = 'Reset') {
        $this->form .= '&nbsp;&nbsp;&nbsp;<button type="reset" class="btn">'.$value.'</button>';
    }

    public function submit($value) {
        $this->form .= '<br /><br /><button type="submit" class="btn btn-primary">'.$value.'</button>';
    }

    private function buildTextInput($detail, $type) {
        $name           = $detail[0];
        $label          = $detail[1];
        $placeholder    = $detail[2];
        $rules          = $detail[3];

        $markup = '<label>'.$label.'</label><input type="';
        if ($type == Form::$textfield) {
            $markup .= 'text"';
        } else if ($type == Form::$password) {
            $markup .= 'password"';
        }
        $markup .= ' name="'.$name.'" id="'.$name.'" placeholder="'.$placeholder.'"';
        $markup .= $this->processRules($rules);
        $markup .= '/>';
        $this->form .= $markup;
    }

    private function buildChoiceInput($detail, $type) {
        $name           = $detail[0];
        $label          = $detail[1];
        $valueText      = $detail[2];
        $value          = $detail[3];
        $rules          = $detail[4];

        $names          = explode('|', $name);
        $valuesText     = explode('|', $valueText);
        $values         = explode('|', $value);

        $markup         = '<label>'.$label.'</label>';

        if (count($values) > 1) {
            for ($i=0; $i<count($values); $i++) {
                $inline = ' ';
                $_name  = '';

                if (Form::$checkbox == $type) {
                    $inline = ' inline';
                    $_name  = $names[$i];
                } else if (Form::$radio == $type) {
                    $_name  = $name;
                }

                $markup .= '<label class="'.$type.$inline.'">';
                $markup .= '<input type="'.$type.'" id="'.$_name.'" name="'.$_name.'" value="'.$values[$i].'" />'.$valuesText[$i];
                $markup .= '</label>';
            }
        } else {
            if (Form::$checkbox == $type) {
                $markup .= '<label class="checkbox">';
                $markup .= '<input type="checkbox" name="'.$name.'" id="'.$name.'" value="'.$value.'" ';
                $markup .= $this->processRules($rules);
                $markup .= '/>';
                $markup .= $valueText;
                $markup .= '</label>';
            }
        }
        $this->form .= $markup;
    }

    private function processRules($rules) {
        $rules      = explode('|', $rules);
        $markup     = '';

        foreach ($rules as $rule) {
            if ('required' == $rule) {
                $markup .= ' required="required"';
            } else if ('maxlength' == substr($rule, 0, 9)) {
                $markup .= ' maxlength="'.substr($rule, strpos('[', $rule), strpos(']', $rule)).'"';
            }
        }

        return $markup;
    }

    public function build() {
        $this->markup = '<form action="'.$this->action.'" method="post" enctype="application/x-www-form-urlencoded">';
        $this->markup .= '<fieldset>';
        $this->markup .= '<legend>'.$this->legend.'</legend>';
        $this->markup .= $this->form;
        $this->markup .= '</fieldset>';
        $this->markup .= '</form>';

        return $this->markup;
    }

}