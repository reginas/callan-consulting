<?php
$cfg['input_types']=array(
                        array(
                            'name'=>'Text line',
                            'type'=>'text',
                            'value'=>'',
                            'id'=>TF_THEME_PREFIX."_%%name%%",
                            'options'=>false,
                            'properties'=>array(
                                'style'=>'width:85%',
                                'class'=>'inputtext'
                            )
                            ),
                        array(
                            'name'=>'Text area',
                            'type'=>'textarea',
                            'value'=>'',
                            'id'=>TF_THEME_PREFIX."_%%name%%",
                            'options'=>false,
                            'properties'=>array(
                                'style'=>'width:91%',
                                'class'=>'textarea'
                            )
                             ),

                        array(
                             'name'=>'Radio buttons',
                             'type'=>'radio',
                             'value'=>'',
                             'id'=>TF_THEME_PREFIX."_%%name%%",
                             'options'=>true
                             ),
                        array(
                             'name'=>'Checkbox',
                             'type'=>'checkbox',
                             'value'=>'',
                             'id'=>TF_THEME_PREFIX."_%%name%%",
                             'options'=>false
                             ),
                         array(
                             'name'=>'Select Box',
                             'type'=>'select',
                             'value'=>'',
                             'id'=>TF_THEME_PREFIX."_%%name%%",
                             'properties'=>array(
                                 'class'=>'select_styled'
                             ),
                             'options'=>true
                              ),
                         array(
                             'name'=>'Email',
                             'type'=>'text',
                             'value'=>'',
                             'id'=>TF_THEME_PREFIX."_%%name%%",
                             'options'=>false,
                             'properties'=>array(
                                 'style'=>'width:85%',
                                 'class'=>'inputtext'
                             )
                             ),
                         array(
                              'name'=>'Captcha',
                              'type'=>'captcha',
                              'value'=>'',
                              'id'=>"captcha",
                              'options'=>false,
                              'file_name'=>'captcha_gen.php',
                             'properties'=>array(
                                 'style'=>'width:85%'
                             )
                              )
                        );
$cfg['labels']=array(
            'type'=>'tfuse_cf_label',
    array(
        'id'=>'rf_type',
        'html'=>'<label >Type</label>',
        'type'=>'raw'
    ),
            array(
                'id'=>'rf_label',
                'html'=>'<label >Label</label>',
                'type'=>'raw'
            ),

            array(
                'id'=>'rf_width',
                'html'=>'<label >Width (%)</label>',
                'type'=>'raw'
            ),
            array(
                'id'=>'rf_required',
                'html'=>'<label >Required</label>',
                'type'=>'raw'
            ),
            array(
                'id'=>'rf_newline',
                'html'=>'<label >New Line</label>',
                'type'=>'raw'
            ),
            array(
                'id'=>'rf_column',
                'html'=>'<label >Column</label>',
                'type'=>'raw'
            ),
            array(
                'id'=>'rf_shortcode',
                'html'=>'<label >Shortcode</label>',
                'type'=>'raw'
            ),
        );

if (!function_exists('tfuse_rf_datepicker_select_column')):
    function tfuse_rf_datepicker_select_column( $original=array(),$vals ){
        $column_options_name = array('left column','right column');
        $key = 0;
        $inserted =array(
            'tf_column_select'=>array(
            'name' => 'Column',
            'desc' => 'Column',
            'id' => 'tf_rf_column[]',
            'value'=>@$vals['input']['column'],
            'type'=>'select',
            'properties'=>array(
                'class'=>'medica_inp_column'
            ),
            'options'=>$column_options_name
            )
        );
        foreach($original as $k=>$y){
            if(@$y['id']== 'tf_cf_shortcode_row') {$key = $k ;break;}
        }

        array_splice($original, $key, 0, $inserted);
        return $original;
    }
    add_filter('datepickers_res_form','tfuse_rf_datepicker_select_column',10,2);
endif;

if (!function_exists('tfuse_rf_email_select_column')):
    function tfuse_rf_email_select_column( $original=array(),$vals ){
        $column_options_name = array('left column','right column');
        $key = 0;
        $inserted =array(
            'tf_column_select'=>array(
                'name' => 'Column',
                'desc' => 'Column',
                'id' => 'tf_rf_column[]',
                'value'=>@$vals['input']['column'],
                'type'=>'select',
                'properties'=>array(
                    'class'=>'medica_inp_column'
                ),
                'options'=>$column_options_name
            )
        );
        foreach($original as $k=>$y){
            if(@$y['id']== 'tf_cf_shortcode_row') {$key = $k ;break;}
        }

        array_splice($original, $key, 0, $inserted);
        return $original;
    }
    add_filter('reservationform_email_input_array','tfuse_rf_email_select_column',11,2);
endif;