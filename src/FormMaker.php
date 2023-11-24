<?php

namespace Noman\Easycrud;


class FormMaker{

    public static function formMaker(array $array=[
        'name'=>'',
        'label'=>'',
        'styles'=>'',
        'classes'=>'',
        'placeholder'=>'',
        'type'=>'text',
        'attribute'=>'',
        'options'=>[]
    ],$column=1)
    {
        $name = '';
        $label = '';
        $styles = '';
        $classes = '';
        $placeholder = '';
        $type = 'text';
        $attribute = '';
        $options = [];
        if(array_key_exists('name', $array)) {
            $name = $array['name'];
        } 
        if(array_key_exists('label', $array)) {
            $label = $array['label'];
        } 
        if(array_key_exists('styles', $array)) {
            $styles = $array['styles'];
        } 
        if(array_key_exists('classes', $array)) {
            $classes = $array['classes'];
        } 
        if(array_key_exists('placeholder', $array)) {
            $placeholder = $array['placeholder'];
        } 
        if(array_key_exists('type', $array)) {
            $type = $array['type'];
        } 
        if(array_key_exists('attribute', $array)) {
            $attribute = $array['attribute'];
        }
        if(array_key_exists('options', $array)) {
            $options = $array['options'];
        }
        $col=self::getColmnClass($column);
          $html='';
          if($type!="select" and $type!="radio" and $type!="checkbox" and $type!="button" and $type!='textarea'){
                 $html.="
                 <div class='col-12 ".$col."'>
                    <div class='form-group'>
                        <label>".$label."</label>
                        <input type='".$type."' class='".$classes."' style='".$styles."' placeholder='".$placeholder."' ".$attribute." name='".$name."' id='".$name."'>
                        <div class='invalid-feedback' id='".$name."_msg'>
                        </div>
                    </div>
                 </div>
                 ";
          }
          if($type==='textarea'){
            $html="
                 <div class='col-12 ".$col."'>
                    <div class='form-group'>
                        <label>".$label."</label>
                        <textarea class='".$classes."' style='".$styles."' placeholder='".$placeholder."' ".$attribute." name='".$name."' id='".$name."'></textarea>
                        <div class='invalid-feedback' id='".$name."_msg'>
                        </div>
                    </div>
                 </div>
                 ";
          }
          if($type==="select"){
                $op="'<option value=''>".$placeholder."</option>";
                foreach($options as $key=> $val){
                    $op.="<option value='".$val."'>".ucwords(str_replace('_',' ',$key))."</option>";
                }
                 $html="
                 <div class='col-12 ".$col."'>
                    <div class='form-group'>
                        <label>".$label."</label>
                        <select  class='".$classes."' style='".$styles."' ".$attribute." name='".$name."'  id='".$name."'>
                        ".$op."
                        </select>
                        <div class='invalid-feedback' id='".$name."_msg'>
                        </div>
                    </div>
                 </div>
                 ";
          }
          if($type==="radio" or $type==="checkbox"){
            $html="
            <div class='col-12 ".$col."'>
                <div class='form-group'>
                    <input type='".$type."' class='".$classes."' style='".$styles."' ".$attribute." name='".$name."'  id='".$name."'>
                    <label>".$label."</label>
                    <div class='invalid-feedback' id='".$name."_msg'>
                    </div>
                </div>
            </div>
            ";
          }
          info($html);
        return $html;
    }
    public static function getColmnClass($column)
    {
        switch ($column) {
            case 1:
                return "col-md-12";
                break;
            case 2:
                return "col-md-6";
                break;
            case 3:
                return "col-md-4";
                break;
            case 4:
                return "col-md-3";
                break;
            case 6:
                return "col-md-2";
                break;
            default:
                return "col-md-12";
                break;
        }
    }
}