<?php

/**
 * @author   	Dimas Begunoff
 * @copyright	Copyright (c) 2011, Dimas Begunoff, http://farinspace.com/
 * @license  	http://en.wikipedia.org/wiki/MIT_License The MIT License
 * @package  	WPAlchemy
 * @version  	0.2.1
 * @link     	http://github.com/farinspace/wpalchemy/
 * @link     	http://farinspace.com/
 */

 class WPAlchemy_MediaAccess
{
	/**
	 * User defined identifier for the css class name of the HTML button element,
	 * used when pairing the field and button elements
	 *
	 * @since	0.1
	 * @access	public
	 * @var		string required
	 */
	public $button_class_name = 'mediabutton';

	/**
	 * User defined identifier for the css class name of the HTML field element,
	 * used when pairing the field and button elements
	 *
	 * @since	0.1
	 * @access	public
	 * @var		string required
	 */
	public $field_class_name = 'mediainput';

	/**
	 * User defined label for the insert button in the media upload box, this
	 * can be set once or per field and button pair.
	 *
	 * @since	0.1
	 * @access	public
	 * @var		string optional
	 * @see		setInsertButtonLabel()
	 */
	public $insert_button_label = null;

	/**
	 * Used to track the current groupname for pairing a field and button.
	 *
	 * @since	0.1
	 * @access	private
	 * @var		string
	 * @see		setGroupName()
	 */
	private $groupname = null;

	/**
	 * Used to track the current tab for the media upload box.
	 *
	 * @since	0.1
	 * @access	private
	 * @var		string
	 * @see		setTab()
	 */
	private $tab = null;

	/**
	 * MediaAccess class
	 *
	 * @since	0.1
	 * @access	public
	 * @param	array $a
	 */
	public function __construct(array $a = array())
	{
		foreach ($a as $n => $v)
		{
			$this->$n = $v;
		}

		if ( ! defined('WPALCHEMY_SEND_TO_EDITOR_ENABLED'))
		{
			// Ensure the media upload scripts and styles are added
			add_action( "admin_print_scripts", array( $this, "enqueueAdminScripts") );
			// Ensure send to editor button is added.
			add_filter( "get_media_item_args", array( $this, "getMediaItemArgs" ) );
			// Initialize the footer script
			add_action('admin_footer', array($this, 'init'));

			define('WPALCHEMY_SEND_TO_EDITOR_ENABLED', true);
		}
		
		
	}

	/**
	 * Used to ensure the Insert button is added to media upload panel
	 * in case the editor isn't present on the screen.
	 *
	 * @since 0.2.1
	 * @access public
	 * @param array $args Arguments for media upload
	 * @return $args
	 */
	function getMediaItemArgs( $args ) {
		$args['send'] = true;
		return $args;
	}

	/**
	 * Used to enqueue media upload scripts
	 * in case the editor isn't present on the screen.
	 *
	 * @since 0.2.1
	 * @access public
	 */
	public function enqueueAdminScripts() 
	{
		wp_enqueue_style('thickbox');
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
	}

	/**
	 * Used to generate short unique/random names
	 *
	 * @since	0.1
	 * @access	public
	 * @return	string
	 */
	private function getName()
	{
		return substr(md5(microtime() . rand()), rand(0,25), 6);
	}

	/**
	 * Used to set the insert button label in the media upload box, this can be
	 * set once or per field and button pair.
	 *
	 * @since	0.1
	 * @access	public
	 * @param	string $label button label/title
	 * @return	object $this
	 * @see		setGroupName()
	 */
	public function setInsertButtonLabel($label = 'Insert')
	{
		$this->insert_button_label = $label;

		return $this;
	}

	/**
	 * Used before calls to getField(), getButton() or getButtonClass() to set
	 * the groupname to pair a field and button element.
	 *
	 * @since	0.1
	 * @access	public
	 * @param	string $name unique name per pair of field and button
	 * @return	object $this
	 * @see		setInsertButtonLabel()
	 */
	public function setGroupName($name)
	{
		$this->groupname = $name;

		return $this;
	}

	/**
	 * Used to insert a form field of type "text", this should be paired with a
	 * button element. The name and value attributes are required.
	 *
	 * @since	0.1
	 * @access	public
	 * @param	array $attr INPUT tag parameters
	 * @return	HTML
	 * @see		getButton()
	 */
	public function getField(array $attr)
	{
		$groupname = isset($attr['groupname']) ? $attr['groupname'] : $this->groupname ;
		
		$attr_default = array
		(
			'type' => 'text',
			'class' => $this->field_class_name . '-' . $groupname,
			'data-button' => '.mediabutton.' . $this->field_class_name . '-' . $groupname
		);

		###

		if (isset($attr['class']))
		{
			$attr['class'] = $attr_default['class'] . ' ' . trim($attr['class']);
		}

		$attr = array_merge($attr_default, $attr);

		###

		$elem_attr = array();

		foreach ($attr as $n => $v)
		{
			array_push($elem_attr, $n . '="' . $v . '"');
		}

		###

		return '<input ' . implode(' ', $elem_attr) . '/>';
	}

	/**
	 * Used to get the CSS class name(s) used for the button element. If
	 * creating custom buttons, this method should be used to get the css class
	 * names needed for proper functionality.
	 *
	 * @since	0.1
	 * @access	public
	 * @param	string $groupname name used when pairing a text field and button
	 * @return	string css class(es)
	 * @see		getButtonLink(), getButton()
	 */
	public function getButtonClass($groupname = null)
	{
		$groupname = isset($groupname) ? $groupname : $this->groupname ;
		
		return $this->button_class_name . '-' . $groupname . ' insert-media';
	}

	/**
	 * Used to get the CSS class name used for the field element. If
	 * creating a custom field, this method should be used to get the css class
	 * name needed for proper functionality.
	 *
	 * @since	0.2
	 * @access	public
	 * @param	string $groupname name used when pairing a text field and button
	 * @return	string css class(es)
	 * @see		getButtonClass(), getField()
	 */
	public function getFieldClass($groupname = null)
	{
		$groupname = isset($groupname) ? $groupname : $this->groupname ;

		return $this->field_class_name . '-' . $groupname;
	}

	/**
	 * Used to insert a WordPress styled button, should be paired with a text
	 * field element.
	 *
	 * @since	0.1
	 * @access	public
	 * @return	HTML
	 * @see		getField(), getButtonClass(), getButtonLink()
	 */
	public function getButton(array $attr = array())
	{
		$groupname = isset($attr['groupname']) ? $attr['groupname'] : $this->groupname ;

		$tab = isset($attr['tab']) ? $attr['tab'] : $this->tab ;
		
		$attr_default = array
		(
			'label' => 'Add Media',
			'href' => '#',
			'class' => $this->getButtonClass($groupname) . ' button',
			'data-input' => '.mediainput.' . $this->field_class_name . '-' . $groupname
		);

		if (isset($this->insert_button_label))
		{
			$attr_default['data-button-label'] = $this->insert_button_label;
		}

		###

		if (isset($attr['class']))
		{
			$attr['class'] = $attr_default['class'] . ' ' . trim($attr['class']);
		}

		$attr = array_merge($attr_default, $attr);

		$label = $attr['label'];

		unset($attr['label']);

		###

		$elem_attr = array();

		foreach ($attr as $n => $v)
		{
			array_push($elem_attr, $n . '="' . $v . '"');
		}

		###

		return '<a ' . implode(' ', $elem_attr) . '>' . $label . '</a>';
	}

	/**
	 * Used to insert global STYLE or SCRIPT tags into the footer, called on
	 * WordPress admin_footer action.
	 *
	 * @since	0.1
	 * @access	public
	 * @return	HTML/Javascript
	 */
	public function init()
	{
		$uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : NULL ;

		$file = basename(parse_url($uri, PHP_URL_PATH));

		if ($uri AND in_array($file, array('post.php', 'post-new.php')))
		{
			// include javascript for special functionality
			?><script type="text/javascript">
			/* <![CDATA[ */
				jQuery(function($) {
					Wpalchemy = {
						sendToEditorDefault: window.send_to_editor,
						mediaField: null,
						mediaGallery: '#__wp-uploader-id-2',

						init: function() {
							var that = this;
							if (typeof window.send_to_editor === 'function') {
								// Bind to the document click event,
								// Delegate the event to MediaAccess' button class.
								$(document).on('click', '[class*=<?= $this->button_class_name; ?>]', function(e) {
									e.preventDefault();
									that.getmediaField($(this));
									return false;
								});
							}
						},

						/*
						* Get the src and id of the selected image
						* Set the value of the field to the src (or the id if data-id is set)
						*/
						getSelectedImage: function(html) {
							var src = html.match(/src=['|"](.*?)['|"] alt=/i),
							href = html.match(/href=['|"](.*?)['|"]/i),
							url,
							id = html.match(/wp-image-(\d+)/);

							src = ( src && src[ 1 ] ) ? src[ 1 ] : '';
							href = ( href && href[ 1 ] ) ? href[ 1 ] : '';
							url = src || href;
							id = (id && id[1]) ? id[1] : '';

							if(this.mediaField.data('id')) {
								this.mediaField.val(id);
								this.mediaField.attr('data-url', url);
							} else {
								this.mediaField.val(url);
							}
							
							this.mediaField.trigger('change');
							this.mediaField = null;
							this.showMediaOptions();

							window.send_to_editor = this.sendToEditorDefault;
						},

						/**
						 * Returns the triggered elements label
						 */
						getTriggerLabel: function() {
							var label = this.mediaField.data("button-label"); // Get the data button-label property.
							return (label) ? label : "Insert"; // If the label is set, return the label, otherwise return "Insert"
						},

						setInsertButtonLabel: function(label) {
							$(this.mediaGallery).find('.media-button-insert').html(label);
						},

						hideMediaOptions: function() {
							$(this.mediaGallery).find('.media-menu-item').hide().first().show();
						},

						showMediaOptions: function() {
							$(this.mediaGallery).find('.media-menu-item').show();
						},

						setupGallery: function() {
							var that = this;

							this.setInsertButtonLabel(this.getTriggerLabel());
							this.hideMediaOptions();
							
							window.send_to_editor = function(html) {
								that.getSelectedImage(html);
							};				
						},

						/** 
						 * Get the field that media is being selected for
						 * Also replace send_to_editor with getSelectedImage to handle the image when it is selected
						 */
						getmediaField: function(element) {
							var name = element.attr('class').match(/<?php echo $this->button_class_name; ?>-([\d\w_-]*)/i),
							index;

							name = (name && name[1]) ? name[1] : '';
							index = element.index('.postbox .<?= $this->button_class_name; ?>-' + name);

							this.mediaField = $('.postbox .<?= $this->field_class_name; ?>-' + name).eq(index);
							this.setupGallery();
						}
					}
					Wpalchemy.init();		
				});
			/* ]]> */
			</script><?php
		}
	}
}

/* End of file */