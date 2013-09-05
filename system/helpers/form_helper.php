<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */
// ------------------------------------------------------------------------

/**
 * CodeIgniter Form Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/form_helper.html
 */
// ------------------------------------------------------------------------

/**
 * Form Declaration
 *
 * Creates the opening portion of the form.
 *
 * @access	public
 * @param	string	the URI segments of the form destination
 * @param	array	a key/value pair of attributes
 * @param	array	a key/value pair hidden data
 * @return	string
 */
if ( ! function_exists('form_open'))
{

	function form_open($action = '', $attributes = '', $hidden = array())
	{
		$CI = & get_instance();

		($attributes == '') && $attributes = 'method="post"';

		// If an action is not a full URL then turn it into one
		($action && strpos($action, '://') === FALSE) && $action = $CI->config->site_url($action);

		// If no action is provided then set to the current url
		$action OR $action = $CI->config->site_url($CI->uri->uri_string());

		$form = '<form action="' . $action . '"'
				. _attributes_to_string($attributes, TRUE)
				. '>';

		// Add CSRF field if enabled, but leave it out for GET requests and requests to external websites	
		($CI->config->item('csrf_protection') === TRUE && ! (strpos($action, $CI->config->base_url()) === FALSE OR strpos($form, 'method="get"'))) && $hidden[$CI->security->get_csrf_token_name()] = $CI->security->get_csrf_hash();

		(is_array($hidden) && count($hidden) > 0) && $form .= sprintf('<div style="display:none">%s</div>', form_hidden($hidden));

		return $form;
	}

};

// ------------------------------------------------------------------------

/**
 * Form Declaration - Multipart type
 *
 * Creates the opening portion of the form, but with "multipart/form-data".
 *
 * @access	public
 * @param	string	the URI segments of the form destination
 * @param	array	a key/value pair of attributes
 * @param	array	a key/value pair hidden data
 * @return	string
 */
if ( ! function_exists('form_open_multipart'))
{

	function form_open_multipart($action = '', $attributes = array(), $hidden = array())
	{
		if (is_string($attributes))
		{
			$attributes .= ' enctype="multipart/form-data"';
		}
		else
		{
			$attributes['enctype'] = 'multipart/form-data';
		}

		return form_open($action, $attributes, $hidden);
	}

};

// ------------------------------------------------------------------------

/**
 * Hidden Input Field
 *
 * Generates hidden fields.  You can pass a simple key/value string or an associative
 * array with multiple values.
 *
 * @access	public
 * @param	mixed
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_hidden'))
{

	function form_hidden($name, $value = '', $recursing = FALSE)
	{
		static $form;

		$recursing OR $form = "\n";

		if (is_array($name))
		{
			foreach ($name as $key => $val)
			{
				form_hidden($key, $val, TRUE);
			}
			return $form;
		}
		elseif ( ! is_array($value))
		{
			$form .= '<input type="hidden" name="' . $name . '" value="' . form_prep($value, $name) . '" />' . "\n";
		}
		else
		{
			foreach ($value as $k => $v)
			{
				$k = (is_int($k)) ? '' : $k;
				form_hidden($name . '[' . $k . ']', $v, TRUE);
			}
		}

		return $form;
	}

};

// ------------------------------------------------------------------------

/**
 * Text Input Field
 *
 * @access	public
 * @param	mixed
 * @param	string
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_input'))
{

	function form_input($data = '', $value = '', $extra = '')
	{
		return "<input " . _parse_form_attributes($data, array('type' => 'text', 'name' => (( ! is_array($data)) ? $data : ''), 'value' => $value)) . $extra . " />";
	}

};

// ------------------------------------------------------------------------

/**
 * Password Field
 *
 * Identical to the input function but adds the "password" type
 *
 * @access	public
 * @param	mixed
 * @param	string
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_password'))
{

	function form_password($data = '', $value = '', $extra = '')
	{
		(is_array($data)) OR $data = array('name' => $data);

		$data['type'] = 'password';
		return form_input($data, $value, $extra);
	}

};

// ------------------------------------------------------------------------

/**
 * Upload Field
 *
 * Identical to the input function but adds the "file" type
 *
 * @access	public
 * @param	mixed
 * @param	string
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_upload'))
{

	function form_upload($data = '', $value = '', $extra = '')
	{
		(is_array($data)) OR $data = array('name' => $data);

		$data['type'] = 'file';
		return form_input($data, $value, $extra);
	}

};

// ------------------------------------------------------------------------

/**
 * Textarea field
 *
 * @access	public
 * @param	mixed
 * @param	string
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_textarea'))
{

	function form_textarea($data = '', $value = '', $extra = '')
	{
		$defaults = array('name' => (( ! is_array($data)) ? $data : ''), 'cols' => '40', 'rows' => '10');

		if ( ! is_array($data) OR ! isset($data['value']))
		{
			$val = $value;
		}
		else
		{
			$val = $data['value'];
			unset($data['value']); // textareas don't use the value attribute
		}

		$name = (is_array($data)) ? $data['name'] : $data;
		return "<textarea " . _parse_form_attributes($data, $defaults) . $extra . ">" . form_prep($val, $name) . "</textarea>";
	}

};

// ------------------------------------------------------------------------

/**
 * Multi-select menu
 *
 * @access	public
 * @param	string
 * @param	array
 * @param	mixed
 * @param	string
 * @return	type
 */
if ( ! function_exists('form_multiselect'))
{

	function form_multiselect($name = '', $options = array(), $selected = array(), $extra = '')
	{
		(strpos($extra, 'multiple') === FALSE) && $extra .= ' multiple="multiple"';

		return form_dropdown($name, $options, $selected, $extra);
	}

};

// --------------------------------------------------------------------

/**
 * Drop-down Menu
 *
 * @access	public
 * @param	string
 * @param	array
 * @param	string
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_dropdown'))
{

	function form_dropdown($name = '', $options = array(), $selected = array(), $extra = '')
	{
		(is_array($selected)) OR $selected = array($selected);

		// If no selected state was submitted we will attempt to set it automatically
		// If the form name appears in the $_POST array we have a winner!
		(count($selected) === 0 && isset($_POST[$name])) && $selected = array($_POST[$name]);

		($extra != '') && $extra = ' ' . $extra;

		$multiple = (count($selected) > 1 && strpos($extra, 'multiple') === FALSE) ? ' multiple="multiple"' : '';

		$form = '<select name="' . $name . '"' . $extra . $multiple . ">\n";

		foreach ($options as $key => $val)
		{
			$key = (string) $key;

			if (is_array($val) && ! empty($val))
			{
				$form .= '<optgroup label="' . $key . '">' . "\n";

				foreach ($val as $optgroup_key => $optgroup_val)
				{
					$sel = (in_array($optgroup_key, $selected)) ? ' selected="selected"' : '';

					$form .= '<option value="' . $optgroup_key . '"' . $sel . '>' . (string) $optgroup_val . "</option>\n";
				}

				$form .= '</optgroup>' . "\n";
			}
			else
			{
				$sel = (in_array($key, $selected)) ? ' selected="selected"' : '';

				$form .= '<option value="' . $key . '"' . $sel . '>' . (string) $val . "</option>\n";
			}
		}

		$form .= '</select>';

		return $form;
	}

};

// ------------------------------------------------------------------------

/**
 * Checkbox Field
 *
 * @access	public
 * @param	mixed
 * @param	string
 * @param	bool
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_checkbox'))
{

	function form_checkbox($data = '', $value = '', $checked = FALSE, $extra = '')
	{
		$defaults = array('type' => 'checkbox', 'name' => (( ! is_array($data)) ? $data : ''), 'value' => $value);

		if (is_array($data) && array_key_exists('checked', $data))
		{
			$checked = $data['checked'];

			if ($checked == FALSE)
			{
				unset($data['checked']);
			}
			else
			{
				$data['checked'] = 'checked';
			}
		};

		if ($checked == TRUE)
		{
			$defaults['checked'] = 'checked';
		}
		else
		{
			unset($defaults['checked']);
		}

		return "<input " . _parse_form_attributes($data, $defaults) . $extra . " />";
	}

};

// ------------------------------------------------------------------------

/**
 * Radio Button
 *
 * @access	public
 * @param	mixed
 * @param	string
 * @param	bool
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_radio'))
{

	function form_radio($data = '', $value = '', $checked = FALSE, $extra = '')
	{
		is_array($data) OR $data = array('name' => $data);

		$data['type'] = 'radio';
		return form_checkbox($data, $value, $checked, $extra);
	}

};

// ------------------------------------------------------------------------

/**
 * Submit Button
 *
 * @access	public
 * @param	mixed
 * @param	string
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_submit'))
{

	function form_submit($data = '', $value = '', $extra = '')
	{
		return '<input ' . _parse_form_attributes($data
						, array('type' => 'submit', 'name' => (( ! is_array($data)) ? $data : ''), 'value' => $value)) . "{$extra} />";
	}

};

// ------------------------------------------------------------------------

/**
 * Reset Button
 *
 * @access	public
 * @param	mixed
 * @param	string
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_reset'))
{

	function form_reset($data = '', $value = '', $extra = '')
	{
		return '<input ' . _parse_form_attributes($data
						, array('type' => 'reset', 'name' => (( ! is_array($data)) ? $data : ''), 'value' => $value)) . "{$extra} />";
	}

};

// ------------------------------------------------------------------------

/**
 * Form Button
 *
 * @access	public
 * @param	mixed
 * @param	string
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_button'))
{

	function form_button($data = '', $content = '', $extra = '')
	{

		if (is_array($data) && isset($data['content']))
		{
			$content = $data['content'];
			unset($data['content']); // content is not an attribute
		};

		return '<button ' . _parse_form_attributes($data
						, array('name' => (( ! is_array($data)) ? $data : ''), 'type' => 'button'))
				. "{$extra}>{$content}</button>";
	}

};

// ------------------------------------------------------------------------

/**
 * Form Label Tag
 *
 * @access	public
 * @param	string	The text to appear onscreen
 * @param	string	The id the label applies to
 * @param	string	Additional attributes
 * @return	string
 */
if ( ! function_exists('form_label'))
{

	function form_label($label_text = '', $id = '', $attributes = array())
	{

		$label = '<label';

		($id !== '') && $label .= " for=\"$id\"";

		if (is_array($attributes))
		{
			foreach ($attributes as $key => $val)
			{
				$label .= ' ' . $key . '="' . $val . '"';
			}
		};

		$label .= ">$label_text</label>";

		return $label;
	}

};

// ------------------------------------------------------------------------
/**
 * Fieldset Tag
 *
 * Used to produce <fieldset><legend>text</legend>.  To close fieldset
 * use form_fieldset_close()
 *
 * @access	public
 * @param	string	The legend text
 * @param	string	Additional attributes
 * @return	string
 */
if ( ! function_exists('form_fieldset'))
{

	function form_fieldset($legend_text = '', $attributes = array())
	{
		$fieldset = "<fieldset"
				. _attributes_to_string($attributes, FALSE)
				. ">\n";

		return ($legend_text != '') ? "$fieldset<legend>$legend_text</legend>\n" : $fieldset;
	}

};

// ------------------------------------------------------------------------

/**
 * Fieldset Close Tag
 *
 * @access	public
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_fieldset_close'))
{

	function form_fieldset_close($extra = '')
	{
		return "</fieldset>{$extra}";
	}

}

// ------------------------------------------------------------------------

/**
 * Form Close Tag
 *
 * @access	public
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_close'))
{

	function form_close($extra = '')
	{
		return "</form>{$extra}";
	}

};

// ------------------------------------------------------------------------

/**
 * Form Prep
 *
 * Formats text so that it can be safely placed in a form field in the event it has HTML tags.
 *
 * @access	public
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_prep'))
{

	function form_prep($str = '', $field_name = '')
	{
		static $prepped_fields = array();

		// if the field name is an array we do this recursively
		if (is_array($str))
		{
			foreach ($str as $key => $val)
			{
				$str[$key] = form_prep($val);
			}

			return $str;
		}
		elseif ($str === '')
		{
			return '';
		}
		elseif (isset($prepped_fields[$field_name]))
		{
			// we've already prepped a field with this name
			// @todo need to figure out a way to namespace this so
			// that we know the *exact* field and not just one with
			// the same name
			return $str;
		}
		elseif ($field_name != '')
		{
			$prepped_fields[$field_name] = $field_name;
			// In case htmlspecialchars misses these.
			return str_replace(array("'", '"'), array('&#39;', '&quot;'), htmlspecialchars($str));
		}
		else
		{
			return str_replace(array("'", '"'), array('&#39;', '&quot;'), htmlspecialchars($str));
		}
	}

};

// ------------------------------------------------------------------------

/**
 * Form Value
 *
 * Grabs a value from the POST array for the specified field so you can
 * re-populate an input field or textarea.  If Form Validation
 * is active it retrieves the info from the validation class
 *
 * @access	public
 * @param	string
 * @return	mixed
 */
if ( ! function_exists('set_value'))
{

	function set_value($field = '', $default = '')
	{
		if (FALSE === ($OBJ = & _get_validation_object()))
		{
			if ( ! isset($_POST[$field]))
			{
				return $default;
			}
			else
			{
				return form_prep($_POST[$field], $field);
			}
		}
		else
		{
			return form_prep($OBJ->set_value($field, $default), $field);
		}
	}

};

// ------------------------------------------------------------------------

/**
 * Set Select
 *
 * Let's you set the selected value of a <select> menu via data in the POST array.
 * If Form Validation is active it retrieves the info from the validation class
 *
 * @access	public
 * @param	string
 * @param	string
 * @param	bool
 * @return	string
 */
if ( ! function_exists('set_select'))
{

	function set_select($field = '', $value = '', $default = FALSE)
	{
		$OBJ = & _get_validation_object();

		if ($OBJ === FALSE)
		{
			if ( ! isset($_POST[$field]))
			{
				if (empty($_POST) && $default)
				{
					return ' selected="selected"';
				}
				else
				{
					return '';
				}
			};

			$field = $_POST[$field];

			if (is_array($field) && ! in_array($value, $field))
			{
				return '';
			}
			elseif (($field == '' OR $value == '') OR ($field != $value))
			{
				return '';
			}
			else
			{
				return ' selected="selected"';
			}
		}
		else
		{
			return $OBJ->set_select($field, $value, $default);
		}
	}

};

// ------------------------------------------------------------------------

/**
 * Set Checkbox
 *
 * Let's you set the selected value of a checkbox via the value in the POST array.
 * If Form Validation is active it retrieves the info from the validation class
 *
 * @access	public
 * @param	string
 * @param	string
 * @param	bool
 * @return	string
 */
if ( ! function_exists('set_checkbox'))
{

	function set_checkbox($field = '', $value = '', $default = FALSE)
	{
		$OBJ = & _get_validation_object();

		if ($OBJ === FALSE)
		{
			if (isset($_POST[$field]))
			{
				$field = $_POST[$field];

				if (is_array($field) && ! in_array($value, $field))
				{
					return '';
				}
				elseif (($field == '' OR $value == '') OR ($field != $value))
				{
					return '';
				}
				else
				{
					return ' checked="checked"';
				}
			}
			else
			{
				if (empty($_POST) && $default)
				{
					return ' checked="checked"';
				}
				else
				{
					return '';
				}
			}
		}
		else
		{
			return $OBJ->set_checkbox($field, $value, $default);
		}
	}

};

// ------------------------------------------------------------------------

/**
 * Set Radio
 *
 * Let's you set the selected value of a radio field via info in the POST array.
 * If Form Validation is active it retrieves the info from the validation class
 *
 * @access	public
 * @param	string
 * @param	string
 * @param	bool
 * @return	string
 */
if ( ! function_exists('set_radio'))
{

	function set_radio($field = '', $value = '', $default = FALSE)
	{
		$OBJ = & _get_validation_object();

		if ($OBJ === FALSE)
		{
			if ( ! isset($_POST[$field]))
			{
				if (count($_POST) === 0 && $default)
				{
					return ' checked="checked"';
				}
				else
				{
					return '';
				}
			};

			$field = $_POST[$field];

			if (is_array($field) && ! in_array($value, $field))
			{
				return '';
			}
			elseif (($field == '' OR $value == '') OR ($field != $value))
			{
				return '';
			}
			else
			{
				return ' checked="checked"';
			}
		}
		else
		{
			return $OBJ->set_radio($field, $value, $default);
		}
	}

};

// ------------------------------------------------------------------------

/**
 * Form Error
 *
 * Returns the error for a specific form field.  This is a helper for the
 * form validation class.
 *
 * @access	public
 * @param	string
 * @param	string
 * @param	string
 * @return	string
 */
if ( ! function_exists('form_error'))
{

	function form_error($field = '', $prefix = '', $suffix = '')
	{
		if (FALSE === ($OBJ = & _get_validation_object()))
		{
			return '';
		}
		else
		{
			return $OBJ->error($field, $prefix, $suffix);
		}
	}

};

// ------------------------------------------------------------------------

/**
 * Validation Error String
 *
 * Returns all the errors associated with a form submission.  This is a helper
 * function for the form validation class.
 *
 * @access	public
 * @param	string
 * @param	string
 * @return	string
 */
if ( ! function_exists('validation_errors'))
{

	function validation_errors($prefix = '', $suffix = '')
	{
		if (FALSE === ($OBJ = & _get_validation_object()))
		{
			return '';
		}
		else
		{
			return $OBJ->error_string($prefix, $suffix);
		}
	}

};

// ------------------------------------------------------------------------

/**
 * Parse the form attributes
 *
 * Helper function used by some of the form helpers
 *
 * @access	private
 * @param	array
 * @param	array
 * @return	string
 */
if ( ! function_exists('_parse_form_attributes'))
{

	function _parse_form_attributes($attributes, $default)
	{
		if (is_array($attributes))
		{
			foreach ($default as $key => $val)
			{
				if (isset($attributes[$key]))
				{
					$default[$key] = $attributes[$key];
					unset($attributes[$key]);
				};
			}

			(count($attributes) > 0) && $default = array_merge($default, $attributes);
		};

		$att = '';

		foreach ($default as $key => $val)
		{
			($key == 'value') && $val = form_prep($val, $default['name']);

			$att .= $key . '="' . $val . '" ';
		}

		return $att;
	}

};

// ------------------------------------------------------------------------

/**
 * Attributes To String
 *
 * Helper function used by some of the form helpers
 *
 * @access	private
 * @param	mixed
 * @param	bool
 * @return	string
 */
if ( ! function_exists('_attributes_to_string'))
{

	function _attributes_to_string($attributes, $formtag = FALSE)
	{
		if (is_string($attributes) && isset($attributes[0]))
		{
			($formtag && strpos($attributes, 'method=') === FALSE) && $attributes .= ' method="post"';

			($formtag && strpos($attributes, 'accept-charset=') === FALSE) && $attributes .= ' accept-charset="' . strtolower(config_item('charset')) . '"';

			return " $attributes";
		}
		elseif (is_object($attributes) && count($attributes) > 0)
		{
			$attributes = (array) $attributes;
		};

		if (is_array($attributes) && count($attributes) > 0)
		{
			$atts = '';

			( ! isset($attributes['method']) && $formtag === TRUE) && $atts .= ' method="post"';

			( ! isset($attributes['accept-charset']) && $formtag === TRUE) && $atts .= ' accept-charset="' . strtolower(config_item('charset')) . '"';

			foreach ($attributes as $key => $val)
			{
				$atts .= ' ' . $key . '="' . $val . '"';
			}

			return $atts;
		};
	}

};

// ------------------------------------------------------------------------

/**
 * Validation Object
 *
 * Determines what the form validation class was instantiated as, fetches
 * the object and returns it.
 *
 * @access	private
 * @return	mixed
 */
if ( ! function_exists('_get_validation_object'))
{

	function &_get_validation_object()
	{
		$CI = & get_instance();

		// We set this as a variable since we're returning by reference.
		$return = FALSE;

		if (FALSE !== ($object = $CI->load->is_loaded('form_validation')))
		{
			if (isset($CI->$object) && is_object($CI->$object))
			{
				return $CI->$object;
			}
			else
			{
				return $return;
			}
		}
		else
		{
			return $return;
		}
	}

}


/* End of file form_helper.php */
/* Location: ./system/helpers/form_helper.php */
