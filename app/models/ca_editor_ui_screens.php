<?php
/** ---------------------------------------------------------------------
 * app/models/ca_editor_ui_screens.php
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2008-2014 Whirl-i-Gig
 *
 * For more information visit http://www.CollectiveAccess.org
 *
 * This program is free software; you may redistribute it and/or modify it under
 * the terms of the provided license as published by Whirl-i-Gig
 *
 * CollectiveAccess is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTIES whatsoever, including any implied warranty of 
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
 *
 * This source code is free and modifiable under the terms of 
 * GNU General Public License. (http://www.gnu.org/copyleft/gpl.html). See
 * the "license.txt" file for details, or visit the CollectiveAccess web site at
 * http://www.CollectiveAccess.org
 * 
 * @package CollectiveAccess
 * @subpackage models
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License version 3
 * 
 * ----------------------------------------------------------------------
 */
 
 /**
   *
   */

require_once(__CA_LIB_DIR__.'/ca/BundlableLabelableBaseModelWithAttributes.php');
require_once(__CA_MODELS_DIR__.'/ca_editor_uis.php');
require_once(__CA_MODELS_DIR__.'/ca_editor_ui_bundle_placements.php');
require_once(__CA_MODELS_DIR__.'/ca_editor_ui_screen_type_restrictions.php');


BaseModel::$s_ca_models_definitions['ca_editor_ui_screens'] = array(
 	'NAME_SINGULAR' 	=> _t('editor UI screen'),
 	'NAME_PLURAL' 		=> _t('editor UI screens'),
 	'FIELDS' 			=> array(
 		'screen_id' => array(
				'FIELD_TYPE' => FT_NUMBER, 'DISPLAY_TYPE' => DT_HIDDEN, 
				'IDENTITY' => true, 'DISPLAY_WIDTH' => 10, 'DISPLAY_HEIGHT' => 1,
				'IS_NULL' => false, 
				'DEFAULT' => '',
				'LABEL' => _t('CollectiveAccess id'), 'DESCRIPTION' => _t('Unique numeric identifier used by CollectiveAccess internally to identify this user interface screen')
		),
		'parent_id' => array(
				'FIELD_TYPE' => FT_NUMBER, 'DISPLAY_TYPE' => DT_OMIT,
				'DISPLAY_WIDTH' => 10, 'DISPLAY_HEIGHT' => 1,
				'IS_NULL' => true, 
				'DEFAULT' => '',
				'LABEL' => 'Parent id', 'DESCRIPTION' => 'Parent id'
		),
		'ui_id' => array(
				'FIELD_TYPE' => FT_NUMBER, 'DISPLAY_TYPE' => DT_OMIT,
				'DISPLAY_WIDTH' => 10, 'DISPLAY_HEIGHT' => 1,
				'IS_NULL' => false, 
				'DEFAULT' => '',
				'LABEL' => 'Ui id', 'DESCRIPTION' => 'Identifier for Ui'
		),
		'idno' => array(
				'FIELD_TYPE' => FT_TEXT, 'DISPLAY_TYPE' => DT_FIELD, 
				'DISPLAY_WIDTH' => 70, 'DISPLAY_HEIGHT' => 1,
				'IS_NULL' => false, 
				'DEFAULT' => '',
				'LABEL' => _t('Screen identifier'), 'DESCRIPTION' => _t('Unique alphanumeric identifier for this screen'),
				'BOUNDS_LENGTH' => array(0,255),
				'UNIQUE_WITHIN' => array('ui_id')
		),
		'rank' => array(
				'FIELD_TYPE' => FT_NUMBER, 'DISPLAY_TYPE' => DT_OMIT,
				'DISPLAY_WIDTH' => 10, 'DISPLAY_HEIGHT' => 1,
				'IS_NULL' => false, 
				'DEFAULT' => '',
				'LABEL' => _t('Sort order'), 'DESCRIPTION' => _t('Sort order'),
				'BOUNDS_VALUE' => array(0,65535)
		),
		'is_default' => array(
				'FIELD_TYPE' => FT_BIT, 'DISPLAY_TYPE' => DT_SELECT, 
				'DISPLAY_WIDTH' => 10, 'DISPLAY_HEIGHT' => 1,
				'IS_NULL' => false, 
				'DEFAULT' => '',
				'LABEL' => _t('Is default screen?'), 'DESCRIPTION' => _t('Indicates if this screen should be used as the default screen when creating a new item.')
		),
		'color' => array(
				'FIELD_TYPE' => FT_TEXT, 'DISPLAY_TYPE' => DT_COLORPICKER, 
				'DISPLAY_WIDTH' => 10, 'DISPLAY_HEIGHT' => 1,
				'IS_NULL' => false, 
				'DEFAULT' => '',
				'LABEL' => _t('Color'), 'DESCRIPTION' => _t('Color to identify the screen with')
		),
		'icon' => array(
				'FIELD_TYPE' => FT_MEDIA, 'DISPLAY_TYPE' => DT_FIELD, 
				'DISPLAY_WIDTH' => 10, 'DISPLAY_HEIGHT' => 1,
				'IS_NULL' => false, 
				'DEFAULT' => '',
				"MEDIA_PROCESSING_SETTING" => 'ca_icons',
				'LABEL' => _t('Icon'), 'DESCRIPTION' => _t('Optional icon identify the screen with')
		),
		'hier_left' => array(
				'FIELD_TYPE' => FT_NUMBER, 'DISPLAY_TYPE' => DT_OMIT,
				'DISPLAY_WIDTH' => 10, 'DISPLAY_HEIGHT' => 1,
				'IS_NULL' => false, 
				'DEFAULT' => '',
				'LABEL' => 'Hierarchical index - left bound', 'DESCRIPTION' => 'Left-side boundary for nested set-style hierarchical indexing; used to accelerate search and retrieval of hierarchical record sets.'
		),
		'hier_right' => array(
				'FIELD_TYPE' => FT_NUMBER, 'DISPLAY_TYPE' => DT_OMIT,
				'DISPLAY_WIDTH' => 10, 'DISPLAY_HEIGHT' => 1,
				'IS_NULL' => false, 
				'DEFAULT' => '',
				'LABEL' => 'Hierarchical index - right bound', 'DESCRIPTION' => 'Right-side boundary for nested set-style hierarchical indexing; used to accelerate search and retrieval of hierarchical record sets.'
		)
 	)
);

class ca_editor_ui_screens extends BundlableLabelableBaseModelWithAttributes {
	# ---------------------------------
	# --- Object attribute properties
	# ---------------------------------
	# Describe structure of content object's properties - eg. database fields and their
	# associated types, what modes are supported, et al.
	#

	# ------------------------------------------------------
	# --- Basic object parameters
	# ------------------------------------------------------
	# what table does this class represent?
	protected $TABLE = 'ca_editor_ui_screens';
	      
	# what is the primary key of the table?
	protected $PRIMARY_KEY = 'screen_id';

	# ------------------------------------------------------
	# --- Properties used by standard editing scripts
	# 
	# These class properties allow generic scripts to properly display
	# records from the table represented by this class
	#
	# ------------------------------------------------------

	# Array of fields to display in a listing of records from this table
	protected $LIST_FIELDS = array('ui_id');

	# When the list of "list fields" above contains more than one field,
	# the LIST_DELIMITER text is displayed between fields as a delimiter.
	# This is typically a comma or space, but can be any string you like
	protected $LIST_DELIMITER = ' ';

	# What you'd call a single record from this table (eg. a "person")
	protected $NAME_SINGULAR;

	# What you'd call more than one record from this table (eg. "people")
	protected $NAME_PLURAL;

	# List of fields to sort listing of records by; you can use 
	# SQL 'ASC' and 'DESC' here if you like.
	protected $ORDER_BY = array('screen_id');

	# If you want to order records arbitrarily, add a numeric field to the table and place
	# its name here. The generic list scripts can then use it to order table records.
	protected $RANK = 'rank';
	
	# ------------------------------------------------------
	# Hierarchical table properties
	# ------------------------------------------------------
	protected $HIERARCHY_TYPE				=	__CA_HIER_TYPE_MULTI_MONO__;
	protected $HIERARCHY_LEFT_INDEX_FLD 	= 	'hier_left';
	protected $HIERARCHY_RIGHT_INDEX_FLD 	= 	'hier_right';
	protected $HIERARCHY_PARENT_ID_FLD		=	'parent_id';
	protected $HIERARCHY_DEFINITION_TABLE	=	'ca_editor_uis';
	protected $HIERARCHY_ID_FLD				=	'ui_id';
	protected $HIERARCHY_POLY_TABLE			=	null;
	
	# ------------------------------------------------------
	# Change logging
	# ------------------------------------------------------
	protected $UNIT_ID_FIELD = null;
	protected $LOG_CHANGES_TO_SELF = true;
	protected $LOG_CHANGES_USING_AS_SUBJECT = array(
		"FOREIGN_KEYS" => array(
		
		),
		"RELATED_TABLES" => array(
			
		)
	);
	# ------------------------------------------------------
	# Labeling
	# ------------------------------------------------------
	protected $LABEL_TABLE_NAME = 'ca_editor_ui_screen_labels';
	
	# ------------------------------------------------------
	# $FIELDS contains information about each field in the table. The order in which the fields
	# are listed here is the order in which they will be returned using getFields()

	protected $FIELDS;
	
	
	static $s_placement_list_cache;		// cache for getPlacements()
	static $s_table_num_cache;			// cache for getTableNum()
	
	# ----------------------------------------
	public function __construct($pn_id=null) {
		parent::__construct($pn_id);
	}
	# ------------------------------------------------------
	protected function initLabelDefinitions($pa_options=null) {
		parent::initLabelDefinitions($pa_options);
		
		$this->BUNDLES['ca_editor_ui_bundle_placements'] = array('type' => 'special', 'repeating' => false, 'label' => _t('Screen content'));
		$this->BUNDLES['ca_editor_ui_screen_type_restrictions'] = array('type' => 'special', 'repeating' => false, 'label' => _t('Type restrictions'));
	}
	# ------------------------------------------------------
	# Display settings
	# ------------------------------------------------------
	/**
	 * Add bundle placement to currently loaded display
	 *
	 * @param string $ps_bundle_name Name of bundle to add (eg. ca_objects.idno, ca_objects.preferred_labels.name)
	 * @param array $pa_settings Placement settings array; keys should be valid setting names
	 * @param int $pn_rank Optional value that determines sort order of bundles in the display. If omitted, placement is added to the end of the display.
	 * @param array $pa_options Optional array of options. Supports the following options:
	 * 		user_id = if specified then add will fail if specified user does not have edit access for the display
	 * @return int Returns placement_id of newly created placement on success, false on error
	 */
	public function addPlacement($ps_bundle_name, $ps_placement_code, $pa_settings, $pn_rank=null, $pa_options=null) {
		if (!($vn_screen_id = $this->getPrimaryKey())) { return null; }
		$pn_user_id = isset($pa_options['user_id']) ? $pa_options['user_id'] : null;
		//if ($pn_user_id && !$this->haveAccessToDisplay($pn_user_id, __CA_BUNDLE_DISPLAY_EDIT_ACCESS__)) {
		//	return null;
		//}
		
		unset(ca_editor_ui_screens::$s_placement_list_cache[$vn_screen_id]);
		
		
		$t_placement = new ca_editor_ui_bundle_placements(null, is_array($pa_options['additional_settings']) ? $pa_options['additional_settings'] : null);
		$t_placement->setMode(ACCESS_WRITE);
		$t_placement->set('screen_id', $vn_screen_id);
		$t_placement->set('bundle_name', $ps_bundle_name);
		$t_placement->set('placement_code', $ps_placement_code);
		$t_placement->set('rank', $pn_rank);
		
		if (is_array($pa_settings)) {
			foreach($pa_settings as $vs_key => $vs_value) {
				$t_placement->setSetting($vs_key, $vs_value);
			}
		}
		
		$t_placement->insert();
		
		if ($t_placement->numErrors()) {
			$this->errors = array_merge($this->errors, $t_placement->errors);
			return false;
		}
		return $t_placement->getPrimaryKey();
	}
	# ------------------------------------------------------
	/**
	 * Removes bundle placement from display
	 *
	 * @param int $pn_placement_id Placement_id of placement to remove
	 * @param array $pa_options Optional array of options. Supports the following options:
	 * 		user_id = if specified then remove will fail if specified user does not have edit access for the display
	 * @return bool Returns true on success, false on error
	 */
	public function removePlacement($pn_placement_id, $pa_options=null) {
		if (!($vn_screen_id = $this->getPrimaryKey())) { return null; }
		$pn_user_id = isset($pa_options['user_id']) ? $pa_options['user_id'] : null;
		//if ($pn_user_id && !$this->haveAccessToDisplay($pn_user_id, __CA_BUNDLE_DISPLAY_EDIT_ACCESS__)) {
		//	return null;
		//}
		
		$t_placement = new ca_editor_ui_bundle_placements($pn_placement_id);
		if ($t_placement->getPrimaryKey() && ($t_placement->get('screen_id') == $vn_screen_id)) {
			$t_placement->setMode(ACCESS_WRITE);
			$t_placement->delete(true);
			
			if ($t_placement->numErrors()) {
				$this->errors = array_merge($this->errors, $t_placement->errors);
				return false;
			}
			
			unset(ca_editor_ui_screens::$s_placement_list_cache[$vn_screen_id]);
			return true;
		}
		return false;
	}
	# ------------------------------------------------------
	/**
	 * Returns list of placements for the currently loaded screen.
	 *
	 * @param array $pa_options Optional array of options. Supports the following options:
	 * 		noCache = if set to true then the returned list if always generated directly from the database, otherwise it is returned from the cache if possible. Set this to true if you expect the cache may be stale. Default is false.
	 *		returnAllAvailableIfEmpty = if set to true then the list of all available bundles will be returned if the currently loaded screen has no placements, or if there is no display loaded
	 *		table = if using the returnAllAvailableIfEmpty option and you expect a list of available bundles to be returned if no display is loaded, you must specify the table the bundles are intended for use with with this option. Either the table name or number may be used.
	 *		user_id = if specified then placements are only returned if the user has at least read access to the display
	 * @return array List of placements in display order. Array is keyed on bundle name. Values are arrays with the following keys:
	 *		placement_id = primary key of ca_editor_ui_bundle_placements row - a unique id for the placement
	 *		bundle_name = bundle name (a code - not for display)
	 *		settings = array of placement settings. Keys are setting names.
	 *		display = display string for bundle
	 */
	public function getPlacements($pa_options=null) {
		$pb_no_cache = (isset($pa_options['noCache'])) ? (bool)$pa_options['noCache'] : false;
		$pb_settings_only = (isset($pa_options['settingsOnly'])) ? (bool)$pa_options['settingsOnly'] : false;
		$pb_return_all_available_if_empty = (isset($pa_options['returnAllAvailableIfEmpty']) && !$pb_settings_only) ? (bool)$pa_options['returnAllAvailableIfEmpty'] : false;
		$ps_table = (isset($pa_options['table'])) ? $pa_options['table'] : $this->getTableNum();
		$pn_user_id = isset($pa_options['user_id']) ? $pa_options['user_id'] : null;
		
		//if ($pn_user_id && !$this->haveAccessToDisplay($pn_user_id, __CA_BUNDLE_DISPLAY_READ_ACCESS__)) {
		//	return array();
		//}
		
		if (!($vn_screen_id = $this->getPrimaryKey())) {
			if ($pb_return_all_available_if_empty && $ps_table) {
				return ca_editor_ui_screens::$s_placement_list_cache[$vn_screen_id] = $this->getAvailableBundles($ps_table);
			}
		//	return array(); 
		}
		
		if (!$pb_no_cache && isset(ca_editor_ui_screens::$s_placement_list_cache[$vn_screen_id]) && ca_editor_ui_screens::$s_placement_list_cache[$vn_screen_id]) {
			return ca_editor_ui_screens::$s_placement_list_cache[$vn_screen_id];
		}
		
		$o_db = $this->getDb();
		
		$qr_res = $o_db->query("
			SELECT placement_id, bundle_name, placement_code, settings
			FROM ca_editor_ui_bundle_placements
			WHERE
				screen_id = ?
			ORDER BY rank
		", (int)$vn_screen_id);
		
		$va_available_bundles = ($pb_settings_only) ? array() : $this->getAvailableBundles();
		$va_placements = array();
	
		if ($qr_res->numRows() > 0) {
			$t_placement = new ca_editor_ui_bundle_placements();
			while($qr_res->nextRow()) {
				$vs_bundle_name = $qr_res->get('bundle_name');
				
				$va_placements[$vn_placement_id = (int)$qr_res->get('placement_id')] = $qr_res->getRow();
				$va_placements[$vn_placement_id]['settings'] = $va_settings = caUnserializeForDatabase($qr_res->get('settings'));
				if (!$pb_settings_only) {
					$t_placement->setSettingDefinitionsForPlacement($va_available_bundles[$vs_bundle_name]['settings']);
					$va_placements[$vn_placement_id]['display'] = $va_available_bundles[$vs_bundle_name]['display'];
					$va_placements[$vn_placement_id]['settingsForm'] = $t_placement->getHTMLSettingForm(array('id' => $vs_bundle_name.'_'.$vn_placement_id, 'settings' => $va_settings));
				} else {
					$va_tmp = explode('.', $vs_bundle_name);
					$t_instance = $this->_DATAMODEL->getInstanceByTableName($va_tmp[0], true);
					$va_placements[$vn_placement_id]['display'] = ($t_instance ? $t_instance->getDisplayLabel($vs_bundle_name) : "???");
				}
			}
		} else {
			if ($pb_return_all_available_if_empty) {
				$va_placements = $this->getAvailableBundles($this->getTableNum());
			}
		}
		ca_editor_ui_screens::$s_placement_list_cache[$vn_screen_id] = $va_placements;
		return $va_placements;
	}
	# ------------------------------------------------------
	# Support methods for display setup UI
	# ------------------------------------------------------
	/**
	 * Returns all available bundle display placements - those data bundles that can be displayed for the given content type, in other words.
	 * The returned value is a list of arrays; each array contains a 'bundle' specifier than can be passed got Model::get() or SearchResult::get() and a display name
	 *
	 * @param mixed $pm_table_name_or_num The table name or number specifying the content type to fetch bundles for. If omitted the content table of the currently loaded display will be used.
	 * @param array $pa_options Supported options are:
	 *		dontCache = disable caching when fetching model properties
	 * @return array And array of bundles keyed on display label. Each value is an array with these keys:
	 *		bundle = The bundle name (eg. ca_objects.idno)
	 *		display = Display label for each available bundle
	 *		description = Description of bundle
	 * 
	 * Will return null if table name or number is invalid.
	 */
	public function getAvailableBundles($pm_table_name_or_num=null, $pa_options=null) {
		$pb_dont_cache = caGetOption('dontCache', $pa_options, false);
		if (!$pm_table_name_or_num) { $pm_table_name_or_num = $this->getTableNum(); }
		
		if (!is_numeric($pm_table_name_or_num)) { $pm_table_name_or_num = $this->_DATAMODEL->getTableNum($pm_table_name_or_num); }
		if (!($t_instance = $this->_DATAMODEL->getInstanceByTableNum($pm_table_name_or_num, false))) { return null; }
		$vs_table = $t_instance->tableName();

		// if cache is disabled, make sure bundle definitions are up-to-date for this instance. they are usually cached.
		if($pb_dont_cache) { $t_instance->reloadLabelDefinitions(); }

		$vs_table_display_name = $t_instance->getProperty('NAME_PLURAL');
		
		$t_placement = new ca_editor_ui_bundle_placements(null, array());
		$va_defined_bundles = $t_instance->getBundleList(array('includeBundleInfo' => true));		// these are the bundles defined for this type of editor
		
		$va_available_bundles = array();
		
		$va_elements = ca_metadata_elements::getElementsAsList(true, $pm_table_name_or_num, null, !$pb_dont_cache, false, true);
		foreach($va_defined_bundles as $vs_bundle => $va_info) {
			$vs_bundle_proc = preg_replace('!^ca_attribute_!', '', $vs_bundle);
			$va_additional_settings = array();
			switch ($va_info['type']) {
				case 'intrinsic':
					$va_field_info = $t_instance->getFieldInfo($vs_bundle);
					if (isset($va_field_info['DONT_ALLOW_IN_UI']) && $va_field_info['DONT_ALLOW_IN_UI']) { continue(2); }
					if (is_subclass_of($t_instance, 'BaseRelationshipModel')) {
						if (isset($va_field_info['IDENTITY']) && $va_field_info['IDENTITY']) { continue(2); }
						if ($t_instance->getTypeFieldName() == $vs_bundle) { continue(2); }
						if ($t_instance->getLeftTableFieldName() == $vs_bundle) { continue(2); }
						if ($t_instance->getRightTableFieldName() == $vs_bundle) { continue(2); }
					}
					$va_additional_settings = array(
						'documentation_url' => array(
							'formatType' => FT_TEXT,
							'displayType' => DT_FIELD,
							'default' => '',
							'width' => "275px", 'height' => 1,
							'label' => _t('Documentation URL'),
							'description' => _t('URL pointing to documentation for this field. Leave blank if no documentation URL exists.')
						)
					);
					break;
				case 'preferred_label':
				case 'nonpreferred_label':
					$va_additional_settings = array(
						'usewysiwygeditor' => array(
							'formatType' => FT_NUMBER,
							'displayType' => DT_SELECT,
							'options' => array(
								_t('yes') => 1,
								_t('no') => 0
							),
							'default' => '',
							'width' => "100px", 'height' => 1,
							'label' => _t('Use rich text editor'),
							'description' => _t('Check this option if you want to use a word-processor like editor with this text field. If you expect users to enter rich text (italic, bold, underline) then you might want to enable this.')
						),
						'documentation_url' => array(
							'formatType' => FT_TEXT,
							'displayType' => DT_FIELD,
							'default' => '',
							'width' => "275px", 'height' => 1,
							'label' => _t('Documentation URL'),
							'description' => _t('URL pointing to documentation for this field. Leave blank if no documentation URL exists.')
						)
					);
					break;
				case 'attribute':
					$va_additional_settings = array(
						'sort' => array(
							'formatType' => FT_TEXT,
							'displayType' => DT_SELECT,
							'width' => "200px", 'height' => "1",
							'takesLocale' => false,
							'default' => '1',
							'label' => _t('Sort using'),
							'showSortableElementsFor' => $va_elements[preg_replace('!ca_attribute_!', '', $vs_bundle)]['element_id'],
							'description' => _t('Method used to sort repeating values.')
						),
						'sortDirection' => array(
							'formatType' => FT_TEXT,
							'displayType' => DT_SELECT,
							'width' => "200px", 'height' => "1",
							'takesLocale' => false,
							'default' => 'ASC',
							'options' => array(
								_t('Ascending') => 'ASC',
								_t('Descending') => 'DESC'
							),
							'label' => _t('Sort direction'),
							'description' => _t('Direction of sort.')
						),
						'documentation_url' => array(
							'formatType' => FT_TEXT,
							'displayType' => DT_FIELD,
							'default' => '',
							'width' => "275px", 'height' => 1,
							'label' => _t('Documentation URL'),
							'description' => _t('URL pointing to documentation for this field. Leave blank if you wish to use the default URL for this metadata element.')
						)
					);
					if ($va_elements[preg_replace('!ca_attribute_!', '', $vs_bundle)]['datatype'] == 1) {		// 1=text
						$va_additional_settings['usewysiwygeditor'] = array(
							'formatType' => FT_TEXT,
							'displayType' => DT_SELECT,
							'options' => array(
								_t('yes') => 1,
								_t('no') => 0,
								_t('use default') => null
							),
							'default' => '',
							'width' => "100px", 'height' => 1,
							'label' => _t('Use rich text editor'),
							'description' => _t('Check this option if you want to use a word-processor like editor with this text field. If you expect users to enter rich text (italic, bold, underline) then you might want to enable this.')
						);
					}
					break;
				case 'related_table':
					if (!($t_rel = $this->_DATAMODEL->getInstanceByTableName($vs_bundle, true))) { continue; }
					$va_path = array_keys($this->_DATAMODEL->getPath($t_instance->tableName(), $vs_bundle));
					$va_additional_settings = array(
						'restrict_to_relationship_types' => array(
							'formatType' => FT_TEXT,
							'displayType' => DT_SELECT,
							'useRelationshipTypeList' => $va_path[1],
							'width' => "275px", 'height' => "75px",
							'takesLocale' => false,
							'default' => '',
							'label' => _t('Restrict to relationship types'),
							'description' => _t('Restricts display to items related using the specified relationship type(s). Leave all unselected for no restriction.')
						),
						'restrict_to_types' => array(
							'formatType' => FT_TEXT,
							'displayType' => DT_SELECT,
							'useList' => $t_rel->getTypeListCode(),
							'width' => "275px", 'height' => "75px",
							'takesLocale' => false,
							'default' => '',
							'label' => _t('Restrict to types'),
							'description' => _t('Restricts display to items of the specified type(s). Leave all unselected for no restriction.')
						),
						'dont_include_subtypes_in_type_restriction' => array(
							'formatType' => FT_TEXT,
							'displayType' => DT_CHECKBOXES,
							'width' => "10", 'height' => "1",
							'takesLocale' => false,
							'default' => '0',
							'label' => _t('Do not include sub-types in type restriction'),
							'description' => _t('Normally restricting to type(s) automatically includes all sub-(child) types. If this option is checked then the lookup results will include items with the selected type(s) <b>only</b>.')
						),
						'list_format' => array(
							'formatType' => FT_TEXT,
							'displayType' => DT_SELECT,
							'options' => array(
								_t('bubbles (draggable)') => 'bubbles',
								_t('list (not draggable)') => 'list'
							),
							'default' => 'bubbles',
							'width' => "200px", 'height' => 1,
							'label' => _t('Format of relationship list'),
							'description' => _t('.')
						),
						'sort' => array(
							'formatType' => FT_TEXT,
							'displayType' => DT_SELECT,
							'width' => "200px", 'height' => "1",
							'takesLocale' => false,
							'default' => '1',
							'label' => _t('Sort using'),
							'showSortableBundlesFor' => $t_rel->tableName(),
							'description' => _t('Method used to sort related items.')
						),
						'sortDirection' => array(
							'formatType' => FT_TEXT,
							'displayType' => DT_SELECT,
							'width' => "200px", 'height' => "1",
							'takesLocale' => false,
							'default' => 'ASC',
							'options' => array(
								_t('Ascending') => 'ASC',
								_t('Descending') => 'DESC'
							),
							'label' => _t('Sort direction'),
							'description' => _t('Direction of sort, when not in a user-specified order.')
						),
						'colorFirstItem' => array(
							'formatType' => FT_TEXT,
							'displayType' => DT_COLORPICKER,
							'width' => "10", 'height' => "1",
							'takesLocale' => false,
							'default' => '',
							'label' => _t('First item color'),
							'description' => _t('If set first item in list will use this color.')
						),
						'colorLastItem' => array(
							'formatType' => FT_TEXT,
							'displayType' => DT_COLORPICKER,
							'width' => "10", 'height' => "1",
							'takesLocale' => false,
							'default' => '',
							'label' => _t('Last item color'),
							'description' => _t('If set last item in list will use this color.')
						),
						'dontShowDeleteButton' => array(
							'formatType' => FT_TEXT,
							'displayType' => DT_CHECKBOXES,
							'width' => "10", 'height' => "1",
							'takesLocale' => false,
							'default' => '0',
							'label' => _t('Do not show delete button'),
							'description' => _t('If checked the delete relationship control will not be provided.')
						),
						'display_template' => array(
							'formatType' => FT_TEXT,
							'displayType' => DT_FIELD,
							'default' => '^'.$t_rel->tableName().'.preferred_labels',
							'width' => "275px", 'height' => 4,
							'label' => _t('Relationship display template'),
							'description' => _t('Layout for relationship when displayed in list (can include HTML). Element code tags prefixed with the ^ character can be used to represent the value in the template. For example: <i>^my_element_code</i>.')
						),
						'documentation_url' => array(
							'formatType' => FT_TEXT,
							'displayType' => DT_FIELD,
							'default' => '',
							'width' => "275px", 'height' => 1,
							'label' => _t('Documentation URL'),
							'description' => _t('URL pointing to documentation for this relationship bundle. Leave blank if no documentation URL exists.')
						),
						'minRelationshipsPerRow' => array(
							'formatType' => FT_NUMBER,
							'displayType' => DT_FIELD,
							'width' => 5, 'height' => 1,
							'default' => '',
							'label' => _t('Minimum number of relationships of this kind to be associated with an item. '),
							'description' => _t('If set to 0 a delete button will allow a cataloguer to clear all relationships.  If set to 1 or more, it will not be possible to delete all relationships once the minimum is established. Note that this is only a user interface limitations rather than constraints on the underlying data model.')
						),
						'maxRelationshipsPerRow' => array(
							'formatType' => FT_NUMBER,
							'displayType' => DT_FIELD,
							'width' => 5, 'height' => 1,
							'default' => '',
							'label' => _t('Maximum number of relationships of this kind that can be associated with an item'),
							'description' => _t('The extent of repeatability for the relationship will match the number entered here. Note that this is only a user interface limitations rather than constraints on the underlying data model.')
						)
					);
					
					if ($vs_bundle == 'ca_list_items') {
						$va_additional_settings['restrict_to_lists'] = array(
							'formatType' => FT_TEXT,
							'displayType' => DT_SELECT,
							'showVocabularies' => true,
							'width' => "275px", 'height' => "125px",
							'takesLocale' => false,
							'default' => '',
							'label' => _t('Restrict to list'),
							'description' => _t('Restricts display to items from the specified list(s). Leave all unselected for no restriction.')
						);
					}
					if (in_array($vs_bundle, array('ca_places', 'ca_list_items', 'ca_storage_locations'))) {
						$va_additional_settings['useHierarchicalBrowser'] = array(
							'formatType' => FT_TEXT,
							'displayType' => DT_CHECKBOXES,
							'width' => "10", 'height' => "1",
							'takesLocale' => false,
							'default' => '1',
							'label' => _t('Use hierarchy browser?'),
							'description' => _t('If checked a hierarchical browser will be used to select related items instead of an auto-complete lookup.')
						);
						
						$va_additional_settings['hierarchicalBrowserHeight'] = array(
							'formatType' => FT_TEXT,
							'displayType' => DT_FIELD,
							'width' => "10", 'height' => "1",
							'takesLocale' => false,
							'default' => '200px',
							'label' => _t('Height of hierarchical browser'),
							'description' => _t('Height of hierarchical browser.')
						
						);
					}
					
					if (($vs_bundle == 'ca_movements') && ($t_instance->tableName() == 'ca_objects')) {
						$va_additional_settings['showCurrentOnly'] = array(
							'formatType' => FT_TEXT,
							'displayType' => DT_CHECKBOXES,
							'width' => "10", 'height' => "1",
							'takesLocale' => false,
							'default' => '1',
							'label' => _t('Show current only?'),
							'description' => _t('If checked only current movements are displayed.')
						);
					}
					
					if (($vs_bundle == 'ca_objects') && ($t_instance->tableName() == 'ca_movements')) {
						$va_additional_settings['showCurrentOnly'] = array(
							'formatType' => FT_TEXT,
							'displayType' => DT_CHECKBOXES,
							'width' => "10", 'height' => "1",
							'takesLocale' => false,
							'default' => '1',
							'label' => _t('Show current only?'),
							'description' => _t('If checked only current objects are displayed.')
						);
					}
					
					if (($vs_bundle == 'ca_movements') && ($t_instance->tableName() == 'ca_storage_locations')) {
						$va_additional_settings['showCurrentOnly'] = array(
							'formatType' => FT_TEXT,
							'displayType' => DT_CHECKBOXES,
							'width' => "10", 'height' => "1",
							'takesLocale' => false,
							'default' => '1',
							'label' => _t('Show current only?'),
							'description' => _t('If checked only current movements are displayed.')
						);
					}
					
					if (($vs_bundle == 'ca_storage_locations') && ($t_instance->tableName() == 'ca_movements')) {
						$va_additional_settings['showCurrentOnly'] = array(
							'formatType' => FT_TEXT,
							'displayType' => DT_CHECKBOXES,
							'width' => "10", 'height' => "1",
							'takesLocale' => false,
							'default' => '1',
							'label' => _t('Show current only?'),
							'description' => _t('If checked only current objects are displayed.')
						);
					}
					
					if (($vs_bundle == 'ca_storage_locations') && ($t_instance->tableName() == 'ca_objects')) {
						$va_additional_settings['showCurrentOnly'] = array(
							'formatType' => FT_TEXT,
							'displayType' => DT_CHECKBOXES,
							'width' => "10", 'height' => "1",
							'takesLocale' => false,
							'default' => '1',
							'label' => _t('Show current only?'),
							'description' => _t('If checked only current storage locations are displayed.')
						);
					}
					
					if (($vs_bundle == 'ca_objects') && ($t_instance->tableName() == 'ca_storage_locations')) {
						$va_additional_settings['showCurrentOnly'] = array(
							'formatType' => FT_TEXT,
							'displayType' => DT_CHECKBOXES,
							'width' => "10", 'height' => "1",
							'takesLocale' => false,
							'default' => '1',
							'label' => _t('Show current only?'),
							'description' => _t('If checked only current objects are displayed.')
						);
					}
					
					if (($t_instance->tableName() == 'ca_objects') && in_array($vs_bundle, array('ca_list_items'))) {
						$va_additional_settings['restrictToTermsRelatedToCollection'] = array(
							'formatType' => FT_TEXT,
							'displayType' => DT_CHECKBOXES,
							'width' => "10", 'height' => "1",
							'takesLocale' => false,
							'default' => '0',
							'label' => _t('Restrict to checklist of terms from related collections?'),
							'description' => _t('Will restrict checklist to those terms applied to related collections.')
						);
						$va_additional_settings['restrictToTermsOnCollectionWithRelationshipType'] = array(
							'formatType' => FT_TEXT,
							'displayType' => DT_SELECT,
							'useRelationshipTypeList' => 'ca_objects_x_collections',
							'width' => "275px", 'height' => "75px",
							'takesLocale' => false,
							'default' => '',
							'label' => _t('Restrict checklist to terms related to collection as'),
							'description' => _t('Will restrict checklist to terms related to collections with the specified relationship type. Leave all unselected for no restriction.')
						);
						$va_additional_settings['restrictToTermsOnCollectionUseRelationshipType'] =  array(
							'formatType' => FT_TEXT,
							'displayType' => DT_SELECT,
							'useRelationshipTypeList' => 'ca_objects_x_vocabulary_terms',
							'width' => "275px", 'height' => "1",
							'takesLocale' => false,
							'default' => '',
							'label' => _t('Checked collection term relationship type'),
							'description' => _t('Specified the relationship used to relate collection-restricted terms to this object.')
						);
					}
					if (!$t_rel->hasField('type_id')) { unset($va_additional_settings['restrict_to_types']); }
					if (sizeof($va_path) == 3) {
						if ($t_link = $this->_DATAMODEL->getInstanceByTableName($va_path[1], true)) {
							if (!$t_link->hasField('type_id')) {
								unset($va_additional_settings['restrict_to_relationship_types']);
								unset($va_additional_settings['useFixedRelationshipType']);
							}
						}
					}
					break;
				case 'special':
					if (in_array($vs_bundle, array('hierarchy_location', 'hierarchy_navigation'))) {
						$va_additional_settings = array(
							'open_hierarchy' => array(
								'formatType' => FT_NUMBER,
								'displayType' => DT_CHECKBOXES,
								'width' => "4", 'height' => "1",
								'takesLocale' => false,
								'default' => '1',
								'label' => _t('Open hierarchy browser by default'),
								'description' => _t('If checked hierarchy browser will be open when form loads.')
							),
							'documentation_url' => array(
								'formatType' => FT_TEXT,
								'displayType' => DT_FIELD,
								'default' => '',
								'width' => "275px", 'height' => 1,
								'label' => _t('Documentation URL'),
								'description' => _t('URL pointing to documentation for this hierarchy browser. Leave blank if no documentation URL exists.')
							)
						);
					} else {
						switch($vs_bundle) {
							case 'ca_commerce_order_history':
								$va_additional_settings = array(
									'orderType' => array(
										'formatType' => FT_TEXT,
										'displayType' => DT_SELECT,
										'takesLocale' => false,
										'default' => '',
										'options' => array(
											_t('Sales order') => 'O',
											_t('Loan') => 'L'
										),
										'label' => _t('Type of order'),
										'description' => _t('Determines which type of order is displayed.')
									)		
								);
								break;
							case 'ca_object_representation_chooser':
								$va_additional_settings = array(
									'elementCode' => array(
										'formatType' => FT_TEXT,
										'displayType' => DT_SELECT,
										'takesLocale' => false,
										'default' => '',
										'showMetadataElementsWithDataType' => 21, // 21="ObjectRepresentation" metadata elements
										'table' => $pm_table_name_or_num,
										'label' => _t('Metadata element'),
										'description' => _t('Metadata element to store representation selection in. Must be of type ObjectRepresentation.')
									)		
								);
								break;
							case 'ca_objects_components_list':
								$va_additional_settings = array(
									'displayTemplate' => array(
										'formatType' => FT_TEXT,
										'displayType' => DT_FIELD,
										'default' => '<l>^ca_objects.preferred_labels.name</l> (^ca_objects.idno)',
										'width' => "275px", 'height' => 4,
										'label' => _t('Component display template'),
										'description' => _t('Layout for component when displayed in list (can include HTML). Element code tags prefixed with the ^ character can be used to represent the value in the template. For example: <i>^ca_objects.idno</i>.')
									)
								);
								break;
							case 'ca_objects_location':
								$va_additional_settings = array(
									'locationTrackingMode' => array(
										'formatType' => FT_TEXT,
										'displayType' => DT_SELECT,
										'options' => array(
											_t('movements') => 'ca_movements',
											_t('storage location relationships') => 'ca_storage_locations'
										),
										'default' => 'ca_movements',
										'width' => "275px", 'height' => 1,
										'label' => _t('Track location using'),
										'description' => _t('')
									),
									'ca_movements_dateElement' => array(
										'formatType' => FT_TEXT,
										'displayType' => DT_SELECT,
										'table' => 'ca_movements',
										'showMetadataElementsWithDataType' => 2,
										'takesLocale' => false,
										'default' => '',
										'width' => "275px", 'height' => "75px",
										'label' => _t('Movement date'),
										'description' => _t('')
									),
									'ca_movements_relationshipType' => array(
										'formatType' => FT_TEXT,
										'displayType' => DT_SELECT,
										'useRelationshipTypeList' => 'ca_movements_x_objects',
										'takesLocale' => false,
										'default' => '',
										'width' => "275px", 'height' => "75px",
										'label' => _t('Limit movement tracking to relationship types'),
										'description' => _t('')
									),
									'ca_storage_locations_relationshipType' => array(
										'formatType' => FT_TEXT,
										'displayType' => DT_SELECT,
										'useRelationshipTypeList' => 'ca_objects_x_storage_locations',
										'takesLocale' => false,
										'default' => '',
										'width' => "275px", 'height' => "75px",
										'label' => _t('Limit storage location tracking to relationship types'),
										'description' => _t('')
									),
									'displayTemplate' => array(
										'formatType' => FT_TEXT,
										'displayType' => DT_FIELD,
										'default' => '',
										'width' => "275px", 'height' => 4,
										'label' => _t('Object location display template'),
										'description' => _t('Layout for current location of object when displayed in list (can include HTML). The template is evaluated relative to the object-movement or object-storage location relationship that is current. Element code tags prefixed with the ^ character can be used to represent the value in the template. For example: <i>^ca_movements.idno</i>.')
									),
									'historyTemplate' => array(
										'formatType' => FT_TEXT,
										'displayType' => DT_FIELD,
										'default' => '',
										'width' => "275px", 'height' => 4,
										'label' => _t('Object location history template'),
										'description' => _t('Layout for each previous location of object when displayed in history list (can include HTML). The template is evaluated relative to the object-movement or object-storage location relationship. Element code tags prefixed with the ^ character can be used to represent the value in the template. For example: <i>^ca_movements.idno</i>.')
									),
									'currentLocationColor' => array(
										'formatType' => FT_TEXT,
										'displayType' => DT_COLORPICKER,
										'takesLocale' => false,
										'default' => '#EEEEEE',
										'width' => "275px", 'height' => "75px",
										'label' => _t('Color for current location'),
										'description' => _t('Color to use as highlight for the current location in the location history.')
									),
									'futureLocationColor' => array(
										'formatType' => FT_TEXT,
										'displayType' => DT_COLORPICKER,
										'takesLocale' => false,
										'default' => '#EEEEEE',
										'width' => "275px", 'height' => "75px",
										'label' => _t('Color for future locations'),
										'description' => _t('Color to use as highlight for future locations in the location history.')
									),
									'pastLocationColor' => array(
										'formatType' => FT_TEXT,
										'displayType' => DT_COLORPICKER,
										'takesLocale' => false,
										'default' => '#EEEEEE',
										'width' => "275px", 'height' => "75px",
										'label' => _t('Color for past locations'),
										'description' => _t('Color to use as highlight for the previous locations in the location history.')
									),
									'useHierarchicalBrowser' => array(
										'formatType' => FT_TEXT,
										'displayType' => DT_CHECKBOXES,
										'width' => "10", 'height' => "1",
										'takesLocale' => false,
										'default' => '1',
										'label' => _t('Use hierarchy browser for storage locations?'),
										'description' => _t('If checked a hierarchical browser will be used to select stroage location items instead of an auto-complete lookup.')
									)
								);
								break;
							case 'ca_objects_history':
								$va_additional_settings = array(
									'ca_object_lots_showTypes' => array(
										'formatType' => FT_TEXT,
										'displayType' => DT_SELECT,
										'useList' => 'object_lot_types',
										'takesLocale' => false,
										'default' => '',
										'width' => "275px", 'height' => "75px",
										'label' => _t('Show lots'),
										'description' => _t('')
									)
								);
								
								$va_types = caGetTypeList("ca_object_lots");
								foreach($va_types as $vn_type_id => $va_type) {
									$va_additional_settings["ca_object_lots_{$va_type['idno']}_dateElement"] = array(
										'formatType' => FT_TEXT,
										'displayType' => DT_SELECT,
										'table' => 'ca_object_lots',
										'showMetadataElementsWithDataType' => 2,
										'takesLocale' => false,
										'default' => '',
										'width' => "275px", 'height' => "75px",
										'label' => _t('Lot (%1) date', $va_type['name_singular']),
										'description' => _t('')
									);
									$va_additional_settings["ca_object_lots_{$va_type['idno']}_color"] = array(
										'formatType' => FT_TEXT,
										'displayType' => DT_COLORPICKER,
										'takesLocale' => false,
										'default' => '#EEEEEE',
										'width' => "275px", 'height' => "75px",
										'label' => _t('Color for %1', $va_type['name_singular']),
										'description' => _t('Color to use as highlight %1.', $va_type['name_plural'])
									);
									$va_additional_settings["ca_object_lots_{$va_type['idno']}_displayTemplate"] = array(
										'formatType' => FT_TEXT,
										'displayType' => DT_FIELD,
										'default' => '',
										'width' => "275px", 'height' => 4,
										'label' => _t('Lot (%1) display template', $va_type['name_singular']),
										'description' => _t('Layout for lot when displayed in history list (can include HTML). The template is evaluated relative to the lot. Element code tags prefixed with the ^ character can be used to represent the value in the template. For example: <i>^ca_object_lots.idno_stub</i>.')

									);
								}
								
								$va_additional_settings['ca_occurrences_showTypes'] = array(
									'formatType' => FT_TEXT,
									'displayType' => DT_SELECT,
									'useList' => 'occurrence_types',
									'takesLocale' => false,
									'default' => '',
									'width' => "275px", 'height' => "75px",
									'label' => _t('Show occurrences'),
									'description' => _t('')
								);
								$va_types = caGetTypeList("ca_occurrences");
								foreach($va_types as $vn_type_id => $va_type) {
									$va_additional_settings["ca_occurrences_{$va_type['idno']}_dateElement"] = array(
										'formatType' => FT_TEXT,
										'displayType' => DT_SELECT,
										'table' => 'ca_occurrences',
										'showMetadataElementsWithDataType' => 2,
										'takesLocale' => false,
										'default' => '',
										'width' => "275px", 'height' => "75px",
										'label' => _t('%1 date', $va_type['name_singular']),
										'description' => _t('')
									);
									$va_additional_settings["ca_occurrences_{$va_type['idno']}_color"] = array(
										'formatType' => FT_TEXT,
										'displayType' => DT_COLORPICKER,
										'takesLocale' => false,
										'default' => '#EEEEEE',
										'width' => "275px", 'height' => "75px",
										'label' => _t('Color for %1', $va_type['name_singular']),
										'description' => _t('Color to use as highlight %1.', $va_type['name_plural'])
									);
									$va_additional_settings["ca_occurrences_{$va_type['idno']}_displayTemplate"] = array(
										'formatType' => FT_TEXT,
										'displayType' => DT_FIELD,
										'default' => '',
										'width' => "275px", 'height' => 4,
										'label' => _t('%1 display template', $va_type['name_singular']),
										'description' => _t('Layout for %1 when displayed in history list (can include HTML). The template is evaluated relative to the %1. Element code tags prefixed with the ^ character can be used to represent the value in the template. For example: <i>^ca_occurrences.idno</i>.', $va_type['name_singular'])

									);
								}
								
								$va_additional_settings['ca_movements_showTypes'] = array(
									'formatType' => FT_TEXT,
									'displayType' => DT_SELECT,
									'useList' => 'movement_types',
									'takesLocale' => false,
									'default' => '',
									'width' => "275px", 'height' => "75px",
									'label' => _t('Show movements'),
									'description' => _t('')
								);
								$va_types = caGetTypeList("ca_movements");
								foreach($va_types as $vn_type_id => $va_type) {
									$va_additional_settings["ca_movements_{$va_type['idno']}_dateElement"] = array(
										'formatType' => FT_TEXT,
										'displayType' => DT_SELECT,
										'table' => 'ca_movements',
										'showMetadataElementsWithDataType' => 2,
										'takesLocale' => false,
										'default' => '',
										'width' => "275px", 'height' => "75px",
										'label' => _t('%1 date', $va_type['name_singular']),
										'description' => _t('')
									);
									$va_additional_settings["ca_movements_{$va_type['idno']}_color"] = array(
										'formatType' => FT_TEXT,
										'displayType' => DT_COLORPICKER,
										'takesLocale' => false,
										'default' => '#EEEEEE',
										'width' => "275px", 'height' => "75px",
										'label' => _t('Color for %1', $va_type['name_singular']),
										'description' => _t('Color to use as highlight %1.', $va_type['name_plural'])
									);
									$va_additional_settings["ca_movements_{$va_type['idno']}_displayTemplate"] = array(
										'formatType' => FT_TEXT,
										'displayType' => DT_FIELD,
										'default' => '',
										'width' => "275px", 'height' => 4,
										'label' => _t('%1 display template', $va_type['name_singular']),
										'description' => _t('Layout for %1 when displayed in history list (can include HTML). The template is evaluated relative to the %1. Element code tags prefixed with the ^ character can be used to represent the value in the template. For example: <i>^ca_movements.idno</i>.', $va_type['name_singular'])

									);
								}
								
								$va_additional_settings['ca_loans_showTypes'] = array(
									'formatType' => FT_TEXT,
									'displayType' => DT_SELECT,
									'useList' => 'loan_types',
									'takesLocale' => false,
									'default' => '',
									'width' => "275px", 'height' => "75px",
									'label' => _t('Show loans'),
									'description' => _t('')
								);
								$va_types = caGetTypeList("ca_loans");
							
								foreach($va_types as $vn_type_id => $va_type) {
									$va_additional_settings["ca_loans_{$va_type['idno']}_dateElement"] = array(
										'formatType' => FT_TEXT,
										'displayType' => DT_SELECT,
										'table' => 'ca_loans',
										'showMetadataElementsWithDataType' => 2,
										'takesLocale' => false,
										'default' => '',
										'width' => "275px", 'height' => "75px",
										'label' => _t('%1 date', $va_type['name_singular']),
										'description' => _t('')
									);
									$va_additional_settings["ca_loans_{$va_type['idno']}_color"] = array(
										'formatType' => FT_TEXT,
										'displayType' => DT_COLORPICKER,
										'takesLocale' => false,
										'default' => '#EEEEEE',
										'width' => "275px", 'height' => "75px",
										'label' => _t('Color for %1', $va_type['name_singular']),
										'description' => _t('Color to use as highlight %1.', $va_type['name_plural'])
									);
									$va_additional_settings["ca_loans_{$va_type['idno']}_displayTemplate"] = array(
										'formatType' => FT_TEXT,
										'displayType' => DT_FIELD,
										'default' => '',
										'width' => "275px", 'height' => 4,
										'label' => _t('%1 display template', $va_type['name_singular']),
										'description' => _t('Layout for %1 when displayed in history list (can include HTML). The template is evaluated relative to the %1. Element code tags prefixed with the ^ character can be used to represent the value in the template. For example: <i>^ca_loans.idno</i>.', $va_type['name_singular'])

									);
								}
									
								$va_additional_settings += array(
									'ca_storage_locations_showRelationshipTypes' => array(
										'formatType' => FT_TEXT,
										'displayType' => DT_SELECT,
										'useRelationshipTypeList' => 'ca_objects_x_storage_locations',
										'takesLocale' => false,
										'default' => '',
										'width' => "275px", 'height' => "75px",
										'label' => _t('Show storage locations'),
										'description' => _t('Show storage locations with selected relationship types.')
									),
									'ca_storage_locations_color' => array(
										'formatType' => FT_TEXT,
										'displayType' => DT_COLORPICKER,
										'takesLocale' => false,
										'default' => '#EEEEEE',
										'width' => "275px", 'height' => "75px",
										'label' => _t('Color for storage location'),
										'description' => _t('Color to use as highlight storage location.')
									),
									'ca_storage_locations_displayTemplate' => array(
										'formatType' => FT_TEXT,
										'displayType' => DT_FIELD,
										'default' => '',
										'width' => "275px", 'height' => 4,
										'label' => _t('Storage location display template'),
										'description' => _t('Layout for storage location when displayed in history list (can include HTML). The template is evaluated relative to the object-storage location relationship. Element code tags prefixed with the ^ character can be used to represent the value in the template. For example: <i>^ca_object_lots.idno_stub</i>.')
									),
									'showDeaccessionInformation' => array(
										'formatType' => FT_NUMBER,
										'displayType' => DT_CHECKBOXES,
										'width' => "4", 'height' => "1",
										'takesLocale' => false,
										'default' => '1',
										'label' => _t('Show deaccession information'),
										'description' => _t('If clicked deaccession information will be shown in the history.')
									),
									'deaccession_color' => array(
										'formatType' => FT_TEXT,
										'displayType' => DT_COLORPICKER,
										'takesLocale' => false,
										'default' => '#EEEEEE',
										'width' => "275px", 'height' => "75px",
										'label' => _t('Color for deaccession'),
										'description' => _t('Color to use as highlight deaccession.')
									),
									'deaccession_displayTemplate' => array(
										'formatType' => FT_TEXT,
										'displayType' => DT_FIELD,
										'default' => '',
										'width' => "275px", 'height' => 4,
										'label' => _t('Deaccession display template'),
										'description' => _t('Layout for deaccession information when displayed in history list (can include HTML). The template is evaluated relative to the object. Element code tags prefixed with the ^ character can be used to represent the value in the template. For example: <i>^ca_objects.deaccession_notes</i>.')
									)
								);
								break;
						}
						$va_additional_settings['documentation_url'] = array(
							'formatType' => FT_TEXT,
							'displayType' => DT_FIELD,
							'default' => '',
							'width' => "275px", 'height' => 1,
							'label' => _t('Documentation URL'),
							'description' => _t('URL pointing to documentation. Leave blank if no documentation URL exists.')
						);
					}
					break;
				default:
					$va_additional_settings = array();
					break;
			}
			
			$t_placement->setSettingDefinitionsForPlacement($va_additional_settings);
			
			$vs_display = "<div id='uiEditorBundle_{$vs_table}_{$vs_bundle_proc}'><span class='bundleDisplayEditorPlacementListItemTitle'>".caUcFirstUTF8Safe($t_instance->getProperty('NAME_SINGULAR'))."</span> ".($vs_label = $t_instance->getDisplayLabel($vs_table.'.'.$vs_bundle_proc))."</div>";
			
			$va_available_bundles[$vs_display][$vs_bundle] = array(
				'bundle' => $vs_bundle,
				'display' => $vs_display,
				'description' => $vs_description = $t_instance->getDisplayDescription($vs_table.'.'.$vs_bundle),
				'settingsForm' => $t_placement->getHTMLSettingForm(array('id' => $vs_bundle.'_0_')),
				'settings' => $va_additional_settings
			);
			
			TooltipManager::add(
				"#uiEditorBundle_{$vs_table}_{$vs_bundle_proc}",
				"<h2>{$vs_label}</h2>".
				_t("Bundle name").": {$vs_bundle_proc}<br />".
				((strlen($vs_description) > 0) ? _t("Description").": {$vs_description}<br />" : "")
			);
		}
		
		ksort($va_available_bundles);
		$va_sorted_bundles = array();
		foreach($va_available_bundles as $vs_k => $va_val) {
			foreach($va_val as $vs_real_key => $va_info) {
				$va_sorted_bundles[$vs_real_key] = $va_info;
			}
		}
		return $va_sorted_bundles;
	}
	# ----------------------------------------
	/**
	 * Determines if a bundle name is valid for a given table
	 */
	public function isAvailableBundle($pm_table_name_or_num,$ps_bundle_name) {
		$va_available_bundles = $this->getAvailableBundles($pm_table_name_or_num);
		if(!is_array($va_available_bundles)) { return false; }
		return in_array($ps_bundle_name, array_keys($va_available_bundles));
	}
	# ----------------------------------------
	# Type restrictions
	# ----------------------------------------
	/**
	 * Adds restriction (a binding between the screen and item type)
	 *
	 * @param int $pn_type_id the type
	 * @param array $pa_settings Array of options for the restriction. (No options are currently implemented).
	 * @return bool True on success, false on error, null if no screen is loaded
	 * 
	 */
	public function addTypeRestriction($pn_type_id, $pa_settings=null) {
		if (!($vn_screen_id = $this->getPrimaryKey())) { return null; }		// screen must be loaded
		if (!is_array($pa_settings)) { $pa_settings = array(); }
		
		$t_ui = new ca_editor_uis();
		if (!($t_instance = $this->_DATAMODEL->getInstanceByTableNum($this->getTableNum()))) { return false; }
		
		if ($this->inTransaction()) { 
			$t_instance->setTransaction($this->getTransaction()); 
			$t_ui->setTransaction($this->getTransaction()); 
		}
		if (!$t_ui->load($this->get('ui_id'))) { return false; }
		

		if ($t_instance instanceof BaseRelationshipModel) { // interstitial type restriction incoming
			$va_rel_type_list = $t_instance->getRelationshipTypes();
			if(!isset($va_rel_type_list[$pn_type_id])) { return false; }
		} else { // "normal" (list-based) type restriction
			$va_type_list = $t_instance->getTypeList();
			if (!isset($va_type_list[$pn_type_id])) { return false; }
		}
		
		$t_restriction = new ca_editor_ui_screen_type_restrictions();
		if ($this->inTransaction()) {  $t_restriction->setTransaction($this->getTransaction()); }
		$t_restriction->setMode(ACCESS_WRITE);
		$t_restriction->set('table_num', $t_ui->get('editor_type'));
		$t_restriction->set('type_id', $pn_type_id);
		$t_restriction->set('screen_id', $this->getPrimaryKey());
		foreach($pa_settings as $vs_setting => $vs_setting_value) {
			$t_restriction->setSetting($vs_setting, $vs_setting_value);
		}
		$t_restriction->insert();
		
		if ($t_restriction->numErrors()) {
			$this->errors = $t_restriction->errors();
			return false;
		}
		return true;
	}
	# ----------------------------------------
	/**
	 * Sets restrictions for currently loaded screen
	 *
	 * @param array $pa_type_ids list of types to restrict to
	 * @return bool True on success, false on error, null if no screen is loaded
	 * 
	 */
	public function setTypeRestrictions($pa_type_ids) {
		if (!($vn_screen_id = $this->getPrimaryKey())) { return null; }		// screen must be loaded
		if (!is_array($pa_type_ids)) {
			if (is_numeric($pa_type_ids)) { 
				$pa_type_ids = array($pa_type_ids); 
			} else {
				$pa_type_ids = array();
			}
		}
		
		$t_ui = new ca_editor_uis();
		if (!($t_instance = $this->_DATAMODEL->getInstanceByTableNum($this->getTableNum()))) { return false; }

		if ($this->inTransaction()) { 
			$t_instance->setTransaction($this->getTransaction()); 
			$t_ui->setTransaction($this->getTransaction()); 
		}
		
		if (!$t_ui->load($this->get('ui_id'))) { return false; }
		
		if ($t_instance instanceof BaseRelationshipModel) { // interstitial type restrictions
			$va_type_list = $t_instance->getRelationshipTypes();
		} else { // "normal" (list-based) type restrictions
			$va_type_list = $t_instance->getTypeList();
		}

		$va_current_restrictions = $this->getTypeRestrictions();
		$va_current_type_ids = array();
		foreach($va_current_restrictions as $vn_i => $va_restriction) {
			$va_current_type_ids[$va_restriction['type_id']] = true;
		}
		
		foreach($va_type_list as $vn_type_id => $va_type_info) {
			if(in_array($vn_type_id, $pa_type_ids)) {
				// need to set
				if(!isset($va_current_type_ids[$vn_type_id])) {
					$this->addTypeRestriction($vn_type_id);
				}
			} else {
				// need to unset
				if(isset($va_current_type_ids[$vn_type_id])) {
					$this->removeTypeRestriction($vn_type_id);
				}
			}
		}
		return true;
	}
	# ----------------------------------------
	/**
	 * Remove restriction from currently loaded screen for specified type
	 *
	 * @param int $pn_type_id The type of the restriction
	 * @return bool True on success, false on error, null if no screen is loaded
	 */
	public function removeTypeRestriction($pn_type_id) {
		if (!($vn_screen_id = $this->getPrimaryKey())) { return null; }		// screen must be loaded
		
		$o_db = $this->getDb();
		
		$qr_res = $o_db->query("
			DELETE FROM ca_editor_ui_screen_type_restrictions
			WHERE
				screen_id = ? AND type_id = ?
		", (int)$this->getPrimaryKey(), (int)$pn_type_id);
		
		if ($o_db->numErrors()) {
			$this->errors = $o_db->errors();
			return false;
		}
		return true;
	}
	# ----------------------------------------
	/**
	 * Remove all type restrictions from loaded screen
	 *
	 * @return bool True on success, false on error, null if no screen is loaded 
	 */
	public function removeAllTypeRestrictions() {
		if (!($vn_screen_id = $this->getPrimaryKey())) { return null; }		// screen must be loaded
		
		$o_db = $this->getDb();
		
		$qr_res = $o_db->query("
			DELETE FROM ca_editor_ui_screen_type_restrictions
			WHERE
				screen_id = ?
		", (int)$this->getPrimaryKey());
		
		if ($o_db->numErrors()) {
			$this->errors = $o_db->errors();
			return false;
		}
		return true;
	}
	# ----------------------------------------
	/**
	 * Return restrictions for currently loaded screen
	 *
	 * @param int $pn_type_id Type to limit returned restrictions to; if omitted or null then all restrictions are returned
	 * @return array A list of restrictions, false on error or null if no screen is loaded
	 */
	public function getTypeRestrictions($pn_type_id=null) {
		if (!($vn_screen_id = $this->getPrimaryKey())) { return null; }		// screen must be loaded
		
		$o_db = $this->getDb();
		
		$vs_table_type_sql = '';
		if ($pn_type_id > 0) {
			$vs_table_type_sql .= ' AND type_id = '.intval($pn_type_id);
		}
		$qr_res = $o_db->query("
			SELECT *
			FROM ca_editor_ui_screen_type_restrictions
			WHERE
				screen_id = ? {$vs_table_type_sql}
		", (int)$this->getPrimaryKey());
		
		if ($o_db->numErrors()) {
			$this->errors = $o_db->errors();
			return false;
		}
		
		$va_restrictions = array();
		while($qr_res->nextRow()) {
			$va_restrictions[] = $qr_res->getRow();
		}
		return $va_restrictions;
	}
	# ------------------------------------------------------
	/**
	 * Returns list of placements in the currently loaded screen
	 *
	 * @param array $pa_options Optional array of options. Supported options are:
	 *		noCache = if set to true, no caching of placement values is performed.
	 *		user_id = if specified then placements are only returned if the user has at least read access to the screen
	 * @return array List of placements. Each element in the list is an array with the following keys:
	 *		display = A display label for the bundle
	 *		bundle = The bundle name
	 */
	public function getPlacementsInScreen($pa_options=null) {
		if (!is_array($pa_options)) { $pa_options = array(); }
		$pb_no_cache = isset($pa_options['noCache']) ? (bool)$pa_options['noCache'] : false;
		$pn_user_id = isset($pa_options['user_id']) ? $pa_options['user_id'] : null;
		
		//if ($pn_user_id && !$this->haveAccessToDisplay($pn_user_id, __CA_BUNDLE_DISPLAY_READ_ACCESS__)) {
		//	return array();
		//}
		
		if (!($pn_table_num = $this->getTableNum())) { return null; }
		
		if (!($t_instance = $this->_DATAMODEL->getInstanceByTableNum($pn_table_num, true))) { return null; }
		
		if(!is_array($va_placements = $this->getPlacements($pa_options))) { $va_placements = array(); }
		
		$va_placements_in_screen = array();
		foreach($va_placements as $vn_placement_id => $va_placement) {
			$vs_bundle_proc = preg_replace('!^ca_attribute_!', '', $va_placement['bundle_name']);
			
			$vs_label = ($vs_label = ($t_instance->getDisplayLabel($t_instance->tableName().'.'.$vs_bundle_proc))) ? $vs_label : $va_placement['bundle_name'];
			if(is_array($va_placement['settings']['label'])){
				$va_tmp = caExtractValuesByUserLocale(array($va_placement['settings']['label']));
				if ($vs_user_set_label = array_shift($va_tmp)) {
					$vs_label = "{$vs_label} (<em>{$vs_user_set_label}</em>)";
				}
			}
			
			$vs_display = "<div id='uiEditor_{$vn_placement_id}'><span class='bundleDisplayEditorPlacementListItemTitle'>".caUcFirstUTF8Safe($t_instance->getProperty('NAME_SINGULAR'))."</span> {$vs_label}</div>";
			
			$va_placement['display'] = $vs_display;
			$va_placement['bundle'] = $va_placement['bundle_name']; // we used 'bundle' in the arrays, but the database field is called 'bundle_name' and getPlacements() returns data directly from the database
			unset($va_placement['bundle_name']);
			
			$va_placements_in_screen[$vn_placement_id] = $va_placement;
			
			$vs_description = $t_instance->getDisplayDescription($t_instance->tableName().'.'.$vs_bundle_proc);
			TooltipManager::add(
				"#uiEditor_{$vn_placement_id}",
				"<h2>{$vs_label}</h2>".
				_t("Bundle name").": {$vs_bundle_proc}<br />".
				((strlen($vs_description) > 0) ? _t("Description").": {$vs_description}<br />" : "")
			);
		}
		
		return $va_placements_in_screen;
	}
	# ------------------------------------------------------
	/**
	 * Returns number of placements in the currently loaded screen
	 *
	 * @param array $pa_options Optional array of options. Supported options are:
	 *		noCache = if set to true, no caching of placement values is performed.
	 *		user_id = if specified then placements are only returned if the user has at least read access to the screen
	 * @return int Number of placements. 
	 */
	public function getPlacementCount($pa_options=null) {
		return sizeof($this->getPlacementsInDisplay($pa_options));
	}
	# ------------------------------------------------------
	/** 
	 *
	 */
	public function getTableNum() {
		if (!($vn_ui_id = $this->get('ui_id'))) { return null; }
		
		if (isset(ca_editor_ui_screens::$s_table_num_cache[$vn_ui_id])) { return ca_editor_ui_screens::$s_table_num_cache[$vn_ui_id]; }
		$t_ui = new ca_editor_uis($vn_ui_id);
		
		return ca_editor_ui_screens::$s_table_num_cache[$vn_ui_id] = $t_ui->get('editor_type');
	}
	# ------------------------------------------------------
	# Bundles
	# ------------------------------------------------------
	/**
	 * Renders and returns HTML form bundle for management of placements in the currently loaded screen
	 * 
	 * @param object $po_request The current request object
	 * @param string $ps_form_name The name of the form in which the bundle will be rendered
	 *
	 * @return string Rendered HTML bundle for display
	 */
	public function getPlacementsHTMLFormBundle($po_request, $ps_form_name, $ps_placement_code, $pa_options=null) {
		$o_view = new View($po_request, $po_request->getViewsDirectoryPath().'/bundles/');
		
		$o_view->setVar('t_screen', $this);		
		$o_view->setVar('t_placement', new ca_editor_ui_bundle_placements());		
		$o_view->setVar('id_prefix', $ps_form_name);	
		$o_view->setVar('placement_code', $ps_placement_code);	
		$o_view->setVar('request', $po_request);
		
		return $o_view->render('ca_editor_ui_bundle_placements.php');
	}
	# ----------------------------------------
	public function savePlacementsFromHTMLForm($po_request, $ps_form_prefix, $ps_placement_code) {
		if ($vs_bundles = $po_request->getParameter("{$ps_placement_code}{$ps_form_prefix}displayBundleList", pString)) {
			$va_bundles = explode(';', $vs_bundles);
			
			$t_screen = new ca_editor_ui_screens($this->getPrimaryKey());
			$va_placements = $t_screen->getPlacements(array('user_id' => $po_request->getUserID()));
			
			// remove deleted bundles
			
			foreach($va_placements as $vn_placement_id => $va_bundle_info) {
				if (!in_array($va_bundle_info['bundle_name'].'_'.$va_bundle_info['placement_id'], $va_bundles)) {
					$t_screen->removePlacement($va_bundle_info['placement_id'], array('user_id' => $po_request->getUserID()));
					if ($t_screen->numErrors()) {
						$this->errors = $t_screen->errors;
						return false;
					}
				}
			}
			
			$va_locale_list = ca_locales::getLocaleList(array('index_by_code' => true));
			
			$va_available_bundles = $t_screen->getAvailableBundles();
			foreach($va_bundles as $vn_i => $vs_bundle) {
				// get settings
				
				if (preg_match('!^(.*)_([\d]+)$!', $vs_bundle, $va_matches)) {
					$vn_placement_id = (int)$va_matches[2];
					$vs_bundle = $va_matches[1];
				} else {
					$vn_placement_id = null;
				}
				$vs_bundle_proc = str_replace(".", "_", $vs_bundle);
				
				$va_settings = array();
				
				foreach($_REQUEST as $vs_key => $vs_val) {
					if (preg_match("!^{$vs_bundle_proc}_([\d]+)_(.*)$!", $vs_key, $va_matches)) {
						// is this locale-specific?
						if (preg_match('!(.*)_([a-z]{2}_[A-Z]{2})$!', $va_matches[2], $va_locale_matches)) {
							$vn_locale_id = isset($va_locale_list[$va_locale_matches[2]]) ? (int)$va_locale_list[$va_locale_matches[2]]['locale_id'] : 0;
							
							// NOTE: we set keys for both locale_id (which how other placement-using editor like ca_search_forms and 
							// ca_bundle_displays do) *AND* the locale code (eg. "en_US"). This is because the settings created in profile and
							// in pre v1.1 systems are keyed by code, not locale_id. There's nothing wrong with using code - it's just as unique as the locale_id
							// and it's convenient to use both interchangeably in any event.
							//
							$va_settings[(int)$va_matches[1]][$va_locale_matches[1]][$vn_locale_id] = $va_settings[(int)$va_matches[1]][$va_locale_matches[1]][$va_locale_matches[2]] = $vs_val;
						} else {
							$va_settings[(int)$va_matches[1]][$va_matches[2]] = $vs_val;
						}
					}
				}
				
				if($vn_placement_id === 0) {
					$t_screen->addPlacement($vs_bundle, $vs_bundle.($vn_i + 1), $va_settings[$vn_placement_id], $vn_i + 1, array('user_id' => $po_request->getUserID(), 'additional_settings' => $va_available_bundles[$vs_bundle]['settings']));
					if ($t_screen->numErrors()) {
						$this->errors = $t_screen->errors;
						return false;
					}
				} else {
					$t_placement = new ca_editor_ui_bundle_placements($vn_placement_id, $va_available_bundles[$vs_bundle]['settings']);
					$t_placement->setMode(ACCESS_WRITE);
					$t_placement->set('rank', $vn_i + 1);
					
					if (is_array($va_settings[$vn_placement_id])) {
						foreach($t_placement->getAvailableSettings() as $vs_setting => $va_setting_info) {
							$vs_val = isset($va_settings[$vn_placement_id][$vs_setting]) ? $va_settings[$vn_placement_id][$vs_setting] : null;
						
							$t_placement->setSetting($vs_setting, $vs_val);
						}
					}
					$t_placement->update();
					
					if ($t_placement->numErrors()) {
						$this->errors = $t_placement->errors;
						return false;
					}
				}
			}
		} 
		
		return true;
	}
	# ----------------------------------------
	/**
	 * Renders and returns HTML form bundle for management of type restriction in the currently loaded screen
	 * 
	 * @param object $po_request The current request object
	 * @param string $ps_form_name The name of the form in which the bundle will be rendered
	 *
	 * @return string Rendered HTML bundle for display
	 */
	public function getTypeRestrictionsHTMLFormBundle($po_request, $ps_form_name, $ps_placement_code, $pa_options=null) {
		$o_view = new View($po_request, $po_request->getViewsDirectoryPath().'/bundles/');
		
		$o_view->setVar('t_screen', $this);			
		$o_view->setVar('id_prefix', $ps_form_name);	
		$o_view->setVar('placement_code', $ps_placement_code);		
		$o_view->setVar('request', $po_request);
		
		$va_type_restrictions = $this->getTypeRestrictions();
		$va_restriction_type_ids = array();
		foreach($va_type_restrictions as $vn_i => $va_restriction) {
			$va_restriction_type_ids[] = $va_restriction['type_id'];
		}
		
		if (!($t_instance = $this->_DATAMODEL->getInstanceByTableNum($vn_table_num = $this->getTableNum()))) { return null; }

		if($t_instance instanceof BaseRelationshipModel) { // interstitial
			$o_view->setVar('type_restrictions', $t_instance->getRelationshipTypesAsHTMLSelect($t_instance->getLeftTableName(),null,null,array('name' => 'type_restrictions[]', 'multiple' => 1, 'size' => 5), array('values' => $va_restriction_type_ids)));
		} else { // list-based
			$o_view->setVar('type_restrictions', $t_instance->getTypeListAsHTMLFormElement('type_restrictions[]', array('multiple' => 1, 'height' => 5), array('value' => 0, 'values' => $va_restriction_type_ids)));
		}
	
		return $o_view->render('ca_editor_ui_screen_type_restrictions.php');
	}
	# ----------------------------------------
	public function saveTypeRestrictionsFromHTMLForm($po_request, $ps_form_prefix, $ps_placement_code) {
		if (!$this->getPrimaryKey()) { return null; }
		
		return $this->setTypeRestrictions($po_request->getParameter('type_restrictions', pArray));
	}
	# ----------------------------------------
}