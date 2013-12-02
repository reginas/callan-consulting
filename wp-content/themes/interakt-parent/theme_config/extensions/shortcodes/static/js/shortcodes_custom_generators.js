function custom_generator_faq(type,options) {
    shortcode='[faq title="'+options.title+'"]';
    for(i in options.array) {
        shortcode+='[faq_question]'+options.array[i]['question']+'[/faq_question]';
        shortcode+='[faq_answer]'+options.array[i]['answer']+'[/faq_answer]';
    }
    shortcode+='[/faq]';
    return shortcode;
}

function custom_obtainer_faq(data) {
    cont=jQuery('.tf_shortcode_option:visible');
    sh_options={};
    sh_options['array']=[];
    sh_options['title']=opt_get('tf_shc_faq_title',cont);
    cont.find('[name="tf_shc_faq_question"]').each(function(i) {
        question=jQuery(this).val();
        answer=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_faq_answer"]:first').val();
        tmp={};
        tmp['question']=question;
        tmp['answer']=answer;
        sh_options['array'].push(tmp);
    })
    return sh_options;
}

function custom_generator_tabs(type,options) {
    shortcode='[tabs class="'+options['class']+'"]';
    for(i in options.array) {
        shortcode+='[tab title="'+options.array[i]['title']+'"]'+options.array[i]['content']+'[/tab]';
    }
    shortcode+='[/tabs]';
    return shortcode;
}

function custom_obtainer_tabs(data) {
    cont=jQuery('.tf_shortcode_option:visible');
    sh_options={};
    sh_options['array']=[];
    sh_options['class']= opt_get('tf_shc_tabs_class',cont);
    cont.find('[name="tf_shc_tabs_title"]').each(function(i) {
        div=jQuery(this).parents('.option');
        title=opt_get(jQuery(this).attr('name'),div);
        div=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_tabs_content"]').first().parents('.option');
        content=opt_get(jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_tabs_content"]').first().attr('name'),div);
        tmp={};
        tmp['title']=title;
        tmp['content']=content;
        sh_options['array'].push(tmp);
    })
    return sh_options;
}

jQuery(document).ready(function($) {

    $('#tf_shc_text_styles_type').live('change',function () {
        foo = $(this).val();
        if(foo !='link')
		{
            $('.tf_shc_text_styles_link').hide();
			$('.tf_shc_text_styles_target').hide();
		}
        else
		{
            $('.tf_shc_text_styles_link').show();
			$('.tf_shc_text_styles_target').show();
		}
    });

    $('#tf_shc_twitter_position').live('change',function () {
        foo = $(this).val();
        if(foo !='content')
		{
            $('.tf_shc_twitter_title').hide();
		}
        else
		{
            $('.tf_shc_twitter_title').show();
		}
    });
    jQuery(".tf_shortcode_element[rel='testimonials']").live('click', function(){
        $('.tf_shc_testimonials_order').hide();
    });
     $('#tf_shc_testimonials_type').live('change',function () {
        var foo = $(this).val();
        if(foo !='none')
		{
            $('.tf_shc_testimonials_box').hide();
            $('.tf_shc_testimonials_order').show();
		}
        else
		{
            $('.tf_shc_testimonials_box').show();
            $('.tf_shc_testimonials_order').hide();
		}
    });
    
       $('#tf_shc_text_box_type').live('change',function () {
        foo = $(this).val();
        if(foo !='type2')
		{
            $('.tf_shc_text_box_number').hide();
            $('.tf_shc_text_box_bg').hide();
		}
        else
		{
            $('.tf_shc_text_box_number').show();
            $('.tf_shc_text_box_bg').show();
		}
    });
    
});
