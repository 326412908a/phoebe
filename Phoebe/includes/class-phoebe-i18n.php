<?php


class Phoebe_i18n {

	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'phoebe',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
