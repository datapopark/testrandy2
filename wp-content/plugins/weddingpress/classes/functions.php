<?php

/**
 * Helper functions
 *
 * @package Landingku
 */
defined('ABSPATH') || die();

/**
 * Get elementor instance
 *
 * @return \Elementor\Plugin
 */
function wdp_elementor() {
	return \Elementor\Plugin::instance();
}