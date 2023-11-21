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
    ])
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
          $html='';
          if($type!="select" and $type!="radio" and $type!="checkbox" and $type!="button" and $type!='textarea'){
                 $html.="
                 <div class='form-group'>
                    <label>".$label."</label>
                    <input type='".$type."' class='".$classes."' style='".$styles."' placeholder='".$placeholder."' ".$attribute." name='".$name."' id='".$name."'>
                    <div class='invalid-feedback' id='".$name."_msg'>
                    </div>
                 </div>
                 ";
          }
          if($type==='textarea'){
            $html="
                 <div class='form-group'>
                    <label>".$label."</label>
                    <textarea class='".$classes."' style='".$styles."' placeholder='".$placeholder."' ".$attribute." name='".$name."' id='".$name."'></textarea>
                    <div class='invalid-feedback' id='".$name."_msg'>
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
                 <div class='form-group'>
                    <label>".$label."</label>
                    <select  class='".$classes."' style='".$styles."' ".$attribute." name='".$name."'  id='".$name."'>
                    ".$op."
                    </select>
                    <div class='invalid-feedback' id='".$name."_msg'>
                    </div>
                 </div>
                 ";
          }
          if($type==="radio" or $type==="checkbox"){
            $html="
            <div class='form-group'>
               <input type='".$type."' class='".$classes."' style='".$styles."' ".$attribute." name='".$name."'  id='".$name."'>
               <label>".$label."</label>
               <div class='invalid-feedback' id='".$name."_msg'>
               </div>
            </div>
            ";
          }
          info($html);
        return $html;
    }
}