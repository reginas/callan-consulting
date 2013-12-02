<?php

/**
 * Dynamic forms
 **
 * Javascript dependencies: jQuery, TFE
 */
class TFORM
{
    /**
     * Store all form ids created with this class
     */
    protected static $ids = array();

    /**
     * Form id
     */
    protected $id;

    protected $attr_dom;

    /**
     * Found validation errors
     */
    protected $errors;

    public function __construct($attr = array())
    {
        if (!isset($attr['id']) || !is_string($attr['id']))
            trigger_error('Invalid tform id "'.$attr['id'].'"', E_USER_ERROR);
        elseif (isset(self::$ids[$attr['id']]))
            trigger_error(sprintf(__('TForm with id "%s" was already defined', 'tfuse'), $attr['id']), E_USER_ERROR);

        $this->id = $attr['id'];
        self::$ids[$this->id] = true;

        $this->attr_dom = array_merge(array('method' => 'POST'), $attr);
        $this->attr_dom['id'] = $this->makeHookName('id');

        add_action('init', array($this, '_detect_validate_and_save'), 99);
        add_action('wp_footer', array($this, '_print_errors_script'));
    }

    public function attr($k, $v = null)
    {
        if (isset($v)) {
            if ($k == 'id') {
                trigger_error('It is not allowed to change TFORM id attribute', E_USER_WARNING);
                return false;
            }
            $this->attr_dom[$k] = $v;
            return $this;
        }
        else {
            return $this->attr_dom[$k];
        }
    }

    /**
     * Create actions and filters names
     */
    protected function makeHookName($name)
    {
        return 'TFORM__'.$this->id.'__'.$name;
    }

    /**
     * @return string
     */
    public function get_id()
    {
        return $this->id;
    }

    /**
     * Render form html
     */
    public function render($renderData = array())
    {
        echo tf_elem('form', $this->attr_dom, null);
        ?>
            <input type="hidden" name="tform_id" value="<?php print $this->id ?>" /><?php
            wp_nonce_field('submit_tform', '_nonce_'. md5($this->id));

            /**
             * This filter outputs html (like an action) and returns data
             */
            $data = apply_filters($this->makeHookName('render'), array(
                'submit' => array(
                    'value' => __('Submit', 'tfuse')
                ),
                'data' => $renderData,
            ));

            // In filter can be defined custom html for submit button
            if (isset($data['submit']['html'])):
                print $data['submit']['html'];
            else:
                ?><input type="submit" value="<?php print $data['submit']['value'] ?>"><?php
            endif;
        ?></form><?php
    }

    /**
     * Find if current form was submitted and validate it
     */
    public function _detect_validate_and_save()
    {
        if (empty($_POST) || empty($_POST['tform_id']) || $_POST['tform_id'] != $this->id)
            return; // do nothing if this form was not submitted

        /**
         * Errors array structure: 'exact-html-input-name' => 'Error message'
         */
        $errors = apply_filters($this->makeHookName('validate'), array());

        /** check nonce */
        {
            $nonceName = '_nonce_'. md5($this->id);
            if (!isset($_REQUEST[$nonceName]) || wp_verify_nonce($_REQUEST[$nonceName], 'submit_tform') === false) {
                $errors[$nonceName] = __('TFORM: nonce verification failed', 'tfuse');
            }
        }

        if (empty($errors)) {
            /**
             * Do save if no validation errors
             **
             * Modules should 'manually' extract their data from $_POST and save them
             */
            $result = apply_filters($this->makeHookName('save'), array());

            # Some errors can only be detected on SAVE/SUBMIT step e.g. credit
            # card number although properly formatted can be invalid or expired.
            if (isset($result['errors'])) {
                $this->errors = $result['errors'];
            }
            else if (isset($result['redirect'])) {
                wp_redirect($result['redirect']);
                exit;
            }
        } else {
            $this->errors = $errors;
        }
    }

    /**
     * Print errors javascript
     */
    public function _print_errors_script()
    {
        if (empty($this->errors))
            return;

        $errors = $this->errors;

        ?><script type="text/javascript">
        jQuery(document).ready(function($)
        {
            var makeEventName = function(shortEventName) {
                return 'tform-error-{eventName}'.split('{eventName}').join(shortEventName);
            };
            var errors      = <?php echo json_encode($errors) ?>;
            var eventData   = {
                errors:     errors,
                $form:      $('form#<?php print $this->makeHookName('id') ?>'),
                tformId:    '<?php print $this->id ?>'
            };
            var $errorElements = {};

            $.each(errors, function(name, message)
            {
                var preparedName    = String(name).split('[').join('\\[').split(']').join('\\]');
                var selector        = 'input[name={name}],select[name={name}],textarea[name={name}]'.split('{name}').join(preparedName);
                var $errorElement   = $(selector, eventData.$form).last();
                // if more inputs with same name, lasts value will be accessible, so others has no sense
                eventData = $.extend(eventData, {
                    element: {
                        name:           name,
                        message:        message,
                        preparedName:   preparedName,
                        $element:       $errorElement
                    }
                });

                if ($errorElement.length < 1) {
                    TFE.trigger(makeEventName('elementNotFound'), eventData);
                } else {
                    $errorElements[name] = {
                        $element:   $errorElement,
                        preparedName: preparedName
                    };

                    $errorElement.attr('data-tform-error', message);

                    TFE.trigger(makeEventName('errorSet'), $.extend(eventData, {
                        $errorElements: $errorElements
                    }));
                }
            });

            delete eventData.element;

            TFE.trigger(makeEventName('errorsSet'), $.extend(eventData, {
                $errorElements: $errorElements
            }));
        });
        </script><?php
    }
}