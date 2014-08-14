<?php

/**
 * @author		Dimas Begunoff
 * @author		James Lyne
 * @copyright	Copyright (c) 2009, Dimas Begunoff, http://farinspace.com
 * @license		http://en.wikipedia.org/wiki/MIT_License The MIT License
 * @package		WPAlchemy
 * @version		2.2
 * @link		http://github.com/farinspace/wpalchemy
 * @link		http://farinspace.com
 */

define('WPALCHEMY_MODE_ARRAY', 'array');

define('WPALCHEMY_MODE_EXTRACT', 'extract');

define('WPALCHEMY_FIELD_HINT_TEXT', 'text');

define('WPALCHEMY_FIELD_HINT_TEXTAREA', 'textarea');

define('WPALCHEMY_FIELD_HINT_CHECKBOX', 'checkbox');

define('WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI', 'checkbox_multi');

define('WPALCHEMY_FIELD_HINT_RADIO', 'radio');

define('WPALCHEMY_FIELD_HINT_SELECT', 'select');

define('WPALCHEMY_FIELD_HINT_SELECT_MULTI', 'select_multi');

define('WPALCHEMY_FIELD_HINT_SELECT_MULTIPLE', 'select_multi');

define('WPALCHEMY_LOCK_TOP', 'top');

define('WPALCHEMY_LOCK_BOTTOM', 'bottom');

define('WPALCHEMY_LOCK_BEFORE_POST_TITLE', 'before_post_title');

define('WPALCHEMY_LOCK_AFTER_POST_TITLE', 'after_post_title');

define('WPALCHEMY_VIEW_START_OPENED', 'opened');

define('WPALCHEMY_VIEW_START_CLOSED', 'closed');

define('WPALCHEMY_VIEW_ALWAYS_OPENED', 'always_opened');

if(!defined('DEBUG_BACKTRACE_IGNORE_ARGS')) {
	define('DEBUG_BACKTRACE_IGNORE_ARGS', 0);
}

class WPAlchemy_MetaBox {
	/**
	 * User defined identifier for the meta box, prefix with an underscore to
	 * prevent option(s) form showing up in the custom fields meta box, this
	 * option should be used when instantiating the class.
	 *
	 * @since	1.0
	 * @access	public
	 * @var		string required
	 */
	public $id;

	/**
	 * Used to set the title of the meta box, this option should be used when
	 * instantiating the class.
	 *
	 * @since	1.0
	 * @access	public
	 * @var		string required
	 * @see		$hide_title
	 */
	public $title = 'Custom Meta';

	/**
	 * Used to set the meta box content, the contents of your meta box should be
	 * defined within this file, this option should be used when instantiating
	 * the class.
	 *
	 * @since	1.0
	 * @access	public
	 * @var		string required
	 */
	public $template;

	/**
	 * Used to set the post types that the meta box can appear in, this option 
	 * should be used when instantiating the class.
	 *
	 * @since	1.0
	 * @access	public
	 * @var		array 
	 */
	public $types;

	/**
	 * @since	1.0
	 * @access	public
	 * @var		bool
	 */
	public $context = 'normal';

	/**
	 * @since	1.0
	 * @access	public
	 * @var		bool
	 */
	public $priority = 'high';
	
	/**
	 * @since	1.0
	 * @access	public
	 * @var		bool
	 */
	public $autosave = TRUE;

	/**
	 * Used to set how the class does its data storage, data will be stored as
	 * an associative array in a single meta entry in the wp_postmeta table or
	 * data can be set and individual entries in the wp_postmeta table, the 
	 * following constants should be used when setting this option, 
	 * WPALCHEMY_MODE_ARRAY (default) and WPALCHEMY_MODE_EXTRACT, this option
	 * should be used when instantiating the class.
	 *
	 * @since	1.2
	 * @access	public
	 * @var		string
	 */
	public $mode = WPALCHEMY_MODE_ARRAY;

	/**
	 * When the mode option is set to WPALCHEMY_MODE_EXTRACT, you have to take
	 * care to avoid name collisions with other meta entries. Use this option to
	 * automatically add a prefix to your variables, this option should be used
	 * when instantiating the class.
	 *
	 * @since	1.2
	 * @access	public
	 * @var		array
	 */
	public $prefix;

	/**
	 * @since	1.0
	 * @access	public
	 * @var		bool
	 */
	public $exclude_template;

	/**
	 * @since	1.0
	 * @access	public
	 * @var		bool
	 */
	public $exclude_category_id;

	/**
	 * @since	1.0
	 * @access	public
	 * @var		bool
	 */
	public $exclude_category;

	/**
	 * @since	1.0
	 * @access	public
	 * @var		bool
	 */
	public $exclude_tag_id;

	/**
	 * @since	1.0
	 * @access	public
	 * @var		bool
	 */
	public $exclude_tag;

	/**
	 * @since	1.0
	 * @access	public
	 * @var		bool
	 */
	public $exclude_post_id;

	/**
	 * @since	1.0
	 * @access	public
	 * @var		bool
	 */
	public $include_template;

	/**
	 * @since	1.0
	 * @access	public
	 * @var		bool
	 */
	public $include_category_id;

	/**
	 * @since	1.0
	 * @access	public
	 * @var		bool
	 */
	public $include_category;

	/**
	 * @since	1.0
	 * @access	public
	 * @var		bool
	 */
	public $include_tag_id;

	/**
	 * @since	1.0
	 * @access	public
	 * @var		bool
	 */
	public $include_tag;

	/**
	 * @since	1.0
	 * @access	public
	 * @var		bool
	 */
	public $include_post_id;

	/**
	 * Callback used on the WordPress "admin_init" action, the main benefit is 
	 * that this callback is executed only when the meta box is present, this
	 * option should be used when instantiating the class.
	 *
	 * @since	1.3.4
	 * @access	public
	 * @var		string|array optional
	 */
	public $init_action;

	/**
	 * Callback used to override when the meta box gets displayed, must return
	 * true or false to determine if the meta box should or should not be
	 * displayed, this option should be used when instantiating the class.
	 *
	 * @since	1.3
	 * @access	public
	 * @var		string|array optional
	 * @param	array $post_id first variable passed to the callback function
	 * @see		can_output()
	 */
	public $output_filter;

	/**
	 * Callback used to override or insert meta data before saving, you can halt
	 * saving by passing back FALSE (return FALSE), this option should be used
	 * when instantiating the class.
	 *
	 * @since	1.3
	 * @access	public
	 * @var		string|array optional
	 * @param	array $meta meta box data, first variable passed to the callback function
	 * @param	string $post_id second variable passed to the callback function
	 * @see		$save_action, add_filter()
	 */
	public $save_filter;

	/**
	 * Callback used to execute custom code after saving, this option should be
	 * used when instantiating the class.
	 *
	 * @since	1.3
	 * @access	public
	 * @var		string|array optional
	 * @param	array $meta meta box data, first variable passed to the callback function
	 * @param	string $post_id second variable passed to the callback function
	 * @see		$save_filter, add_filter()
	 */
	public $save_action;

	/**
	 * Callback used to override or insert STYLE or SCRIPT tags into the head,
	 * this option should be used when instantiating the class.
	 *
	 * @since	1.3
	 * @access	public
	 * @var		string|array optional
	 * @param	array $content current head content, first variable passed to the callback function
	 * @see		$head_action, add_filter()
	 */
	public $head_filter;

	/**
	 * Callback used to insert STYLE or SCRIPT tags into the head,
	 * this option should be used when instantiating the class.
	 *
	 * @since	1.3
	 * @access	public
	 * @var		string|array optional
	 * @see		$head_filter, add_action()
	 */
	public $head_action;

	/**
	 * Callback used to override or insert SCRIPT tags into the footer, this
	 * option should be used when instantiating the class.
	 *
	 * @since	1.3
	 * @access	public
	 * @var		string|array optional
	 * @param	array $content current foot content, first variable passed to the callback function
	 * @see		$foot_action, add_filter()
	 */
	public $foot_filter;

	/**
	 * Callback used to insert SCRIPT tags into the footer, this option should
	 * be used when instantiating the class.
	 *
	 * @since	1.3
	 * @access	public
	 * @var		string|array optional
	 * @see		$foot_filter, add_action()
	 */
	public $foot_action;

	/**
	 * Used to hide the default content editor in a page or post, this option
	 * should be used when instantiating the class.
	 *
	 * @since	1.3
	 * @access	public
	 * @var		bool optional
	 */
	public $hide_editor = FALSE;

	/**
	 * Used in conjunction with the "hide_editor" option, prevents the media
	 * buttons from also being hidden.
	 *
	 * @since	1.5
	 * @access	public
	 * @var		bool optional
	 */
	public $use_media_buttons = FALSE;
	
	/**
	 * Used to hide the meta box title, this option should be used when
	 * instantiating the class.
	 *
	 * @since	1.3
	 * @access	public
	 * @var		bool optional
	 * @see		$title
	 */
	public $hide_title = FALSE;

	/**
	 * Used to lock a meta box in place, possible values are: top, bottom, 
	 * before_post_title, after_post_title, this option should be used when
	 * instantiating the class.
	 *
	 * @since		1.3.3
	 * @access		public
	 * @var			string optional possible values are: top, bottom, before_post_title, after_post_title
	 */
	public $lock;

	/**
	 * Used to set the initial view state of the meta box, possible values are:
	 * opened, closed, always_opened, this option should be used when
	 * instantiating the class.
	 *
	 * @since	1.3.3
	 * @access	public
	 * @var		string optional possible values are: opened, closed, always_opened
	 */
	public $view;

	/**
	 * Used to hide the show/hide checkbox option from the screen options area,
	 * this option should be used when instantiating the class.
	 *
	 * @since		1.3.4
	 * @access		public
	 * @var			bool optional
	 */
	public $hide_screen_option = FALSE;

	/**
	 * Used to store the rendered template HTML before display
	 *
	 * @since	2.1
	 * @access	private
	 * @var		string
	 */
	private $html;

	/**
	 * Contains the metadata for the metabox
	 *
	 * @since	1.0
	 * @access	private
	 * @var		array
	 */
	private $meta;

	/**
	 * Contains the name of the current field
	 * @since	1.0
	 * @access	private
	 * @var		string
	 */
	private $name;

	/**
	 * Contains any errors encountered 
	 * during processing of the metabox template
	 * @since	2.1
	 * @access	private
	 * @var		array
	 */
	private $errors = array();

	/**
	 * Used to provide field type hinting
	 *
	 * @since	1.3
	 * @access	private
	 * @var		string
	 * @see		the_field()
	 */
	private $hint;

	/**
	 * Contains the current loop hierachy
	 * along with details of each loop
	 *
	 * @since	2.0
	 * @access	private
	 * @var		array
	 */
	private $loops = array();

	/**
	 * Flag indicating whether the
	 * template is currently being
	 * processed
	 *
	 * @since	1.0
	 * @access	private
	 * @var		boolean
	 * @see		_setup()
	 */
	private $in_template = FALSE;

	/**
	 * The ID of the current post
	 *
	 * @since	1.0
	 * @access	private
	 * @var		int
	 */
	private $current_post_id;

	public function __construct($arr) {
		
		$this->meta = array();

		$this->types = array('post', 'page');

		if (is_array($arr)) {
			foreach ($arr as $n => $v) {
				$this->$n = $v;
			}

			if (empty($this->id)) die('Meta box ID required');

			if (is_numeric($this->id)) die('Meta box ID must be a string');

			if (empty($this->template)) die('Meta box template file required');

			// check for nonarray values
			
			$exc_inc = array(
				'exclude_template',
				'exclude_category_id',
				'exclude_category',
				'exclude_tag_id',
				'exclude_tag',
				'exclude_post_id',

				'include_template',
				'include_category_id',
				'include_category',
				'include_tag_id',
				'include_tag',
				'include_post_id'
			);

			foreach ($exc_inc as $v) {
				// ideally the exclude and include values should be in array form, convert to array otherwise
				if (!empty($this->$v) AND !is_array($this->$v)) {
					$this->$v = array_map('trim',explode(',',$this->$v));
				}
			}

			add_action('admin_init', array($this,'_init'));

			add_action('admin_head', array($this, '_global_head'));

			// uses the default wordpress-importer plugin hook
			add_action('import_post_meta', array($this, '_import'), 10, 3);
		} else {
			die('Associative array parameters required');
		}
	}

	/**
	 * Used to correct double serialized data during post/page export/import,
	 * additionally will try to fix corrupted serialized data by recalculating
	 * string length values
	 *
	 * @since	1.3.16
	 * @access	private
	 */
	private function _import($post_id, $key, $value) {
		if (WPALCHEMY_MODE_ARRAY == $this->mode AND $key == $this->id) {
			// using $wp_import to get access to the raw postmeta data prior to it getting passed
			// through "maybe_unserialize()" in "plugins/wordpress-importer/wordpress-importer.php"
			// the "import_post_meta" action is called after "maybe_unserialize()"
			
			global $wp_import;

			foreach ( $wp_import->posts as $post ) {
				if ( $post_id == $post['post_id'] ) {
					foreach( $post['postmeta'] as $meta ) {
						if ( $key == $meta['key'] ) {
							// try to fix corrupted serialized data, specifically "\r\n" being converted to "\n" during wordpress XML export (WXR)
							// "maybe_unserialize()" fixes a wordpress bug which double serializes already serialized data during export/import
							$value = maybe_unserialize( preg_replace( '!s:(\d+):"(.*?)";!es', "'s:'.strlen('$2').':\"$2\";'", stripslashes( $meta['value'] ) ) );
							
							update_post_meta( $post_id, $key,  $value );
						}
					}
				}
			}
		}
	}

	/**
	 * Used to initialize the meta box, runs on WordPress admin_init action,
	 * properly calls internal WordPress methods
	 *
	 * @since	1.0
	 * @access	private
	 */
	public function _init() {
		// must be creating or editing a post or page
		if ( ! WPAlchemy_MetaBox::_is_post() AND ! WPAlchemy_MetaBox::_is_page()) return;
		
		if ( ! empty($this->output_filter)) {
			$this->add_filter('output', $this->output_filter);
		}

		if ($this->can_output()) {
			foreach ($this->types as $type) {
				add_meta_box($this->id . '-metabox', $this->title, array($this, '_setup'), $type, $this->context, $this->priority);
			}

			add_action('save_post', array($this,'_save'));

			$filters = array('save', 'head', 'foot');

			foreach ($filters as $filter) {
				$var = $filter . '_filter';

				if (!empty($this->$var)) {
					if ('save' == $filter) {
						$this->add_filter($filter, $this->$var, 10, 2);
					} else {
						$this->add_filter($filter, $this->$var);
					}
				}
			}

			$actions = array('save', 'head', 'foot', 'init');

			foreach ($actions as $action) {
				$var = $action . '_action';

				if (!empty($this->$var)) {
					if ('save' == $action) {
						$this->add_action($action, $this->$var, 10, 2);
					} else {
						$this->add_action($action, $this->$var);
					}
				}
			}

			add_action('admin_head', array($this,'_head'), 11);

			add_action('admin_footer', array($this,'_foot'), 11);

			// action: init
			if ($this->has_action('init')) {
				$this->do_action('init');
			}
		}
	}

	/**
	 * Used to insert STYLE or SCRIPT tags into the head, called on WordPress
	 * admin_head action.
	 * 
	 * @since	1.3
	 * @access	private
	 * @see		_foot()
	 */
	public function _head() {
		$content = NULL;

		ob_start();

		?>
		<style type="text/css">
			<?php if($this->hide_editor) : ?> 
			#wp-content-editor-container, 
			#post-status-info, 
			<?php if($this->use_media_buttons) : ?>
			#content-html, #content-tmce
			<?php else : ?> 
			#wp-content-wrap
			<?php endif; ?>
			{ 
				display:none; 
			} 
			<?php endif; ?>
		</style>
		<?php

		$content = ob_get_contents();

		ob_end_clean();

		// filter: head
		if ($this->has_filter('head')) {
			$content = $this->apply_filters('head', $content);
		}

		echo $content;

		// action: head
		if ($this->has_action('head')) {
			$this->do_action('head');
		}
	}

	/**
	 * Used to insert SCRIPT tags into the footer, called on WordPress
	 * admin_footer action.
	 *
	 * @since	1.3
	 * @access	private
	 * @see		_head()
	 */
	public function _foot() {
		$content = NULL;

		if
		(
			$this->lock OR
			$this->hide_title OR
			$this->view OR
			$this->hide_screen_option
		)
		{
			ob_start();

			?>
			<script type="text/javascript">
			/* <![CDATA[ */
			(function($){ /* not using jQuery ondomready, code runs right away in footer */

				var mb_id = '<?php echo $this->id; ?>';
				var mb = $('#' + mb_id + '-metabox');

				<?php if (WPALCHEMY_LOCK_TOP == $this->lock): ?>
				<?php if ('side' == $this->context): ?>
				var id = 'wpa-side-top';
				if ( ! $('#'+id).length)
				{
					$('<div></div>').attr('id',id).prependTo('#side-info-column');
				}
				<?php else: ?>
				var id = 'wpa-content-top';
				if ( ! $('#'+id).length)
				{
					$('<div></div>').attr('id',id).insertAfter('#postdiv, #postdivrich');
				}
				<?php endif; ?>
				$('#'+id).append(mb);
				<?php elseif (WPALCHEMY_LOCK_BOTTOM == $this->lock): ?>
				<?php if ('side' == $this->context): ?>
				var id = 'wpa-side-bottom';
				if ( ! $('#'+id).length)
				{
					$('<div></div>').attr('id',id).appendTo('#side-info-column');
				}
				<?php else: ?>
				if ( ! $('#advanced-sortables').children().length)
				{
					$('#advanced-sortables').css('display','none');
				}

				var id = 'wpa-content-bottom';
				if ( ! $('#'+id).length)
				{
					$('<div></div>').attr('id',id).insertAfter('#advanced-sortables');
				}
				<?php endif; ?>
				$('#'+id).append(mb);
				<?php elseif (WPALCHEMY_LOCK_BEFORE_POST_TITLE == $this->lock): ?>
				<?php if ('side' != $this->context): ?>
				var id = 'wpa-content-bpt';
				if ( ! $('#'+id).length)
				{
					$('<div></div>').attr('id',id).prependTo('#post-body-content');
				}
				$('#'+id).append(mb);
				<?php endif; ?>
				<?php elseif (WPALCHEMY_LOCK_AFTER_POST_TITLE == $this->lock): ?>
				<?php if ('side' != $this->context): ?>
				var id = 'wpa-content-apt';
				if ( ! $('#'+id).length)
				{
					$('<div></div>').attr('id',id).insertAfter('#titlediv');
				}
				$('#'+id).append(mb);
				<?php endif; ?>
				<?php endif; ?>

				<?php if ( ! empty($this->lock)): ?>
				$('.hndle', mb).css('cursor','pointer');
				$('.handlediv', mb).remove();
				<?php endif; ?>

				<?php if ($this->hide_title): ?>
				$('.hndle', mb).remove();
				$('.handlediv', mb).remove();
				mb.removeClass('closed'); /* start opened */
				<?php endif; ?>

				<?php if (WPALCHEMY_VIEW_START_OPENED == $this->view): ?>
				mb.removeClass('closed');
				<?php elseif (WPALCHEMY_VIEW_START_CLOSED == $this->view): ?>
				mb.addClass('closed');
				<?php elseif (WPALCHEMY_VIEW_ALWAYS_OPENED == $this->view): ?>
				/* todo: need to find a way to add this script block below, load-scripts.php?... */
				var h3 = mb.children('h3');
				setTimeout(function(){ h3.unbind('click'); }, 1000);
				$('.handlediv', mb).remove();
				mb.removeClass('closed'); /* start opened */
				$('.hndle', mb).css('cursor','auto');
				<?php endif; ?>

				<?php if ($this->hide_screen_option): ?>
					$('.metabox-prefs label[for='+ mb_id +'_metabox-hide]').remove();
				<?php endif; ?>

				mb = null;

			})(jQuery);
			/* ]]> */
			</script>
			<?php

			$content = ob_get_contents();

			ob_end_clean();
		}
		
		// filter: foot
		if ($this->has_filter('foot'))
		{
			$content = $this->apply_filters('foot', $content);
		}

		echo $content;

		// action: foot
		if ($this->has_action('foot'))
		{
			$this->do_action('foot');
		}
	}

	/**
	 * Used to report an error in the metabox template
	 * Errors are added to the errors array for later display
	 *
	 * @since	2.1
	 * @access	private
	 * @param 	string $title the title of the error
	 * @param   string $message the description of the error
	 * @see		show_errors()
	 */
	private function error($title = 'WPAlchemy', $message = 'Unknown Error') {
		$this->errors[] = array(
			'title' => $title,
			'message' => $message
		);
	}

	/**
	 * Creates and returns wordpress notice containing any
	 * errors stored in the errors array
	 *
	 * @since	2.1
	 * @access	private
	 * @see		error()
	 */
	public function show_errors() {
		if(count($this->errors)) {
			$html = '<div class="error">';
			$html .= '<p><strong>WPAlchemy: ' . $this->title . ' (' . $this->id . ') contains errors and may not function correctly:</strong>';
			$html .= '<ul>';

			foreach($this->errors as $error) {
				$html .= '<li><strong>' . $error['title'] . '</strong><p>' . $error['message'] . '</p></li>';
			}

			$html .= '</ul></p></div>';
			return $html;
		}
	}

	/**
	 * Handles PHP errors that occur in the metabox template
	 * Any errors are added to the errors array to be displayed
	 * in a wordpress notice
	 *
	 * @since	2.1
	 * @access	private
	 */
	public function handle_php_error($errno = 0, $errstr = '', $errfile = '', $errline = '') {
		$errstr = $errstr . ' on line ' . $errline;
		switch($errno) {
			case E_USER_ERROR :
				$this->error('PHP Error (E_USER_ERROR)', $errstr);
				break;
			case E_USER_WARNING :
				$this->error('PHP Warning (E_USER_WARNING)', $errstr);
				break;
			case E_WARNING :
				$this->error('PHP Warning (E_WARNING)', $errstr);
				break;
			case E_RECOVERABLE_ERROR :
				$this->error('PHP Catcheable Fatal Error (E_RECOVERABLE_ERROR)', $errstr);
				break;
			default :
				return false;
		}
		return true;
	}

	/**
	 * Handles PHP fatal errors that occur in the metabox template
	 * The error is added to the errors array and all errors are
	 * immediately shown in a wordpress notice
	 *
	 * @param   bool disable disables the function as shutdown functions can't be unregistered
	 * @since	2.1
	 * @access	public
	 */
	public function shutdown($disable = false) {
		static $disabled = false;
		$disabled = $disable;

		if($disabled) {
			return;
		}
		
		$error = error_get_last();

		if($error) {
			switch($error['type']) {
				case 1 :
					$this->error('PHP Fatal Error (E_ERROR)', $error['message'] . ' on line ' . $error['line']);
					break;
				case 4 :
					$this->error('PHP Parse Error (E_PARSE)', $error['message'] . ' on line ' . $error['line']);
					break;
				default :
					return false;
			}

			echo $this->show_errors();
			ob_end_clean();
			
			//Javascript to move the notice underneath the title in case the worpress JS hasn't loaded
			echo '<script type="text/javascript">jQuery("div.error").not(".below-h2, .inline").insertAfter(jQuery("div.wrap h2:first"));</script>';
		}
	}

	/**
	 * Used to setup the meta box content template
	 *
	 * @since	1.0
	 * @access	private
	 * @see		_init()
	 */
	public function _setup() {
		$this->in_template = TRUE;
		
		// also make current post data available
		global $post;

		// shortcuts
		$mb =& $this;
		$metabox =& $this;
		$id = $this->id;
		$meta = $this->_meta(NULL, TRUE);

		//Allow catching of PHP errors in templates
		set_error_handler(array($this, 'handle_php_error'), E_ALL);
		register_shutdown_function(array($this, 'shutdown'));

		//Include the metabox template 
		//Buffering so that if errors are encountered the metabox won't be shown
		ob_start();

		include $this->template;
		$html = ob_get_clean();
		$errors = $this->show_errors();

		//Remove error handlers
		restore_error_handler();
		$this->shutdown(true);
		
		//Don't show the metabox if it contains errors
		if($errors) {
			echo $errors;
		} else {
			echo $html;
			echo '<input type="hidden" name="'. $this->id .'_nonce" value="' . wp_create_nonce($this->id) . '" />';
		}
	 
		$this->in_template = FALSE;
	}

	/**
	 * Used to properly prefix the filter tag, the tag is unique to the meta
	 * box instance
	 * 
	 * @since	1.3
	 * @access	private
	 * @param	string $tag name of the filter
	 * @return	string uniquely prefixed tag name
	 */
	private function _get_filter_tag($tag) {
		$prefix = 'wpalchemy_filter_' . $this->id . '_';
		$prefix = preg_replace('/_+/', '_', $prefix);

		$tag = preg_replace('/^'. $prefix .'/i', '', $tag);
		return $prefix . $tag;
	}

	/**
	 * Uses WordPress add_filter() function, see WordPress add_filter()
	 *
	 * @since	1.3
	 * @access	public
	 * @link	http://core.trac.wordpress.org/browser/trunk/wp-includes/plugin.php#L65
	 */
	public function add_filter($tag, $function_to_add, $priority = 10, $accepted_args = 1) {
		$tag = $this->_get_filter_tag($tag);;
		add_filter($tag, $function_to_add, $priority, $accepted_args);
	}

	/**
	 * Uses WordPress has_filter() function, see WordPress has_filter()
	 *
	 * @since	1.3
	 * @access	public
	 * @link	http://core.trac.wordpress.org/browser/trunk/wp-includes/plugin.php#L86
	 */
	public function has_filter($tag, $function_to_check = FALSE) {
		$tag = $this->_get_filter_tag($tag);
		return has_filter($tag, $function_to_check);
	}

	/**
	 * Uses WordPress apply_filters() function, see WordPress apply_filters()
	 *
	 * @since	1.3
	 * @access	public
	 * @link	http://core.trac.wordpress.org/browser/trunk/wp-includes/plugin.php#L134
	 */
	public function apply_filters($tag, $value) {
		$args = func_get_args();
		$args[0] = $this->_get_filter_tag($tag);
		return call_user_func_array('apply_filters', $args);
	}

	/**
	 * Uses WordPress remove_filter() function, see WordPress remove_filter()
	 *
	 * @since	1.3
	 * @access	public
	 * @link	http://core.trac.wordpress.org/browser/trunk/wp-includes/plugin.php#L250
	 */
	public function remove_filter($tag, $function_to_remove, $priority = 10, $accepted_args = 1) {
		$tag = $this->_get_filter_tag($tag);
		return remove_filter($tag, $function_to_remove, $priority, $accepted_args);
	}

	/**
	 * Used to properly prefix the action tag, the tag is unique to the meta
	 * box instance
	 *
	 * @since	1.3
	 * @access	private
	 * @param	string $tag name of the action
	 * @return	string uniquely prefixed tag name
	 */
	private function _get_action_tag($tag) {
		$prefix = 'wpalchemy_action_' . $this->id . '_';
		$prefix = preg_replace('/_+/', '_', $prefix);

		$tag = preg_replace('/^'. $prefix .'/i', '', $tag);
		return $prefix . $tag;
	}

	/**
	 * Uses WordPress add_action() function, see WordPress add_action()
	 *
	 * @since	1.3
	 * @access	public
	 * @link	http://core.trac.wordpress.org/browser/trunk/wp-includes/plugin.php#L324
	 */
	public function add_action($tag, $function_to_add, $priority = 10, $accepted_args = 1) {
		$tag = $this->_get_action_tag($tag);
		add_action($tag, $function_to_add, $priority, $accepted_args);
	}

	/**
	 * Uses WordPress has_action() function, see WordPress has_action()
	 *
	 * @since	1.3
	 * @access	public
	 * @link	http://core.trac.wordpress.org/browser/trunk/wp-includes/plugin.php#L492
	 */
	public function has_action($tag, $function_to_check = FALSE) {
		$tag = $this->_get_action_tag($tag);
		return has_action($tag, $function_to_check);
	}

	/**
	 * Uses WordPress remove_action() function, see WordPress remove_action()
	 * 
	 * @since	1.3
	 * @access	public
	 * @link	http://core.trac.wordpress.org/browser/trunk/wp-includes/plugin.php#L513
	 */
	public function remove_action($tag, $function_to_remove, $priority = 10, $accepted_args = 1) {
		$tag = $this->_get_action_tag($tag);
		return remove_action($tag, $function_to_remove, $priority, $accepted_args);
	}

	/**
	 * Uses WordPress do_action() function, see WordPress do_action()
	 * @since	1.3
	 * @access	public
	 * @link	http://core.trac.wordpress.org/browser/trunk/wp-includes/plugin.php#L352
	 */
	public function do_action($tag, $arg = '') {
		$args = func_get_args();
		$args[0] = $this->_get_action_tag($tag);
		return call_user_func_array('do_action', $args);
	}

	/**
	 * Used to check if creating a new post or editing one
	 *
	 * @static
	 * @since	1.3.7
	 * @access	private
	 * @return	bool
	 * @see		_is_page()
	 */
	private function _is_post() {
		return self::_is_post_or_page() == 'post';
	}

	/**
	 * Used to check if creating a new page or editing one
	 *
	 * @static
	 * @since	1.3.7
	 * @access	private
	 * @return	bool
	 * @see		_is_post()
	 */
	private function _is_page() {
		return self::_is_post_or_page() == 'page';
	}

	/**
	 * Used to check if creating or editing a post or page
	 *
	 * @static
	 * @since	1.3.8
	 * @access	private
	 * @return	string "post" or "page"
	 * @see		_is_post(), _is_page()
	 */
	private function _is_post_or_page() {
		$post_type = self::_get_current_post_type();

		if (isset($post_type)) {
			return ($post_type == 'page') ? 'page' : 'post' ;
		}

		return NULL;
	}

	/**
	 * Used to check for the current post type, works when creating or editing a
	 * new post, page or custom post type.
	 *
	 * @static
	 * @since	1.4.6
	 * @return	string [custom_post_type], page or post
	 */
	private function _get_current_post_type() {
		$uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : NULL ;

		if ( isset( $uri ) ) {
			$uri_parts = parse_url($uri);

			$file = basename($uri_parts['path']);

			if ($uri AND in_array($file, array('post.php', 'post-new.php'))) {
				$post_id = WPAlchemy_MetaBox::_get_post_id();

				$post_type = isset($_GET['post_type']) ? $_GET['post_type'] : NULL ;

				$post_type = $post_id ? get_post_type($post_id) : $post_type ;

				return (isset($post_type)) ? $post_type : 'post';
			}
		}

		return NULL;
	}

	/**
	 * Used to get the current post id.
	 *
	 * @static
	 * @since	1.4.8
	 * @return	int post ID
	 */
	private function _get_post_id() {
		global $post;

		$p_post_id = isset($_POST['post_ID']) ? $_POST['post_ID'] : null ;
		$g_post_id = isset($_GET['post']) ? $_GET['post'] : null ;

		$post_id = $g_post_id ? $g_post_id : $p_post_id ;
		$post_id = isset($post->ID) ? $post->ID : $post_id ;

		if (isset($post_id)) {
			return (int) $post_id;
		}
		
		return null;
	}

	/**
	 * @since	1.0
	 */
	public function can_output() {
		$post_id = WPAlchemy_MetaBox::_get_post_id();

		if(!empty($this->exclude_template) || !empty($this->include_template)) {
			$template_file = get_post_meta($post_id,'_wp_page_template',TRUE);
		}

		if(!empty($this->exclude_category) || 
			!empty($this->exclude_category_id) || 
			!empty($this->include_category) ||
			!empty($this->include_category_id)
		) {
			$categories = wp_get_post_categories($post_id,'fields=all');
		}

		if(!empty($this->exclude_tag) || 
			!empty($this->exclude_tag_id) || 
			!empty($this->include_tag) ||
			!empty($this->include_tag_id)
		) {
			$tags = wp_get_post_tags($post_id);
		}

		// processing order: "exclude" then "include"
		// processing order: "template" then "category" then "post"

		$can_output = TRUE; // include all

		if(!empty($this->exclude_template) || 
			!empty($this->exclude_category_id) || 
			!empty($this->exclude_category) || 
			!empty($this->exclude_tag_id) ||
			!empty($this->exclude_tag) ||
			!empty($this->exclude_post_id) ||
			!empty($this->include_template) || 
			!empty($this->include_category_id) || 
			!empty($this->include_category) || 
			!empty($this->include_tag_id) || 
			!empty($this->include_tag) || 
			!empty($this->include_post_id)
		) {
			if(!empty($this->exclude_template)) {
				if(in_array($template_file,$this->exclude_template))  {
					$can_output = FALSE;
				}
			}

			if(!empty($this->exclude_category_id)) {
				foreach($categories as $cat) {
					if(in_array($cat->term_id,$this->exclude_category_id))  {
						$can_output = FALSE;
						break;
					}
				}
			}

			if(!empty($this->exclude_category)) {
				foreach($categories as $cat) {
					if(in_array($cat->slug,$this->exclude_category) ||
						in_array($cat->name,$this->exclude_category)
					) {
						$can_output = FALSE;
						break;
					}
				}
			}

			if(!empty($this->exclude_tag_id)) {
				foreach($tags as $tag) {
					if(in_array($tag->term_id,$this->exclude_tag_id))  {
						$can_output = FALSE;
						break;
					}
				}
			}

			if(!empty($this->exclude_tag)) {
				foreach($tags as $tag) {
					if(in_array($tag->slug,$this->exclude_tag) || 
						in_array($tag->name,$this->exclude_tag)
					) {
						$can_output = FALSE;
						break;
					}
				}
			}

			if(!empty($this->exclude_post_id)) {
				if(in_array($post_id,$this->exclude_post_id))  {
					$can_output = FALSE;
				}
			}

			// excludes are not set use "include only" mode

			if(empty($this->exclude_template) && 
				empty($this->exclude_category_id) && 
				empty($this->exclude_category) && 
				empty($this->exclude_tag_id) && 
				empty($this->exclude_tag) && 
				empty($this->exclude_post_id)
			) {
				$can_output = FALSE;
			}

			if(!empty($this->include_template)) {
				if(in_array($template_file,$this->include_template))  {
					$can_output = TRUE;
				}
			}

			if(!empty($this->include_category_id)) {
				foreach($categories as $cat) {
					if(in_array($cat->term_id,$this->include_category_id))  {
						$can_output = TRUE;
						break;
					}
				}
			}

			if(!empty($this->include_category)) {
				foreach($categories as $cat) {
					if(in_array($cat->slug,$this->include_category) ||
						in_array($cat->name,$this->include_category)
					) {
						$can_output = TRUE;
						break;
					}
				}
			}

			if(!empty($this->include_tag_id)) {
				foreach($tags as $tag) {
					if(in_array($tag->term_id,$this->include_tag_id))  {
						$can_output = TRUE;
						break;
					}
				}
			}

			if(!empty($this->include_tag)) {
				foreach($tags as $tag) {
					if(in_array($tag->slug,$this->include_tag) ||
						in_array($tag->name,$this->include_tag)
					) {
						$can_output = TRUE;
						break;
					}
				}
			}

			if(!empty($this->include_post_id)) {
				if(in_array($post_id,$this->include_post_id))  {
					$can_output = TRUE;
				}
			}
		}

		$post_type = WPAlchemy_MetaBox::_get_current_post_type();

		if(isset($post_type) && !in_array($post_type, $this->types)) {
			$can_output = FALSE;
		}

		// filter: output (can_output)
		if ($this->has_filter('output')) {
			$can_output = $this->apply_filters('output', $post_id);
		}

		return $can_output;
	}

	/**
	 * Used to insert global STYLE or SCRIPT tags into the head, called on
	 * WordPress admin_footer action.
	 *
	 * @static
	 * @since	1.3
	 * @access	private
	 */
	public function _global_head() {

		// must be creating or editing a post or page
		if(!WPAlchemy_MetaBox::_is_post() && !WPAlchemy_MetaBox::_is_page()) return;

		// todo: you're assuming people will want to use this exact functionality
		// consider giving a developer access to change this via hooks/callbacks

		// include javascript for special functionality
		?>

		<style type="text/css"> 
			.hide-fullscreen .mce-wp-fullscreen {
				display: none;
			}
			.wpa-group-template {
				display: none;
			}
		</style>

		<script type="text/javascript">
		/* <![CDATA[ */
		jQuery(function($) {
			Wpalchemy = window.Wpalchemy || {
				deleteItem: function($elem) {
					var target = $elem.data('target'),
					$loop = (target) ? $('#' + target) : $elem.closest('.wpa-loop');

					if(confirm('This action can not be undone, are you sure?')) {
						if(target) {
							var $groups = $loop.find('.wpa-group');

							$groups.find('textarea.wp-editor-area').each(function() {
								Wpalchemy.removeEditor($(this));
							});

							$loop.trigger('wpa:delete', {single: false, groups: $groups});
							$groups.remove();
							$loop.trigger('wpa:deleted', {single: false});
						} else {
							var $group = $elem.closest('.wpa-group');

							$group.find('textarea.wp-editor-area').each(function() {
								Wpalchemy.removeEditor($(this));
							});

							$loop.trigger('wpa:delete', {single: true, group: $group});
							$elem.closest('.wpa-group').remove();
							$loop.trigger('wpa:deleted', {single: true});
						}
						
						this.checkLoopLimit(target);
					}
				},

				moveItemUp: function($elem) {
					var $previous = $elem.prev('.wpa-group'),
					field = $elem.closest('.wpa-loop').data('field'),
					previousIndex = $previous.data('index'),
					currentIndex = $elem.data('index');

					if(!$previous) {
						return false;
					}

					this.updateAttributes($elem, field, previousIndex);
					this.updateAttributes($previous, field, currentIndex);

					$previous.before($elem);
				},

				moveItemDown: function($elem) {
					var $next = $elem.next('.wpa-group'),
					field = $elem.closest('.wpa-loop').data('field'),
					nextIndex = $next.data('index'),
					currentIndex = $elem.data('index');

					if(!$next) {
						return false;
					}

					this.updateAttributes($elem, field, nextIndex);
					this.updateAttributes($next, field, currentIndex);

					$next.after($elem);
				},

				copyItem: function($elem) {
					var target = $elem.data('target'),
					$loop = (target) ? $('#' + target) : $elem.closest('.wpa-loop'),
					field = $loop.data('field'),
					count = $loop.children('.wpa-group').length + 1,
					$group = $loop.children('.wpa-group-template'),
					$clone = $group.clone(false).removeClass('wpa-group-template');

					$loop.children('.wpa-group').removeClass('last');
					$clone.addClass('wpa-group last');

					this.updateAttributes($clone, field, count);

					$group.before($clone);

					this.checkLoopLimit(target);
					
					$clone.find('textarea.wp-editor-area').each(function() {
						Wpalchemy.initEditor($(this));
					});

					$loop.trigger('wpa:copy', {field: field, group: $clone});
				},

				checkLoopLimit: function(name) {
					var $loop = $('#' + name);
					return !($loop.children('.wpa-group').length >= $loop.data('limit'));
				},

				//Updates attributes of elements inside a wpa-group
				//Used to change the indexes etc when copying or moving a group
				updateAttributes: function($elem, field, replace) {
					var properties = ['name', 'id', 'class', 'for', 'data-target', 'data-button', 'data-input', 'data-group'],
					name_replace = new RegExp('\\[' + field + ']\\[\\d+]'),
					hyphen_replace = new RegExp('\\-' + field + '\\-\\d+\\-');
					underscore_replace = new RegExp('\\_' + field + '\\_\\d+\\_');

					$elem.find('*').each(function(i, e) {
						for (var j = 0; j < properties.length; j++) {
							var value = $(e).attr(properties[j]);
							
							if (value) {
								value = value.replace(name_replace, '[' + field + ']['+ replace + ']');
								value = value.replace(hyphen_replace, '-' + field + '-' + replace + '-');
								value = value.replace(underscore_replace, '_' + field + '_' + replace + '_');
								$(e).attr(properties[j], value);
							}
						}
					});

					$elem.attr('data-index', replace);
				},

				initEditor: function($elem) {
					//Readd quicktags
					$elem.siblings('.mce-panel').remove();

					new QTags({ id : $elem.attr('id'), buttons: 'strong,em,link,block,del,ins,img,ul,ol,li,code,more,close'});
					QTags._buttonsInit();

					switchEditors.go($elem.attr('id'), 'html');

					//Reinit tinyMCE
					//tinyMCEPreInit.mceInit.content.wpautop = false;
					tinyMCEPreInit.mceInit.content.entities = '160,nbsp,38,amp,60,lt,62,gt';
					tinyMCE.settings = tinyMCEPreInit.mceInit.content;
					
					tinyMCE.execCommand('mceAddEditor', false, $elem.attr('id'));
					tinyMCE.triggerSave();

					switchEditors.go($elem.attr('id'), 'html');
					switchEditors.go($elem.attr('id'), 'tinymce');
				},

				removeEditor: function($elem) {
					//Remove tinyMCE
					tinyMCE.triggerSave();
					tinyMCE.execCommand('mceRemoveEditor', false, $elem.attr('id'));

					//Remove quicktags
					$elem.siblings('.quicktags-toolbar').remove();
					$elem.siblings('.mce-panel').remove();
				}
			};

			Wpalchemy.<?=$this->id?> = {
				$metabox: $('#<?=$this->id?>-metabox'),

				init: function() {
					this.$metabox.on('click', '.wpa-copy', function(e) {
						e.preventDefault();
						Wpalchemy.copyItem($(this));
						return false;
					});

					this.$metabox.on('click', '.wpa-delete', function(e) {
						e.preventDefault();
						Wpalchemy.deleteItem($(this));
						return false;
					});

					this.$metabox.on('click', '.wpa-move-up', function(e) {
						e.preventDefault();
						Wpalchemy.moveItemUp($(this).closest('.wpa-group'));
						return false;
					});

					this.$metabox.on('click', '.wpa-move-down', function(e) {
						e.preventDefault();
						Wpalchemy.moveItemDown($(this).closest('.wpa-group'));
						return false;
					});

					/* do an initial limit check, show or hide buttons */
					this.$metabox.find('.wpa-copy').each(function() {
						if(Wpalchemy.checkLoopLimit($(this).data('target'))) {
							$(this).show();
						} else {
							$(this).hide();
						}
					});

					this.$metabox.find('.wpa-group-template textarea.wp-editor-area').each(function(e) {
		            	Wpalchemy.removeEditor($(this));
	   	            });
				}
			};
			Wpalchemy.<?=$this->id?>.init();

		});
		/* ]]> */
		</script>
		<?php
	}

	/**
	 * Gets the meta data for a meta box
	 *
	 * @since	1.0
	 * @access	public
	 * @param	int $post_id optional post ID for which to retrieve the meta data
	 * @return	array
	 * @see		_meta
	 */
	public function the_meta($post_id = NULL) {
		return $this->_meta($post_id);
	}

	/**
	 * Gets the meta data for a meta box
	 *
	 * Internal method calls will typically bypass the data retrieval and will
	 * immediately return the current meta data
	 *
	 * @since	1.3
	 * @access	private
	 * @param	int $post_id optional post ID for which to retrieve the meta data
	 * @param	bool $internal optional boolean if internally calling
	 * @return	array
	 * @see		the_meta()
	 */
	private function _meta($post_id = NULL, $internal = FALSE) {
		if ( ! is_numeric($post_id)) {
			if ($internal AND $this->current_post_id) {
				$post_id = $this->current_post_id;
			} else {
				global $post;

				$post_id = $post->ID;
			}
		}

		// this allows multiple internal calls to _meta() without having to fetch data everytime
		if ($internal AND !empty($this->meta) AND $this->current_post_id == $post_id) return $this->meta;

		$this->current_post_id = $post_id;

		// WPALCHEMY_MODE_ARRAY

		$meta = get_post_meta($post_id, $this->id, TRUE);
		// WPALCHEMY_MODE_EXTRACT

		$fields = get_post_meta($post_id, $this->id . '_fields', TRUE);

		if ( ! empty($fields) AND is_array($fields)) {
			$meta = array();
			
			foreach ($fields as $field) {
				$field_noprefix = preg_replace('/^' . $this->prefix . '/i', '', $field);
				$meta[$field_noprefix] = get_post_meta($post_id, $field, TRUE);
			}
		}

		$this->meta = $meta;

		return $this->meta;
	}

	/**
	 * @since	1.0
	 * @access	public
	 */
	public function the_id() {
		echo $this->get_the_id();
	}

	/**
	 * @since	1.0
	 * @access	public
	 */
	public function get_the_id() {
		return $this->id;
	}

	/**
	 * @since	1.0
	 * @access	public
	 */
	public function the_field($n, $hint = NULL) {
		if ($this->loops) $this->name = $n;
		else $this->name = $n;

		$this->hint = $hint;
	}

	/**
	 * @since	1.0
	 * @access	public
	 */
	public function have_value($n = NULL) {
		return !!$this->get_the_value($n);
	}

	/**
	 * @since	1.0
	 * @access	public
	 */
	public function the_value($n = NULL) {
		echo $this->get_the_value($n);
	}

	/**
	 * @since	1.0
	 * @access	public
	 */
	public function get_the_value($n = NULL, $collection = FALSE) {
		$this->_meta(NULL, TRUE);
		$n = is_null($n) ? $this->name : $n ;
		$value = null;

		if ($this->loops) {
			$value = $this->meta;

			foreach($this->loops as $name => $loop) {
				if($name !== $n) {
					if(empty($value[$name]) || empty($value[$name][$loop->current])) {
						return false;
					}
					$value = $value[$name][$loop->current];
				} else {
					if(empty($value[$name])) {
						return false;
					}

					$value = $value[$name];
				}
			}

			if (!$collection) {
				if(isset($value[$n])) {
					if(is_array($value)) {
						$value = $value[$n];
					}
				} else {
					return false;
				}
			}
		} else {
			$n = is_null($n) ? $this->name : $n ;

			if(isset($this->meta[$n])) {
				$value = $this->meta[$n];
			}
		}

		if (is_string($value) || is_numeric($value)) {
			if ($this->in_template) {
				return htmlentities($value, ENT_QUOTES, 'UTF-8');
			} else {
				// http://wordpress.org/support/topic/call-function-called-by-embed-shortcode-direct
				// http://phpdoc.wordpress.org/trunk/WordPress/Embed/WP_Embed.html#run_shortcode

				global $wp_embed;

				return do_shortcode($wp_embed->run_shortcode($value));
			}
		} else {
			// value can sometimes be an array
			return $value;
		}
	}

	/**
	 * @since	1.0
	 * @access	public
	 */
	public function the_name($n = NULL) {
		echo $this->get_the_name($n);
	}

	/**
	 * @since	1.0
	 * @access	public
	 */
	public function get_the_name($n = NULL) {
		if (!$this->in_template AND $this->mode == WPALCHEMY_MODE_EXTRACT) {
			return $this->prefix . str_replace($this->prefix, '', is_null($n) ? $this->name : $n);
		}

		if ($this->loops) {
			$n = is_null($n) ? $this->name : $n ;

			$the_field = $this->id;

			foreach($this->loops as $name => $loop) {
				$the_field .= '[' . $name . '][' . $loop->current . ']';
			}
			
			if (!is_null($n)) {
				$the_field .= '[' . $n . ']';
			}
		} else {
			$n = is_null($n) ? $this->name : $n ;

			$the_field = $this->id . '[' . $n . ']';
		}

		$hints = array(
			WPALCHEMY_FIELD_HINT_CHECKBOX_MULTI,
			WPALCHEMY_FIELD_HINT_SELECT_MULTI,
			WPALCHEMY_FIELD_HINT_SELECT_MULTIPLE,
		);

		if (in_array($this->hint, $hints)) {
			$the_field .= '[]';
		}

		return $the_field;
	}

	/**
	 * @since	1.1
	 * @access	public
	 */
	public function the_index() {
		echo $this->get_the_index();
	}

	/**
	 * @since	1.1
	 * @access	public
	 */
	public function get_the_index() {
		return $this->loops ? end($this->loops)->current : 0;
	}

	/**
	 * @since	1.0
	 * @access	public
	 */
	public function is_first() {
		return $this->loops && end($this->loops)->current == 0;
	}

	/**
	 * @since	1.0
	 * @access	public
	 */
	public function is_last() {
		return $this->loops && end($this->loops)->current + 1 == end($this->loops)->length;
	}

	/**
	 * @since	3.0
	 * @access	public
	 */
	public function is_template() {
		return $this->loops && end($this->loops)->current == end($this->loops)->length;
	}

	/**
	 * Used to check if a value is a match
	 *
	 * @since	1.1
	 * @access	public
	 * @param	string $n the field name to check or the value to check for (if the_field() is used prior)
	 * @param	string $v optional the value to check for
	 * @return	bool
	 * @see		is_value()
	 */
	public function is_value($n, $v = NULL) {
		if (is_null($v)) {
			$the_value = $this->get_the_value();

			$v = $n;
		} else {
			$the_value = $this->get_the_value($n);
		}

		return $v == $the_value;
	}

	/**
	 * Used to check if a value is selected, useful when working with checkbox,
	 * radio and select values.
	 *
	 * @since	1.3
	 * @access	public
	 * @param	string $n the field name to check or the value to check for (if the_field() is used prior)
	 * @param	string $v optional the value to check for
	 * @return	bool
	 * @see		is_value()
	 */
	public function is_selected($n, $v = NULL) {
		if (is_null($v)) {
			$the_value = $this->get_the_value(NULL);

			$v = $n;
		} else {
			$the_value = $this->get_the_value($n);
		}

		if (is_array($the_value)) {
			if (in_array($v, $the_value)) return TRUE;
		} elseif($v == $the_value) {
			return TRUE;
		}

		return FALSE;
	}

	/**
	 * Prints the current state of a checkbox field and should be used inline
	 * within the INPUT tag.
	 *
	 * @since	1.3
	 * @access	public
	 * @param	string $n the field name to check or the value to check for (if the_field() is used prior)
	 * @param	string $v optional the value to check for
	 * @see		get_the_checkbox_state()
	 */
	public function the_checkbox_state($n, $v = NULL) {
		echo $this->get_the_checkbox_state($n, $v);
	}

	/**
	 * Returns the current state of a checkbox field, the returned string is
	 * suitable to be used inline within the INPUT tag.
	 *
	 * @since	1.3
	 * @access	public
	 * @param	string $n the field name to check or the value to check for (if the_field() is used prior)
	 * @param	string $v optional the value to check for
	 * @return	string suitable to be used inline within the INPUT tag
	 * @see		the_checkbox_state()
	 */
	public function get_the_checkbox_state($n, $v = NULL) {
		if ($this->is_selected($n, $v)) return ' checked="checked"';
	}

	/**
	 * Prints the current state of a radio field and should be used inline
	 * within the INPUT tag.
	 *
	 * @since	1.3
	 * @access	public
	 * @param	string $n the field name to check or the value to check for (if the_field() is used prior)
	 * @param	string $v optional the value to check for
	 * @see		get_the_radio_state()
	 */
	public function the_radio_state($n, $v = NULL) {
		echo $this->get_the_checkbox_state($n, $v);
	}

	/**
	 * Returns the current state of a radio field, the returned string is
	 * suitable to be used inline within the INPUT tag.
	 *
	 * @since	1.3
	 * @access	public
	 * @param	string $n the field name to check or the value to check for (if the_field() is used prior)
	 * @param	string $v optional the value to check for
	 * @return	string suitable to be used inline within the INPUT tag
	 * @see		the_radio_state()
	 */
	public function get_the_radio_state($n, $v = NULL) {
		return $this->get_the_checkbox_state($n, $v);
	}

	/**
	 * Prints the current state of a select field and should be used inline
	 * within the SELECT tag.
	 *
	 * @since	1.3
	 * @access	public
	 * @param	string $n the field name to check or the value to check for (if the_field() is used prior)
	 * @param	string $v optional the value to check for
	 * @see		get_the_select_state()
	 */
	public function the_select_state($n, $v = NULL) {
		echo $this->get_the_select_state($n, $v);
	}

	/**
	 * Returns the current state of a select field, the returned string is
	 * suitable to be used inline within the SELECT tag.
	 *
	 * @since	1.3
	 * @access	public
	 * @param	string $n the field name to check or the value to check for (if the_field() is used prior)
	 * @param	string $v optional the value to check for
	 * @return	string suitable to be used inline within the SELECT tag
	 * @see		the_select_state()
	 */
	public function get_the_select_state($n, $v = NULL) {
		if ($this->is_selected($n, $v)) return ' selected="selected"';
	}


	public function the_copy_button($name = '', $label = 'Add new row', $attributes = array()) {
		echo $this->get_the_copy_button($name, $label, $attributes);
	}

	/**
	 * Returns the html for a button element that will clone the specified loop field when clicked
	 * Any parent loops are taken into account for correct cloning
	 * 
	 * @since	2.0
	 * @access	public
	 * @param	string $name the name of the field the button should clone
	 * @param	string $label the label of the button
	 * @param	array $attributes any extra attributes the button should have 
	 * @return	string containing HTML for the copy button
	 * @see		the_copy_button()
	 */
	public function get_the_copy_button($name = '', $label = 'Add new row', $attributes = array()) {
		if(!empty($attributes['class'])) {
			$attributes['class'] .= ' wpa-copy';
		} else {
			$attributes['class'] = 'wpa-copy';
		}

		return $this->get_the_button($name, $label, $attributes);
	}

	public function the_delete_button($name = '', $label = 'Delete row', $attributes = array()) {
		echo $this->get_the_delete_button($name, $label, $attributes);
	}

	/**
	 * Returns the html for a button element that will delete a single field in a loop
	 * or all the fields in a given loop.
	 * Any parent loops are taken into account for correct deletion
	 * 
	 * @since	2.0
	 * @access	public
	 * @param	string $name
	 *			If left blank the button will delete the parent loop field that contains it
	 *			If specified the button will delete all fields in the specified loop
	 * @param	string $label the label of the button
	 * @param	array $attributes any extra attributes the button should have 
	 * @return	string containing HTML for the delete button
	 * @see		the_delete_button()
	 */
	public function get_the_delete_button($name = '', $label = 'Delete row', $attributes = array()) {
		if(!empty($attributes['class'])) {
			$attributes['class'] .= ' wpa-delete';
		} else {
			$attributes['class'] = 'wpa-delete';
		}

		return $this->get_the_button($name, $label, $attributes);
	}

	public function the_move_up_button($label = 'Move up', $attributes = array()) {
		echo $this->get_the_move_up_button('', $label, $attributes);
	}


	/**
	 * Returns the html for a button element that will move the parent loop field
	 * above the previous field in the loop (if any). This changes the order in which they are saved.
	 * This button only makes sense inside a loop
	 *
	 * @since	2.2
	 * @access	public
	 * @param	string $label the label of the button
	 * @param	array $attributes any extra attributes the button should have 
	 * @return	string containing HTML for the button
	 * @see		the_move_up_button()
	 */
	public function get_the_move_up_button($label = 'Move up', $attributes = array()) {
		if(!empty($attributes['class'])) {
			$attributes['class'] .= ' wpa-move-up';
		} else {
			$attributes['class'] = 'wpa-move-up';
		}

		return $this->get_the_button('', $label, $attributes);
	}

	public function the_move_down_button($label = 'Move down', $attributes = array()) {
		echo $this->get_the_move_down_button('', $label, $attributes);
	}


	/**
	 * Returns the html for a button element that will move the parent loop field
	 * below the next field in the loop (if any). This changes the order in which they are saved.
	 * This button only makes sense inside a loop
	 *
	 * @since	2.2
	 * @access	public
	 * @param	string $label the label of the button
	 * @param	array $attributes any extra attributes the button should have 
	 * @return	string containing HTML for the button
	 * @see		the_move_down_button()
	 */
	public function get_the_move_down_button($label = 'Move down', $attributes = array()) {
		if(!empty($attributes['class'])) {
			$attributes['class'] .= ' wpa-move-down';
		} else {
			$attributes['class'] = 'wpa-move-down';
		}

		return $this->get_the_button('', $label, $attributes);
	}

	private function get_the_button($name = '', $label = 'Add new row', $attributes = array()) {
		$default_class = '';
		
		if($name) {
			$attributes['data-target'] = $this->get_the_group_id($name);
		}

		$attributes['class'] = $attributes['class'] . ' button';

		$html = '<button ';

		foreach($attributes as $attribute => $value) {
			$html .= $attribute . '="' . $value . '" ';
		}

		$html .= '>' . $label . '</button>';

		return $html;
	}

	public function the_wp_editor($content = '', $name) {
		echo $this->get_the_wp_editor($content, $name);
	}

	//- For single wp-editors add an extra boolean of true - Need write to check to see if we are in a loop
	public function get_the_wp_editor($content = '', $name = null) {
		$content = html_entity_decode($content);
		$id = str_replace('-', '_', $this->get_the_group_id($name));

		wp_editor($content, $id, array(
			'textarea_name' => $this->get_the_name()
		));
	}

	/**
	 * Returns the id of the specified field taking into 
	 * account the current indexes of any parent loops
	 * 
	 * @since	2.0
	 * @access	public
	 * @param	string $name the name of the field to append to the id
	 *			Leave blank for an id consisting of just the parent loops
	 * @param	string $prefix no longer used
	 * @return	string containing a unqiue id
	 * @see		the_group_id()
	 */
	public function get_the_group_id($name = NULL, $prefix = NULL) {
		$id = array();

		if($prefix) {
			$id[] = $prefix;
		}

		$id[] = $this->id;

		foreach($this->loops as $loop_name => $loop) {
			$id[] = $loop_name;
			$keys = array_keys($this->loops);
			if($name || $loop_name !== end($keys)) {
				$id[] = $loop->current;
			}
		}

		if($name) {
			$id[] = $name;
		}

		return implode('-', $id);
	}

	/**
	 * @since	1.1
	 * @access	public
	 */
	public function the_group_open($t = 'div') {
		echo $this->get_the_group_open($t);
	}

	/**
	 * @since	1.1
	 * @access	public
	 */
	public function get_the_group_open($t = 'div') {
		//Get calling line number for duplicate nested field detection
		$backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
		$line = $backtrace[0]['line'];

		if(!count($this->loops)) {
			return $this->error('Misplaced group open', 'get_the_group_open() called outside of a loop on line ' . $line);
		}

		$loop_name = end($this->loops)->name;
		$this->loops[$loop_name]->group_tag = $t;

		$loop = $this->loops[$loop_name];
		$html = '';

		$loop_classes = array('wpa-loop', 'wpa-loop-' . $loop->name);
		$group_classes = array('wpa-group', 'wpa-loop-' . $loop->name);

		if ($this->is_first()) {
			array_push($group_classes, 'first');

			$limit = '';

			if (isset($loop->limit)) {
				$limit = 'data-limit="' . $loop->limit . '"';
			}

			$html = '<div id="' . $this->get_the_group_id(NULL, '') . '" ' . $limit . ' class="' . implode(' ', $loop_classes) . '" data-field="' . $loop->name . '">';
		}

		if ($this->is_last()) {
			array_push($group_classes, 'last');
		}

		if ($this->is_template() && $loop->type == 'multi') {
			$group_classes[0] = 'wpa-group-template';
		}

		return $html . '<' . $t . ' class="'. implode(' ', $group_classes) . '" data-index="' . $this->get_the_index() . '">';
	}

	/**
	 * @since	1.1
	 * @access	public
	 */
	public function the_group_close() {
		echo $this->get_the_group_close();
	}

	/**
	 * @since	1.1
	 * @access	public
	 */
	public function get_the_group_close() {

		if(!count($this->loops)) {
			return $this->error('', 'No loops to close');
		}

		$loop_name = end($this->loops)->name;
		$loop = $this->loops[$loop_name];

		$html = '';
		
		if ($loop->type == 'normal' && $this->is_last()
			|| $loop->type == 'multi' && $this->is_template()) {
			$html = '</div>';
		}
		
		return '</' . $loop->group_tag . '>' . $html;
	}

	/**
	 * @since	1.1
	 * @access	public
	 */
	public function have_fields_and_multi($n, $options = 0) {
		//Get calling line number for duplicate nested field detection
		$backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
		$line = $backtrace[0]['line'];

		//Abort if a nested loop uses the same name as a parent loop
		if(!empty($this->loops[$n]) && $this->loops[$n]->line !== $line) {
			$this->error('Duplicate nested loop name', 'Loop "' . $n . '" on line ' . $line . ' has the same name as its ancestor on line ' . $this->loops[$n]->line);
			return false;
		} 

		//If the loop doesn't exist create it
		if(!count($this->loops) || end($this->loops)->name !== $n) {
			$this->loops[$n] = new stdClass;
			$this->loops[$n]->name = $n;
			$this->loops[$n]->type = 'multi';
			$this->loops[$n]->line = $line;
			$this->loops[$n]->current = -1;
		}

		//Set length and limit from options
		if (is_array($options)) {
			// use as stdClass object
			$options = (object)$options;
			$length = @$options->length;
			$this->loops[$n]->limit = @$options->limit;
		} else {
			// backward compatibility (bc)
			$length = $options;
		}

		$this->_meta(NULL, TRUE);

		//Increase length if number of existing groups exceeds length
		$cnt = $this->get_the_value($n, true);
		$cnt = count((!empty($cnt)) ? $cnt : 0);
		$length = (is_null($length) || $cnt > $length) ? $cnt : $length;

		//Add 1 to length for extra template group
		$this->loops[$n]->length = $length;

		return $this->loop($n);
	}

	/**
	 * @since	1.0
	 * @access	public
	 */
	public function have_fields($n, $length = NULL) {
		//Get calling line number for duplicate nested field detection

		$backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
		$line = $backtrace[0]['line'];

		//Abort if a nested loop uses the same name as a parent loop
		if(!empty($this->loops[$n]) && $this->loops[$n]->line !== $line) {
			$this->error('Duplicate nested loop name', 'Loop "' . $n . '" on line ' . $line . ' has the same name as its ancestor on line ' . $this->loops[$n]->line);
			return false;
		} 

		//If the loop doesn't exist create it
		if(!count($this->loops) || end($this->loops)->name !== $n) {
			$this->loops[$n] = new stdClass;
			$this->loops[$n]->name = $n;
			$this->loops[$n]->current = -1;
			$this->loops[$n]->type = 'normal';
			$this->loops[$n]->line = $line;
			$this->loops[$n]->length = $length;
		}

		$this->_meta(NULL, TRUE);

		return $this->loop($n);
	}

	/**
	 * @since	1.0
	 * @access	private
	 */
	private function loop($n) {
		$this->loops[$n]->current++;
		$this->name = NULL;
		$this->fieldtype = NULL;

		if ($this->loops[$n]->current <= $this->loops[$n]->length) {
			return TRUE;
		} else if ($this->loops[$n]->current > $this->loops[$n]->length) {
			array_pop($this->loops);
		}

		return FALSE;
	}

	/**
	 * @since	1.0
	 * @access	private
	 */
	public function _save($post_id) {
		/**
		 * note: the "save_post" action fires for saving revisions and post/pages, 
		 * when saving a post this function fires twice, once for a revision save, 
		 * and again for the post/page save ... the $post_id is different for the
		 * revision save, this means that "get_post_meta()" will not work if trying
		 * to get values for a revision (as it has no post meta data)
		 * see http://alexking.org/blog/2008/09/06/wordpress-26x-duplicate-custom-field-issue
		 *
		 * why let the code run twice? wordpress does not currently save post meta
		 * data per revisions (I think it should, so users can do a complete revert),
		 * so in the case that this functionality changes, let it run twice
		 */

		$real_post_id = isset($_POST['post_ID']) ? $_POST['post_ID'] : NULL ;
		
		// check autosave
		if (defined('DOING_AUTOSAVE') AND DOING_AUTOSAVE AND !$this->autosave) return $post_id;
	 
		// make sure data came from our meta box, verify nonce
		$nonce = isset($_POST[$this->id.'_nonce']) ? $_POST[$this->id.'_nonce'] : NULL ;
		if (!wp_verify_nonce($nonce, $this->id)) return $post_id;
	 
		// check user permissions
		if ($_POST['post_type'] == 'page') {
			if(!current_user_can('edit_page', $post_id)) return $post_id;
		} else {
			if(!current_user_can('edit_post', $post_id)) return $post_id;
		}
	 
		// authentication passed, save data
	 
		$new_data = isset( $_POST[$this->id] ) ? $_POST[$this->id] : NULL ;
	 
		WPAlchemy_MetaBox::clean($new_data);

		if (empty($new_data)) {
			$new_data = NULL;
		}


		// filter: save
		if ($this->has_filter('save')) {
			$new_data = $this->apply_filters('save', $new_data, $real_post_id);

			/**
			 * halt saving
			 * @since 1.3.4
			 */
			if (FALSE === $new_data) return $post_id;

			WPAlchemy_MetaBox::clean($new_data);
		}

		
		// get current fields, use $real_post_id (checked for in both modes)
		$current_fields = get_post_meta($real_post_id, $this->id . '_fields', TRUE);


		if ($this->mode == WPALCHEMY_MODE_EXTRACT) {
			$new_fields = array();

			if (is_array($new_data)) {
				foreach ($new_data as $k => $v) {
					$field = $this->prefix . $k;
					
					array_push($new_fields,$field);

					$new_value = $new_data[$k];

					if (is_null($new_value)) {
						delete_post_meta($post_id, $field);
					} else {
						update_post_meta($post_id, $field, $new_value);
					}
				}
			}

			$diff_fields = array_diff((array)$current_fields,$new_fields);

			if (is_array($diff_fields)) {
				foreach ($diff_fields as $field) {
					delete_post_meta($post_id,$field);
				}
			}

			delete_post_meta($post_id, $this->id . '_fields');

			if ( ! empty($new_fields)) {
				add_post_meta($post_id,$this->id . '_fields', $new_fields, TRUE);
			}

			// keep data tidy, delete values if previously using WPALCHEMY_MODE_ARRAY
			delete_post_meta($post_id, $this->id);
		} else {
			if (is_null($new_data)) {
				delete_post_meta($post_id, $this->id);
			} else {
				update_post_meta($post_id, $this->id, $new_data);
			}

			// keep data tidy, delete values if previously using WPALCHEMY_MODE_EXTRACT
			if (is_array($current_fields)) {
				foreach ($current_fields as $field) {
					delete_post_meta($post_id, $field);
				}

				delete_post_meta($post_id, $this->id . '_fields');
			}
		}

		// action: save
		if ($this->has_action('save')) {
			$this->do_action('save', $new_data, $real_post_id);
		}

		return $post_id;
	}

	/**
	 * Cleans an array, removing blank ('') values
	 *
	 * @static
	 * @since	1.0
	 * @access	public
	 * @param	array the array to clean (passed by reference)
	 */
	public function clean(&$arr) {
		if (is_array($arr)) {
			foreach ($arr as $i => $v) {
				if (is_array($arr[$i])) {
					self::clean($arr[$i]);
	 
					if (!count($arr[$i])) {
						unset($arr[$i]);
					}
				} else {
					if ('' == trim($arr[$i]) OR is_null($arr[$i])) {
						unset($arr[$i]);
					}
				}
			}

			if (!count($arr)) {
				$arr = array();
			} else {
				$keys = array_keys($arr);

				$is_numeric = TRUE;

				foreach ($keys as $key) {
					if (!is_numeric($key)) {
						$is_numeric = FALSE;
						break;
					}
				}

				if ($is_numeric) {
					$arr = array_values($arr);
				}
			}
		}
	}
}

/* eof */
