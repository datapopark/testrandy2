<?php
/**
 * Plugin Name: WeddingPress
 * Plugin URI: https://weddingpress.net
 * Secret Key: 83a5bb0e2ad5164690bc7a42ae592cf5
 * Description: Plugin Elementor Templates for Wedding by WeddingPress.
 * Version: 3.0.10
 * Author: WeddingPress
 * Author URI: https://weddingpress.net
 *
 *
 *
 * * WeddingPress incorporates codes from:
 * - Elementor Widget Manager (c) IdeaBox, license: GPL v2, https://github.com/helloideabox/elementor-widget-manager
 * - Countdown Timer for Elementor (c) FlickDevs, license: GPL v2, https://wordpress.org/plugins/countdown-timer-for-elementor/
 * - Cool Timeline Addon For Elementor Page Builder (c) Cool Plugins, license: GPL v2, https://wordpress.org/plugins/cool-timeline-addon-for-elementor/
 * - Unlimited Elementor Inner Sections By BoomDevs, Copyright (c) BoomDevs, license: GPL v2, https://wordpress.org/plugins/unlimited-elementor-inner-sections-by-boomdevs
 * - LandingPress, Copyright (c) LandingPress, license: GPL v3, https://www.landingpress.net/
 * - Dynamic Content for Elementor (c) Dynamic.ooo, license: GPL v3, https://www.dynamic.ooo/
 * - Exclusive Addons Elementor (c) DevsCred.com, license: GPL v3, https://exclusiveaddons.com/
 * - CommentPress (c) Max López, license: GPL v2
 * - PowerPack, Copyright (c) Team IdeaBox - PowerPack Elements, license: GPL v3, http://powerpackelements.com
 * 
 */ 

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( !defined( 'WEDDINGPRESS_ELEMENTOR_NAME' ) ) {
	define( 'WEDDINGPRESS_ELEMENTOR_NAME', 'WeddingPress V3' );
}
if ( !defined( 'WEDDINGPRESS_ELEMENTOR_STORE' ) ) {
	define( 'WEDDINGPRESS_ELEMENTOR_STORE', 'https://garudanesia.com' );
}
if ( !defined( 'WEDDINGPRESS_ELEMENTOR_PATH' ) ) {
	define( 'WEDDINGPRESS_ELEMENTOR_PATH', plugin_dir_path( __FILE__ ) );
}
if ( !defined( 'WEDDINGPRESS_ELEMENTOR_DIRECTORY' ) ) {
	define( 'WEDDINGPRESS_ELEMENTOR_DIRECTORY', plugin_dir_path( __FILE__ ) );
}
if ( !defined( 'WEDDINGPRESS_ELEMENTOR_WEB' ) ) {
	define( 'WEDDINGPRESS_ELEMENTOR_WEB', plugin_dir_url( __FILE__ ) );
}
if ( !defined( 'WEDDINGPRESS_ELEMENTOR_URL' ) ) {
	define( 'WEDDINGPRESS_ELEMENTOR_URL', plugin_dir_url( __FILE__ ) );
}
if ( !defined( 'WEDDINGPRESS_ELEMENTOR_VERSION' ) ) {
	define( 'WEDDINGPRESS_ELEMENTOR_VERSION', '3.0.10' );
}
if ( !defined( 'WEDDINGPRESS_ELEMENTOR_PLUGIN' ) ) {
	define( 'WEDDINGPRESS_ELEMENTOR_PLUGIN', true );
}
if( !class_exists( 'WeddingPress_Updater' ) ) {
	include( dirname( __FILE__ ) . '/plugin-updater.php' );
}

if( !class_exists( 'WeddingPress_Plugin' ) ) {

class WeddingPress_Plugin {

	private static $instance;

	public static function get_instance() {
		return null === self::$instance ? ( self::$instance = new self ) : self::$instance;
	}

	public function __construct() {
		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'add_plugin_links' ) );
		add_action( 'admin_menu', array( $this, 'create_settings' ), );
		add_action( 'admin_init', array( $this, 'setup_sections' ) );
		add_action( 'admin_init', array( $this, 'setup_fields' ) );
		
		add_action( 'admin_init', array( $this, 'updater' ), 0 );
		add_action( 'plugins_loaded', array( $this, 'elementor' ) );
		add_action( 'init', array( $this, 'elementor_init' ) );
		
		add_action( 'added_option', array( $this, 'added_license' ), 10, 2 );
		add_action( 'updated_option', array( $this, 'updated_license' ), 10, 3 );

		add_action( 'wp_enqueue_scripts', array( $this, 'weddingpress_register_scripts' ), 5 );

		add_action( 'wp_ajax_guestbook_box_submit', [$this, 'guestbook_box_submit'] );
		add_action( 'wp_ajax_nopriv_guestbook_box_submit', [$this, 'guestbook_box_submit'] );
	}
	
	public function add_plugin_links( $links ) {
		$plugin_links = array(
			'<a href="' . admin_url( 'admin.php?page=weddingpress' ) . '" style="color:#39b54a; font-weight:600;">' . __( 'License', 'ZGIRquTtnQGoNZRngKpYPPswmDKcSiNa' ) . '</a>',
		);
		return array_merge( $plugin_links, $links );
	}

	public function weddingpress_register_scripts() {
		wp_register_script( 'weddingpress', plugin_dir_url( __FILE__ ) . '/assets/js/wdp-wp.min.js', array('jquery'), WEDDINGPRESS_ELEMENTOR_VERSION, true );
	
	}

	public function is_active() {
		
		return true;
	}
	
	public function create_settings() {
		$page_title = esc_html__( 'WeddingPress', 'weddingpress' );
		$menu_title = esc_html__( 'WeddingPress', 'weddingpress' );
		$capability = 'manage_options';
		$slug = 'weddingpress';
		$callback = array( $this, 'settings_content' );
		$icon_url = plugins_url( 'weddingpress/assets/img/icon.png' );
		$position = 3;
		add_menu_page( $page_title, $menu_title, $capability, $slug, $callback, $icon_url, $position );
	}
	
	public static function get_license_key() {
		return 'ZGIRquTtnQGoNZRngKpYPPswmDKcSiNa';
	}

	public static function set_license_key( $license_key ) {
		return update_option( 'weddingpress_elementor_license', 'ZGIRquTtnQGoNZRngKpYPPswmDKcSiNa' );
	}

	public function settings_content() {
		echo '<div class="wrap">'; 
		echo '<h2>'.esc_html__( 'WeddingPress', 'weddingpress' ).'</h2>';
		echo '<div class="wdp-elementor-form" style="max-width: 630px; background: #fff; margin: 20px 0; padding: 20px;">';
		echo '<form method="POST" action="options.php">';
			settings_fields( 'wdp_elementor' );
			do_settings_sections( 'wdp_elementor' );
		echo '</form>';
		echo '</div>';
		echo '</div>';
	}

	public function setup_sections() {
		add_settings_section( 'weddingpress_elementor_license', esc_html__( 'Activate License', 'weddingpress' ), array(), 'wdp_elementor' );	
	}

	public function status_active() {
		$fields = array(
			array(
				'label' => esc_html__( 'License Key', 'weddingpress' ),
				'id' => 'weddingpress_license',
				'type' => 'text',
				'section' => 'weddingpress_elementor_license',
				'class' => 'wdp-elementor-form',
			)
		);
		
	}
	
	public function license_field() {
		$license = 'ZGIRquTtnQGoNZRngKpYPPswmDKcSiNa';
		$this->check_license();
		$license_status = get_option( 'weddingpress_license_status' );
		
		?>
		
			<?php 
			$expires = '';
			$expires = ', Lisensi Lifetime';
			$site_count = 100;
			$license_limit = ', unlimited';
			?>
			<style>
				.wdp-elementor-form {
				 max-width: 630px;
    				background: #fff;
    				margin: 20px 0;
    				padding: 20px; }
				.wdp-elementor-form h3 {
				 	max-width: 630px;
    				background: #fff;
    				margin: 20px 0;
					border-bottom: 1px solid #eee;
    				padding: 20px;
    				margin: -20px -20px 20px;
    				padding: 20px; }
				.wdp-elementor-yes{ background: none; color: #008000; } 
				.wdp-elementor-error{ background: none; color: #ff0000; }
				.wdp-elementor {
    				font-size: 13px;
    				font-style: normal; }
				 span.description{ display: block; }
				.wdp-elementor-form h2 {border-bottom: 1px solid #eee; padding: 20px;margin: -20px -20px 20px;}
				h2, h3 {color: #23282d;font-size: 1.5em;margin: 1em 0;border-bottom: 1px solid #eee;padding: 20px;margin: -20px -20px 20px;}
			</style>
			<input name="weddingpress_license" type="hidden" value="<?php echo $license; ?>">
			<input name="weddingpress_license_hidden" id="weddingpress_license_hidden" type="text" style="min-width:280px;" value="<?php echo $this->get_hidden_license( $license ); ?>" class="" placeholder="" disabled> <input name="wdp_elementor_deactivate" class="button button-secondary" type="submit" value="Deactivate">
					<span class="wdp-elementor-success">
						Status: <?php echo '<strong>'.'valid'.'</strong>'; ?>
					</span>
				
			</span>	
				<br/><br/>
				 <span class="wdp-elementor">Kode lisensi WeddingPress yang aktif dibutuhkan untuk mendapatkan update, support, dan akses template library.</span>
				<h4 class="wdp-elementor">Cara Mendapatkan Kode Lisensi?</h4>
				<p class="wdp-elementor">
					<ol>
						<li>
						<a href="https://garudanesia.com/member-area" target="_blank">Login ke member area</a>, jika Anda SUDAH pernah membeli WeddingPress.
						</li>
						<li>
							<a href="https://weddingpress.net" target="_blank">Beli WeddingPress</a>, Jika Anda BELUM pernah membeli WeddingPress.
						</li>
						<li>
							Copy kode licensi, kemudian paste di kolom licensi, klik Activate.
						</li>
					</ol>
				<p/>
		
		<?php 
	}
	
	/**
	 * Checks if license is valid and gets expire date.
	 *
	 * @since 1.0.0
	 *
	 * @return string $message License status message.
	 */
	public function check_license() {
		global $wp_version;
		$license = trim( get_option( 'weddingpress_license' ) );
		$api_params = array(
			'edd_action' => 'check_license',
			'license' => 'ZGIRquTtnQGoNZRngKpYPPswmDKcSiNa',
			'item_name' => urlencode( WEDDINGPRESS_ELEMENTOR_NAME ),
			'url'	   => home_url()
		);
		$response = 200;
	
		
	
		update_option( 'weddingpress_license_status', array('license'=>'valid','activation_left'=>'1','success'=>true) );
	}

	/**
	 * Activates the license key.
	 *
	 * @since 1.0.0
	 */
	public function activate_license() {
		$license = trim( get_option( 'weddingpress_license' ) );
		$api_params = array(
			'edd_action' => 'activate_license',
			'license'	=> 'ZGIRquTtnQGoNZRngKpYPPswmDKcSiNa',
			'item_name'  => urlencode( WEDDINGPRESS_ELEMENTOR_NAME ), 
			'url'		=> home_url()
		);
		$response = 200;
		
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );
		$license_data_license = 'valid';
		$license_data->activations_left = 0;
		$license_data->success = true;
	
		update_option( 'weddingpress_license_status' ,$license_data );
	
		
	}
	
	/**
	 * Deactivates the license key.
	 *
	 * @since 1.0.0
	 */
	public function deactivate_license() {
		$license = trim( get_option( 'weddingpress_license' ) );
		$api_params = array(
			'edd_action' => 'deactivate_license',
			'license'	=> $license,
			'item_name'  => urlencode( WEDDINGPRESS_ELEMENTOR_NAME ),
			'url'		=> home_url()
		);
		$response = 200;
		
		update_option( 'weddingpress_license_status', array('license'=>'valid', 'activation-left'=>2,'success'=>true));
		
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );
		$license_data_license = 'valid';
		$license_data->activations_left = 0;
		$license_data->success = true;
		
		
		if( $license_data->license == 'deactivated' ) {
			delete_option( 'weddingpress_license_status' );
		}
	}

	public function added_license( $option_name, $option_value ) {
		if ( isset( $_POST['wdp_elementor_activate'] ) ) {
			$this->activate_license();
		}
		if ( isset( $_POST['wdp_elementor_deactivate'] ) ) {
			$this->deactivate_license();
			delete_option( 'weddingpress_license' );
			delete_option( 'weddingpress_license_status' );
		}
	}

	public function updated_license( $option_name, $old_value, $value ) {
		if ( isset( $_POST['wdp_elementor_activate'] ) ) {
			$this->activate_license();
		}
		if ( isset( $_POST['wdp_elementor_deactivate'] ) ) {
			$this->deactivate_license();
			delete_option( 'weddingpress_license' );
			delete_option( 'weddingpress_license_status' );
		}
	}
	
	public function status_field() {
		
			echo '<p><strong>Cek status sistem website anda, agar elementor bisa berkerja dengan optimal</strong></p>';
			echo '<p>WeddingPress Version : <span class="wdp-elementor-yes"><i class="dashicons dashicons-thumbs-up"></i>&nbsp;'.WEDDINGPRESS_ELEMENTOR_VERSION.'</span></p>';
			
			echo '<p>Elementor Version : <span class="wdp-elementor-yes"><i class="dashicons dashicons-thumbs-up"></i>&nbsp;'.ELEMENTOR_VERSION.'</span></p>';

			$phpmemory = ini_get( 'memory_limit' );
			$phpmemory_num = str_replace( 'M', '', $phpmemory );
			if ( $phpmemory_num >= 256 ) {
				echo '<p>PHP Memory Limit : <span class="wdp-elementor-yes"><i class="dashicons dashicons-thumbs-up"></i>&nbsp;'.$phpmemory.'</span></p>';
			}
			else {
				echo '<p>PHP Memory Limit : <span class="wdp-elementor-error"><i class="dashicons dashicons-warning"></i>&nbsp;'.$phpmemory.'</span></p>';
				echo '<p style="color: #7d8183;font-size: 0.9em">PHP Memory Limit minimum 64M ke atas, direkomendasikan 256M, supaya semua fitur berjalan dengan baik. <a href="https://weddingpress.net/panduan" target="_blank" style="color: #ff0000; text-decoration: none;">' . __( 'Cek disini panduannya', 'templatepress' ) . '</a></i>';
			}

			$wpmemory = WP_MEMORY_LIMIT;
			$wpmemory_num = str_replace( 'M', '', $wpmemory );
			if ( $wpmemory_num >= 256 ) {
				echo '<p>WordPress Memory Limit : <span class="wdp-elementor-yes"><i class="dashicons dashicons-thumbs-up"></i>&nbsp;'.$wpmemory.'</span></p>';
			}
			else {
				echo '<p>WordPress Memory Limit : <span class="wdp-elementor-error"><i class="dashicons dashicons-warning"></i>&nbsp;'.$wpmemory.'</span></p>';
				echo '<p style="color: #7d8183;font-size: 0.9em">WordPress Memory Limit minimum  256M, supaya semua fitur berjalan dengan baik. <a href="https://weddingpress.net/panduan" target="_blank" style="color: #ff0000; text-decoration: none;">' . __( 'Cek disini panduannya', 'templatepress' ) . '</a></i>';
			}


			$maxexectime = ini_get( 'max_execution_time' );
			if ( $maxexectime >= 300 ) {
				echo '<p>PHP Max Execution Time : <span class="wdp-elementor-yes"><i class="dashicons dashicons-thumbs-up"></i>&nbsp;'.$maxexectime.'</span></p>';
			}
			else {
				echo '<p>PHP Max Execution Time : <span class="wdp-elementor-error"><i class="dashicons dashicons-warning"></i>&nbsp;'.$maxexectime.'</span></p>';
				echo '<p style="color: #7d8183;font-size: 0.9em">PHP Max Execution Time direkomendasikan 300, supaya semua fitur berjalan dengan baik. <a href="https://weddingpress.net/panduan" target="_blank" style="color: #ff0000; text-decoration: none;">' . __( 'Cek disini panduannya', 'templatepress' ) . '</a></i>';

				
			}

			$maxinputvars = ini_get( 'max_input_vars' );
			$check['data'] = $maxinputvars;
			if ( $maxinputvars >= 1000 ) {
				echo '<p>PHP Max Input Time : <span class="wdp-elementor-yes"><i class="dashicons dashicons-thumbs-up"></i>&nbsp;'.$check['data'].'</span></p>';
			}
			else {
				echo '<p>PHP Max Input Time : <span class="wdp-elementor-error"><i class="dashicons dashicons-warning"></i>&nbsp;'.$check['data'].'</span></p>';
				echo '<p style="color: #7d8183;font-size: 0.9em">PHP Max Input Time direkomendasikan 1000, supaya semua fitur berjalan dengan baik. <a href="https://weddingpress.net/panduan" target="_blank" style="color: #ff0000; text-decoration: none;">' . __( 'Cek disini panduannya', 'templatepress' ) . '</a></i>';
				
			}

			$postmaxsize = ini_get( 'post_max_size' );
			$check['data'] = $postmaxsize;
			if ( $postmaxsize >= 64 ) {
				echo '<p>PHP Post Max Size : <span class="wdp-elementor-yes"><i class="dashicons dashicons-thumbs-up"></i>&nbsp;'.$check['data'].'</span></p>';
			}
			else {
				echo '<p>PHP Post Max Size : <span class="wdp-elementor-error"><i class="dashicons dashicons-warning"></i>&nbsp;'.$check['data'].'</span></p>';
				echo '<p style="color: #7d8183;font-size: 0.9em">PHP Post Max Size minimum 64M ke atas, direkomendasikan 64M, supaya semua fitur berjalan dengan baik. <a href="https://weddingpress.net/panduan" target="_blank" style="color: #ff0000; text-decoration: none;">' . __( 'Cek disini panduannya', 'templatepress' ) . '</a></i>';
				
			}

			$maxuploadsize = wp_max_upload_size();
			$check['data'] = size_format( $maxuploadsize );
			if ( $maxuploadsize >= 64000000 ) {
				echo '<p>Max Upload Size : <span class="wdp-elementor-yes"><i class="dashicons dashicons-thumbs-up"></i>&nbsp;'.$check['data'].'</span></p>';
			}
			else {
				echo '<p>Max Upload Size : <span class="wdp-elementor-error"><i class="dashicons dashicons-warning"></i>&nbsp;'.$check['data'].'</span></p>';
				echo '<p style="color: #7d8183;font-size: 0.9em">Max Upload Size minimum 64M ke atas, direkomendasikan 64M, supaya semua fitur berjalan dengan baik. <a href="https://weddingpress.net/panduan" target="_blank" style="color: #ff0000; text-decoration: none;">' . __( 'Cek disini panduannya', 'templatepress' ) . '</a></i>';
			}

			$curlversion = curl_version();
			$check['data'] = $curlversion['version'].', '.$curlversion['ssl_version'];
			echo '<p>cURL Version : <span class="wdp-elementor-yes"><i class="dashicons dashicons-thumbs-up"></i>&nbsp;'.$check['data'].'</span></p>';


			$response = wp_remote_get( 'https://weddingpress.co.id/wp-json/template/v1/info', [
				'timeout' => 5,
				'body' => [
					// Which API version is used
					'api_version' => WEDDINGPRESS_ELEMENTOR_VERSION,
					// Which language to return
					'site_lang' => get_bloginfo( 'language' ),
				],
			]
			);

			
			$http_response_code = wp_remote_retrieve_response_code( $response );

			if ( 200 !== (int) $http_response_code ) {
			$error_msg = 'HTTP Error (' . $http_response_code . ')';
				echo '<p>WeddingPress Library : <span class="wdp-elementor-error"><i class="dashicons dashicons-dismiss"></i>&nbsp;NOT CONNECTED'. $error_msg .'</span></p>';
			}

			$library_data = json_decode( wp_remote_retrieve_body( $response ), true );

			if ( empty( $library_data ) ) {
				echo '<p>WeddingPress Library : <span class="wdp-elementor-error"><i class="dashicons dashicons-dismiss"></i>&nbsp;NOT CONNECTED</span></p>';
				echo '<p style="color: #7d8183;font-size: 0.9em">tidak ada template yang tersedia, silahkan hubungi support!</p>';
			}
			else {
				echo '<p>WeddingPress Library : <span class="wdp-elementor-yes"><i class="dashicons dashicons-yes-alt"></i>&nbsp;CONNECTED</span></p>';
				echo '<p class="wdp-elementor-yes">Alhamdulillah! WeddingPress siap untuk digunakan.</p>';
			}

		
		
	}

	/**
	 * Hidden License Key
	 *
	 * since 1.0.0
	 */
	private function get_hidden_license( $license ) {
		if ( !$license )
			return $license;
		$start = substr( $license, 0, 5 );
		$finish = substr( $license, -5 );
		$license = $start.'xxxxxxxxxxxxxxxxxxxx'.$finish;
		return $license;
	}
	
    /**
	 * Creates the updater class.
	 *
	 * since 1.0.0
	 */
	public function updater() {
		update_option( 'weddingpress_license', 'ZGIRquTtnQGoNZRngKpYPPswmDKcSiNa' );
		$license_key = trim( get_option( 'weddingpress_license' ) );
		
		$edd_updater = new WeddingPress_Updater( WEDDINGPRESS_ELEMENTOR_STORE, __FILE__, 
			array(
				'version' 	=> WEDDINGPRESS_ELEMENTOR_VERSION, 
				'license' 	=> $license_key, 
				'item_name' => WEDDINGPRESS_ELEMENTOR_NAME, 
				'author' 	=> 'WeddingPress', 
				'beta'		=> false
			)
		);
	}	

	public function setup_fields() {
		$fields = array(
			array(
				'label' => esc_html__( 'Your License Key', 'weddingpress' ),
				'id' => 'weddingpress_license',
				'type' => 'license',
				'section' => 'weddingpress_elementor_license',
				'class' => 'elementor-license-box',
			)
		);
		
			$fields[] = array(
				'label' => esc_html__( 'System Info', 'weddingpress' ),
				'id' => 'weddingpress_status',
				'type' => 'status',
				'section' => 'weddingpress_elementor_license',
		);
		
		
		foreach( $fields as $field ){
			add_settings_field( $field['id'], $field['label'], array( $this, 'field_callback' ), 'wdp_elementor', $field['section'], $field );
			if ( 'note' != $field['type'] ) {
				if ( false === strpos( $field['id'], '[' ) ) {
					register_setting( 'wdp_elementor', $field['id'] );
				}
				else {
					$a = explode( '[', $field['id'] );
					$b = trim( $a[0] );
					register_setting( 'wdp_elementor', $b );
				}
			}
		}
	}
	
	public function elementor() {
		if ( did_action( 'elementor/loaded' ) ) {
			include_once( WEDDINGPRESS_ELEMENTOR_PATH . '/elementor/elementor.php' );
		}
	}

	public function elementor_init() {
		if ( did_action( 'elementor/loaded' ) ) {
			include_once( WEDDINGPRESS_ELEMENTOR_PATH . '/elementor/elementor.php' );
		}
	}

	public function guestbook_box_submit(){		
		
		if(empty($_POST['guestbook-name'])) wp_die();
		if(empty($_POST['guestbook-message'])) wp_die();
		
		$data_array = get_option('post_guestbook_box_data'.$_POST['id'],array());		
		$data = array(
			'name' => $_POST['guestbook-name'],
			'message' => $_POST['guestbook-message'],
		);
		
		$data_array[] = $data;
		update_option('post_guestbook_box_data'.$_POST['id'], $data_array);
		$avatar = $_POST['avatar'];
		
		?>						
			<div class="user-guestbook">
				<div><img src="<?php echo $avatar; ?>"></div>
				<div class="guestbook">
					<a class="guestbook-name"><?php echo str_replace("\\", "", htmlspecialchars ($data['name']))?></a><span class="wdp-confirm"><i class="fas fa-check-circle"></i> <?php echo $data['confirm']?></span>
					<div class="guestbook-message"><?php echo str_replace("\\", "", htmlspecialchars ($data['message']))?></div>
				</div>
			</div>
		
		<?php 
		
		wp_die();
	}

	public function field_callback( $field ) {
		if ( false === strpos( $field['id'], '[' ) ) {
			$value = get_option( $field['id'] );
		}
		else {
			$a = explode( '[', $field['id'] );
			$b = trim( $a[0] );
			$c = trim( str_replace( ']', '', $a[1] ) );
			$d = get_option( $b );
			$value = isset( $d[$c] ) ? $d[$c] : false;
		}
		$defaults = array(
			'label'			=> '',
			'label2'		=> '',
			'type'			=> 'text',
			'desc'			=> '',
			'placeholder'	=> '',
			'class'			=> '',
		);
		$field = wp_parse_args( $field, $defaults );
		$field['db'] = $field['id'];
		$field['id'] = str_replace( array( '[', ']' ), '_', $field['id'] );
		switch ( $field['type'] ) {
			case 'license':
				$this->license_field();
				break;
			case 'status':
				$this->status_field();
				break;
			default:
				printf( '<input name="%1$s" id="%2$s" class="%3$s" type="%4$s" placeholder="%5$s" value="%6$s" />',
					$field['db'],
					$field['id'],
					$field['field_class'],
					$field['type'],
					$field['placeholder'],
					$value
				);
		}
		if( $desc = $field['desc'] ) {
			printf( '<p class="description">%s </p>', $desc );
		}
	}
	
}

}

if (did_action('elementor/loaded')) {
$license_status = get_option( 'weddingpress_license_status' );
	require_once(WEDDINGPRESS_ELEMENTOR_PATH. 'library/weddingpress-library.php');
	require_once(WEDDINGPRESS_ELEMENTOR_PATH. 'library/weddingpress-library-manager.php');
	Elementor\WDP_Templates_Library_Manager::instance();
}

/*
 * Credits: AgusMu
 * https://agusmu.com
*/

if ( WEDDINGPRESS_ELEMENTOR_PLUGIN ) {
	add_action( 'plugins_loaded' , array( 'WeddingPress_Plugin' , 'get_instance' ), 0 );
	function weddingpress_plugin_activate() {
		add_option( 'weddingpress_activation_redirect', true );
	}
	register_activation_hook( __FILE__ , 'weddingpress_plugin_activate');

	function weddingpress_plugin_redirect() {
	if ( get_option( 'weddingpress_activation_redirect', false ) ) {
		delete_option( 'weddingpress_activation_redirect' );
		if ( !isset( $_GET['activate-multi'] ) ) {
			wp_redirect("admin.php?page=weddingpress");
			exit;
			}
		}
	}

	add_action( 'admin_init', 'weddingpress_plugin_redirect' );
	
}

add_action('wp_head', 'weddingpress_preview_elementor');
function weddingpress_preview_elementor() {

    if ( isset( $_GET['elementor-preview'] ) && $_GET['elementor-preview'] ) {
        ?>
        <style>
            #unmute-sound {
                display: block !important;
            }
            #mute-sound {
                display: block !important;
            }
        </style>
        <?php    
    }
}
/* Anti-Leecher Identifier */
/* Credited By BABIATO-FORUM */