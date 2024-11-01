<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$wtnTickerContentSettings = $this->wtn_int_get_ticker_content_settings();

//print_r( $wtnTickerContentSettings );
foreach ( $wtnTickerContentSettings as $option_name => $option_value ) {
    if ( isset( $wtnTickerContentSettings[$option_name] ) ) {
        ${"" . $option_name}  = $option_value;
    }
}

$wtnTickerStylesSettings = $this->wtn_int_get_ticker_styles_settings();
//print_r( $wtnTickerStylesSettings );
foreach ( $wtnTickerStylesSettings as $option_name_s => $option_value_s ) {
    if ( isset( $wtnTickerStylesSettings[$option_name_s] ) ) {
        ${"" . $option_name_s}  = $option_value_s;
    }
}

$wtn_category           = isset( $wtnAttr['category'] ) ? $wtnAttr['category'] : '';
$wtn_ticker_type        = isset( $wtnAttr['ticker_type'] ) ? $wtnAttr['ticker_type'] : $wtn_ticker_type;
$wtn_ticker_news_number = isset( $wtnAttr['news_number'] ) ? $wtnAttr['news_number'] : $wtn_ticker_news_number;
$wtn_w_rss_url			= isset( $wtnAttr['url'] ) ? sanitize_url( $wtnAttr['url'] ) : '';

if ( 'marquee' === $wtn_ticker_type ) {
    $wtn_ticker_speed = ( $wtn_ticker_speed_marquee / 100 );
}

if ( 'horizontal' === $wtn_ticker_type ) {
    $wtn_ticker_speed = $wtn_ticker_speed_horizontal;
}

if ( 'typewriter' === $wtn_ticker_type ) {
    $wtn_ticker_speed = $wtn_ticker_speed_typewriter;
}

if ( 'vertical' === $wtn_ticker_type ) {
    $wtn_ticker_speed = $wtn_ticker_speed_vertical;
}

// Load Styling
include WTN_PATH . 'assets/css/ticker.php';
?>