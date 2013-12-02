jQuery(document).ready(function(){
								jQuery('.s')
								.on('mouseenter', function ()
                                {
                                    var self = jQuery(this);
                                    
                                    self
                                    .addClass('is_mousein')
                                    .trigger('custom_mouseenter');
                                })
                                .on('custom_mouseenter', function ()
                                {
                                    var self = jQuery(this);
                                    
                                    if (!self.hasClass('is_open')) 
                                    {
                                        self
                                        .addClass('is_open')
                                        .animate(
                                            { width:'175', 'padding-left':'10' },
                                            600,
                                            function() 
                                            {
                                                self.css('text-indent',0);
                                                
                                            }
                                        );
                                    }
                                })
                                .on('focusin', function ()
                                {
                                    var self = jQuery(this);
                                    
                                    self
                                    .addClass('has_focus')
                                    .trigger('mouseenter');
                                })
                                .on('focusout', function ()
                                {
                                    var self = jQuery(this);
                                    
                                    self
                                    .removeClass('has_focus')
                                    .trigger('mouseleave');
                                })
								.on('mouseleave', function ()
								{
                                    var self = jQuery(this);
                                    
                                    self.removeClass('is_mousein');
                                    
                                    if (!self.hasClass('has_focus') && !self.hasClass('is_closing') && self.hasClass('is_open'))
                                    {
                                        self
                                        .addClass('is_closing')
                                        .css({'text-indent':-99999})
                                      
                                        .animate(
                                            { width:'37', 'padding-left':'0', 'text-indent':'-99999' },
                                            600,
                                            function() 
                                            {
                                                self
                                                .removeClass('is_open')
                                                .removeClass('is_closing');
                                                
                                                if (self.hasClass('is_mousein') || self.hasClass('has_focus'))
                                                {
                                                    self.trigger('custom_mouseenter');
                                                }
                                            }
                                        );
                                    }
								});
							});