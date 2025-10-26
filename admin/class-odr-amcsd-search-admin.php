<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://opendatarepository.org
 * @since      1.0.0
 *
 * @package    Odr_Amcsd_Search
 * @subpackage Odr_Amcsd_Search/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Odr_Amcsd_Search
 * @subpackage Odr_Amcsd_Search/admin
 * @author     Nathan Stone <nate.stone@opendatarepository.org>
 */
class Odr_Amcsd_Search_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @param string $plugin_name The name of this plugin.
     * @param string $version The version of this plugin.
     * @since    1.0.0
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

        add_action('admin_init', array($this, 'odrRegisterSettings'));
        add_action('admin_menu', array($this, 'addPluginAdminMenu'), 9);

        // add_action( 'admin_enqueue_scripts', array($this, 'enqueue_styles') );
        // add_action( 'admin_enqueue_scripts', array($this, 'enqueue_scripts') );


    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Odr_Amcsd_Search_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Odr_Amcsd_Search_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_register_style($this->plugin_name . '-style', plugin_dir_url(__FILE__) . 'css/odr-amcsd-search-admin.css', array(), $this->version, 'all');
        wp_register_style($this->plugin_name . '-coloris-style', plugin_dir_url(__FILE__) . 'css/coloris.min.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Odr_Amcsd_Search_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Odr_Amcsd_Search_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_register_script($this->plugin_name . '-js', plugin_dir_url(__FILE__) . 'js/odr-amcsd-search-admin.js', array(), $this->version, false);
        wp_register_script($this->plugin_name . '-coloris-js', plugin_dir_url(__FILE__) . 'js/coloris.min.js', array(), $this->version, false);

        add_action('admin_menu', 'odr_amcsd_search_add_settings_page');
    }

    public function addPluginAdminMenu()
    {
        //add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
        add_menu_page(
            $this->plugin_name,
            'AMCSD Search',
            'administrator',
            $this->plugin_name,
            array($this, 'displayPluginAdminDashboard'),
            'dashicons-chart-area',
            26
        );

        //add_submenu_page( '$parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
        add_submenu_page(
            $this->plugin_name,
            'AMCSD Search Settings',
            'Settings',
            'administrator',
            $this->plugin_name . '-settings',
            array($this, 'displayPluginAdminSettings')
        );
    }

    public function displayPluginAdminDashboard()
    {
        // List all records IMA
        // https://beta.amcsd.net/odr/api/v1/search/database/0f59b751673686197f49f4e117e9/records/0/0.json
        require_once 'partials/' . $this->plugin_name . '-admin-display.php';
    }

    public function displayPluginAdminSettings()
    {

        wp_enqueue_style($this->plugin_name . '-style');
        wp_enqueue_style($this->plugin_name . '-coloris-style');
        wp_enqueue_script($this->plugin_name . '-js');
        wp_enqueue_script($this->plugin_name . '-coloris-js');

        // set this var to be used in the settings-display view
        // IMA List UUID
        // AMCSD Cell Parameters
        $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'general';
        if (isset($_GET['error_message'])) {
            // add_action('admin_notices', array($this,'pluginNameSettingsMessages'));
            // do_action( 'admin_notices', $_GET['error_message'] );
        }
        require_once 'partials/' . $this->plugin_name . '-admin-settings-display.php';
    }

    public function odr_amcsd_search_plugin_options_validate($input)
    {
        return $input;
    }


    function odrRegisterSettings()
    {
        register_setting(
            'odr_amcsd_search_plugin_options',
            'odr_amcsd_search_plugin_options',
            'odr_amcsd_search_plugin_options_validate'
        );
        add_settings_section(
            'field_settings',
            'Field Settings',
            'odr_amcsd_search_plugin_section_text',
            $this->plugin_name
        );

        /**
         *
         * [
         *   odr-rruff-search-display datatype_id = "738"
         *   general_search = "gen"
         *   chemistry_incl = "7055"
         *   mineral_name = "7052"
         *   sample_id = "7069"
         *   redirect_url = "/odr/rruff_sample#/odr/search/display/2010"
         * ]
         *
         */
        add_settings_field(
            'odr_amcsd_search_datatype_id',
            'Datatype ID (numeric)',
            array($this, 'odr_amcsd_search_datatype_id'),
            $this->plugin_name,
            'field_settings'
        );
        add_settings_field(
            'odr_amcsd_search_general_search',
            'General Search (gen)',
            array($this, 'odr_amcsd_search_general_search'),
            $this->plugin_name,
            'field_settings'
        );
        add_settings_field(
            'odr_amcsd_search_author_names',
            'Author Names',
            array($this, 'odr_amcsd_search_author_names'),
            $this->plugin_name,
            'field_settings'
        );
        add_settings_field(
            'odr_amcsd_search_chemistry_incl',
            'Chemistry Incl Field',
            array($this, 'odr_amcsd_search_chemistry_incl'),
            $this->plugin_name,
            'field_settings'
        );
        add_settings_field(
            'odr_amcsd_search_mineral_name',
            'Mineral Name Field',
            array($this, 'odr_amcsd_search_mineral_name'),
            $this->plugin_name,
            'field_settings'
        );
        add_settings_field(
            'odr_amcsd_search_a',
            'Cell Parameter: a',
            array($this, 'odr_amcsd_search_a'),
            $this->plugin_name,
            'field_settings'
        );
        add_settings_field(
            'odr_amcsd_search_b',
            'Cell Parameter: b',
            array($this, 'odr_amcsd_search_b'),
            $this->plugin_name,
            'field_settings'
        );
        add_settings_field(
            'odr_amcsd_search_c',
            'Cell Parameter: c',
            array($this, 'odr_amcsd_search_c'),
            $this->plugin_name,
            'field_settings'
        );
        add_settings_field(
            'odr_amcsd_search_alpha',
            'Cell Parameter: alpha',
            array($this, 'odr_amcsd_search_alpha'),
            $this->plugin_name,
            'field_settings'
        );
        add_settings_field(
            'odr_amcsd_search_beta',
            'Cell Parameter: beta',
            array($this, 'odr_amcsd_search_beta'),
            $this->plugin_name,
            'field_settings'
        );
        add_settings_field(
            'odr_amcsd_search_gamma',
            'Cell Parameter: gamma',
            array($this, 'odr_amcsd_search_gamma'),
            $this->plugin_name,
            'field_settings'
        );
        add_settings_field(
            'odr_amcsd_search_space_group',
            'Cell Parameter: space_group',
            array($this, 'odr_amcsd_search_space_group'),
            $this->plugin_name,
            'field_settings'
        );
        add_settings_field(
            'odr_amcsd_search_d_spacing',
            'Cell Parameter: d_spacing',
            array($this, 'odr_amcsd_search_d_spacing'),
            $this->plugin_name,
            'field_settings'
        );
        add_settings_field(
            'odr_amcsd_search_intensity',
            'Cell Parameter: intensity',
            array($this, 'odr_amcsd_search_intensity'),
            $this->plugin_name,
            'field_settings'
        );
        add_settings_field(
            'odr_amcsd_search_2_theta',
            'Cell Parameter: 2_theta',
            array($this, 'odr_amcsd_search_2_theta'),
            $this->plugin_name,
            'field_settings'
        );
        add_settings_field(
            'odr_amcsd_search_crystal_system',
            'Cell Parameter: crystal_system',
            array($this, 'odr_amcsd_search_crystal_system'),
            $this->plugin_name,
            'field_settings'
        );
        add_settings_field(
            'odr_amcsd_search_redirect_url',
            'Redirect URL',
            array($this, 'odr_amcsd_search_redirect_url'),
            $this->plugin_name,
            'field_settings'
        );
        // default_search = "2229"
        add_settings_field(
            'odr_amcsd_search_default_search',
            'AMC Long Form Search Theme ID',
            array($this, 'odr_amcsd_search_default_search'),
            $this->plugin_name,
            'field_settings'
        );
        add_settings_field(
            'odr_amcsd_search_amc_short_form',
            'AMC Short Form Search Theme ID',
            array($this, 'odr_amcsd_search_amc_short_form'),
            $this->plugin_name,
            'field_settings'
        );
        add_settings_field(
            'odr_amcsd_search_cif',
            'CIF Display Search Theme ID',
            array($this, 'odr_amcsd_search_cif'),
            $this->plugin_name,
            'field_settings'
        );
        add_settings_field(
            'odr_amcsd_search_sort_name_field',
            'Sort by Mineral Name Field ID',
            array($this, 'odr_amcsd_search_sort_name_field'),
            $this->plugin_name,
            'field_settings'
        );
        add_settings_field(
            'odr_amcsd_search_sort_ideal_chemistry_field',
            'Sort by Ideal Chemistry Field ID',
            array($this, 'odr_amcsd_search_sort_ideal_chemistry_field'),
            $this->plugin_name,
            'field_settings'
        );
        add_settings_field(
            'odr_amcsd_search_sort_locality_field',
            'Sort by Locality Field ID',
            array($this, 'odr_amcsd_search_sort_locality_field'),
            $this->plugin_name,
            'field_settings'
        );
    }

    function odr_amcsd_search_plugin_section_text()
    {
        echo '<p>Here you can set all the options for using the API</p>';
    }

    function odr_amcsd_search_datatype_id()
    {
        $options = get_option('odr_amcsd_search_plugin_options');
        echo "<input id='odr_amcsd_search_datatype_id' name='odr_amcsd_search_plugin_options[datatype_id]' type='text' value='" . esc_attr($options['datatype_id']) . "' />";
    }

    function odr_amcsd_search_general_search()
    {
        $options = get_option('odr_amcsd_search_plugin_options');
        echo "<input id='odr_amcsd_search_general_search' name='odr_amcsd_search_plugin_options[general_search]' type='text' value='" . esc_attr($options['general_search']) . "' />";
    }

    function odr_amcsd_search_author_names()
    {
        $options = get_option('odr_amcsd_search_plugin_options');
        echo "<input id='odr_amcsd_search_author_names' name='odr_amcsd_search_plugin_options[author_names]' type='text' value='" . esc_attr($options['author_names']) . "' />";
    }

    function odr_amcsd_search_chemistry_incl()
    {
        $options = get_option('odr_amcsd_search_plugin_options');
        echo "<input id='odr_amcsd_search_chemistry_incl' name='odr_amcsd_search_plugin_options[chemistry_incl]' type='text' value='" . esc_attr($options['chemistry_incl']) . "' />";
    }

    function odr_amcsd_search_mineral_name()
    {
        $options = get_option('odr_amcsd_search_plugin_options');
        echo "<input id='odr_amcsd_search_mineral_name' name='odr_amcsd_search_plugin_options[mineral_name]' type='text' value='" . esc_attr($options['mineral_name']) . "' />";
    }

    function odr_amcsd_search_a()
    {
        $options = get_option('odr_amcsd_search_plugin_options');
        echo "<input id='odr_amcsd_search_a' name='odr_amcsd_search_plugin_options[a]' type='text' value='" . esc_attr($options['a']) . "' />";
    }

    function odr_amcsd_search_b()
    {
        $options = get_option('odr_amcsd_search_plugin_options');
        echo "<input id='odr_amcsd_search_b' name='odr_amcsd_search_plugin_options[b]' type='text' value='" . esc_attr($options['b']) . "' />";
    }

    function odr_amcsd_search_c()
    {
        $options = get_option('odr_amcsd_search_plugin_options');
        echo "<input id='odr_amcsd_search_c' name='odr_amcsd_search_plugin_options[c]' type='text' value='" . esc_attr($options['c']) . "' />";
    }

    function odr_amcsd_search_alpha()
    {
        $options = get_option('odr_amcsd_search_plugin_options');
        echo "<input id='odr_amcsd_search_alpha' name='odr_amcsd_search_plugin_options[alpha]' type='text' value='" . esc_attr($options['alpha']) . "' />";
    }

    function odr_amcsd_search_beta()
    {
        $options = get_option('odr_amcsd_search_plugin_options');
        echo "<input id='odr_amcsd_search_beta' name='odr_amcsd_search_plugin_options[beta]' type='text' value='" . esc_attr($options['beta']) . "' />";
    }

    function odr_amcsd_search_gamma()
    {
        $options = get_option('odr_amcsd_search_plugin_options');
        echo "<input id='odr_amcsd_search_gamma' name='odr_amcsd_search_plugin_options[gamma]' type='text' value='" . esc_attr($options['gamma']) . "' />";
    }

    function odr_amcsd_search_space_group()
    {
        $options = get_option('odr_amcsd_search_plugin_options');
        echo "<input id='odr_amcsd_search_space_group' name='odr_amcsd_search_plugin_options[space_group]' type='text' value='" . esc_attr($options['space_group']) . "' />";
    }

    function odr_amcsd_search_d_spacing()
    {
        $options = get_option('odr_amcsd_search_plugin_options');
        echo "<input id='odr_amcsd_search_d_spacing' name='odr_amcsd_search_plugin_options[d_spacing]' type='text' value='" . esc_attr($options['d_spacing']) . "' />";
    }
    function odr_amcsd_search_intensity()
    {
        $options = get_option('odr_amcsd_search_plugin_options');
        echo "<input id='odr_amcsd_search_intensity' name='odr_amcsd_search_plugin_options[intensity]' type='text' value='" . esc_attr($options['intensity']) . "' />";
    }
    function odr_amcsd_search_2_theta()
    {
        $options = get_option('odr_amcsd_search_plugin_options');
        echo "<input id='odr_amcsd_search_2_theta' name='odr_amcsd_search_plugin_options[2_theta]' type='text' value='" . esc_attr($options['2_theta']) . "' />";
    }
    function odr_amcsd_search_crystal_system()
    {
        $options = get_option('odr_amcsd_search_plugin_options');
        echo "<input id='odr_amcsd_search_crystal_system' name='odr_amcsd_search_plugin_options[crystal_system]' type='text' value='" . esc_attr($options['crystal_system']) . "' />";
    }

    function odr_amcsd_search_redirect_url()
    {
        $options = get_option('odr_amcsd_search_plugin_options');
        echo "<input id='odr_amcsd_search_redirect_url' name='odr_amcsd_search_plugin_options[redirect_url]' type='text' value='" . esc_attr($options['redirect_url']) . "' />";
    }

    function odr_amcsd_search_default_search()
    {
        $options = get_option('odr_amcsd_search_plugin_options');
        echo "<input id='odr_amcsd_search_default_search' name='odr_amcsd_search_plugin_options[default_search]' type='text' value='" . esc_attr($options['default_search']) . "' />";
    }

    function odr_amcsd_search_amc_short_form()
    {
        $options = get_option('odr_amcsd_search_plugin_options');
        echo "<input id='odr_amcsd_search_amc_short_form' name='odr_amcsd_search_plugin_options[amc_short_form]' type='text' value='" . esc_attr($options['amc_short_form']) . "' />";
    }

    function odr_amcsd_search_cif()
    {
        $options = get_option('odr_amcsd_search_plugin_options');
        echo "<input id='odr_amcsd_search_cif' name='odr_amcsd_search_plugin_options[cif]' type='text' value='" . esc_attr($options['cif']) . "' />";
    }

    function odr_amcsd_search_search_pictures()
    {
        $options = get_option('odr_amcsd_search_plugin_options');
        echo "<input id='odr_amcsd_search_search_pictures' name='odr_amcsd_search_plugin_options[search_pictures]' type='text' value='" . esc_attr($options['search_pictures']) . "' />";
    }

    function odr_amcsd_search_search_spectra()
    {
        $options = get_option('odr_amcsd_amcsd_search_plugin_options');
        echo "<input id='odr_amcsd_search_search_spectra' name='odr_amcsd_search_plugin_options[search_spectra]' type='text' value='" . esc_attr($options['search_spectra']) . "' />";
    }

    function odr_amcsd_search_sort_name_field()
    {
        $options = get_option('odr_amcsd_search_plugin_options');
        echo "<input id='odr_amcsd_search_sort_name_field' name='odr_amcsd_search_plugin_options[sort_name_field]' type='text' value='" . esc_attr($options['sort_name_field']) . "' />";
    }

    function odr_amcsd_search_sort_rruff_id_field()
    {
        $options = get_option('odr_amcsd_search_plugin_options');
        echo "<input id='odr_amcsd_search_sort_rruff_id_field' name='odr_amcsd_search_plugin_options[sort_rruff_id_field]' type='text' value='" . esc_attr($options['sort_rruff_id_field']) . "' />";
    }

    function odr_amcsd_search_sort_ideal_chemistry_field()
    {
        $options = get_option('odr_amcsd_search_plugin_options');
        echo "<input id='odr_amcsd_search_sort_ideal_chemistry_field' name='odr_amcsd_search_plugin_options[sort_ideal_chemistry_field]' type='text' value='" . esc_attr($options['sort_ideal_chemistry_field']) . "' />";
    }

    function odr_amcsd_search_sort_source_field()
    {
        $options = get_option('odr_amcsd_search_plugin_options');
        echo "<input id='odr_amcsd_search_sort_source_field' name='odr_amcsd_search_plugin_options[sort_source_field]' type='text' value='" . esc_attr($options['sort_source_field']) . "' />";
    }

    function odr_amcsd_search_sort_locality_field()
    {
        $options = get_option('odr_amcsd_search_plugin_options');
        echo "<input id='odr_amcsd_search_sort_locality_field' name='odr_amcsd_search_plugin_options[sort_locality_field]' type='text' value='" . esc_attr($options['sort_locality_field']) . "' />";
    }
}

