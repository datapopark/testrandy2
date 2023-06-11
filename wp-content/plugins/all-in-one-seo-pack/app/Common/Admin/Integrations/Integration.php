<?php
namespace AIOSEO\Plugin\Common\Admin\Integrations;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Integrate our SEO Panel with Page Builders.
 *
 * @since 4.1.7
 */
abstract class Integration {
	/**
	 * The plugin files we can integrate with.
	 *
	 * @since 4.1.7
	 *
	 * @var array
	 */
	public $plugins = [];

	/**
	 * The themes names we can integrate with.
	 *
	 * @since 4.1.7
	 *
	 * @var array
	 */
	public $themes = [];

	/**
	 * The integration slug.
	 *
	 * @since 4.1.7
	 *
	 * @var string
	 */
	public $integrationSlug = '';

	/**
	 * Class constructor.
	 *
	 * @since 4.1.7
	 *
	 * @return void
	 */
	public function __construct() {
		// We need to delay it to give other plugins a chance to register custom post types.
		add_action( 'init', [ $this, '_init' ], PHP_INT_MAX );
	}

	/**
	 * The internal init function.
	 *
	 * @since 4.1.7
	 *
	 * @return void
	 */
	public function _init() {
		// Check if we do have an integration slug.
		if ( empty( $this->integrationSlug ) ) {
			return;
		}

		// Check if the plugin or theme to integrate with is active.
		if ( ! $this->isPluginActive() && ! $this->isThemeActive() ) {
			return;
		}

		// Check if we can proceed with the integration.
		if ( apply_filters( 'aioseo_page_builder_integration_disable', false, $this->integrationSlug ) ) {
			return;
		}

		$this->init();
	}

	/**
	 * The init function.
	 *
	 * @since 4.1.7
	 *
	 * @return void
	 */
	public function init() {}

	/**
	 * Check whether or not the plugin is active.
	 *
	 * @since 4.1.7
	 *
	 * @return boolean Whether or not the plugin is active.
	 */
	public function isPluginActive() {
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

		foreach ( $this->plugins as $basename ) {
			if ( is_plugin_active( $basename ) ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Check whether or not the theme is active.
	 *
	 * @since 4.1.7
	 *
	 * @return boolean Whether or not the theme is active.
	 */
	public function isThemeActive() {
		$theme = wp_get_theme();
		foreach ( $this->themes as $name ) {
			if ( $name === $theme->stylesheet || $name === $theme->template ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Enqueue the scripts and styles.
	 *
	 * @since 4.1.7
	 *
	 * @return void
	 */
	public function enqueue() {
		aioseo()->helpers->enqueueChunkedAssets( $this->integrationSlug );
		aioseo()->helpers->enqueueScript(
			'aioseo-' . $this->integrationSlug,
			'js/' . $this->integrationSlug . '.js'
		);
		wp_localize_script(
			'aioseo-' . $this->integrationSlug,
			'aioseo',
			aioseo()->helpers->getVueData( 'post', $this->getPostId(), $this->integrationSlug )
		);
		wp_localize_script(
			'aioseo-' . $this->integrationSlug,
			'aioseoTranslations',
			[
				'translations' => aioseo()->helpers->getJedLocaleData( 'all-in-one-seo-pack' )
			]
		);

		$rtl = is_rtl() ? '.rtl' : '';
		aioseo()->helpers->enqueueStyle(
			'aioseo-' . $this->integrationSlug . '-integrations',
			"css/aioseo-integrations$rtl.css",
			false
		);
	}

	/**
	 * Get the post ID.
	 *
	 * @since 4.1.7
	 *
	 * @return int|null The post ID or null.
	 */
	public function getPostId() {
		if ( ! empty( $_GET['id'] ) ) {
			return (int) $_GET['id'];
		}

		if ( ! empty( $_GET['post'] ) ) {
			return (int) $_GET['post'];
		}

		if ( ! empty( $GLOBALS['post'] ) ) {
			return (int) $GLOBALS['post']->ID;
		}

		return null;
	}

	/**
	 * Returns whether or not the given Post ID was built with the Page Builder.
	 *
	 * @since 4.1.7
	 *
	 * @param  int $postId The Post ID.
	 * @return boolean     Whether or not the Post was built with the Page Builder.
	 */
	public function isBuiltWith( $postId ) { // phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable
		return false;
	}
}