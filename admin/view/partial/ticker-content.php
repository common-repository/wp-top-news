<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
//print_r( $wtnTickerContentSettings );
foreach ( $wtnTickerContentSettings as $option_name => $option_value ) {
    if ( isset( $wtnTickerContentSettings[$option_name] ) ) {
        ${"" . $option_name} = $option_value;
    }
}
?>
<form name="wtn_general_settings_form" role="form" class="form-horizontal" method="post" action="" id="wtn-general-settings-form">
<?php 
wp_nonce_field( 'wtn_ticker_content_action', 'wtn_ticker_content_nonce_field' );
?>
    <table class="wtn-general-settings">
        <tbody>
        <tr class="wtn_display_ticker_today">
            <th scope="row">
                <label for="wtn_display_ticker_today"><?php 
_e( 'Display Only Todays', 'wp-top-news' );
?></label>
            </th>
            <td>
                <?php 
?>
                    <span><?php 
echo '<a href="' . wtn_fs()->get_upgrade_url() . '">' . __( 'Please Upgrade Now!', 'wp-top-news' ) . '</a>';
?></span>
                    <?php 
?>
            </td>
        </tr>
        <tr class="wtn_ticker_news_number">
            <th scope="row">
                <label><?php 
_e( 'Number of News', 'wp-top-news' );
?></label>
            </th>
            <td>
                <?php 
?>
                    <span><?php 
echo '<a href="' . wtn_fs()->get_upgrade_url() . '">' . __( 'Please Upgrade Now!', 'wp-top-news' ) . '</a>';
?></span>
                    <?php 
?>
            </td>
        </tr>
        <tr class="wtn_ticker_label_text">
            <th scope="row">
                <label><?php 
_e( 'Ticker Label Text', 'wp-top-news' );
?></label>
            </th>
            <td>
                <?php 
?>
                    <span><?php 
echo '<a href="' . wtn_fs()->get_upgrade_url() . '">' . __( 'Please Upgrade Now!', 'wp-top-news' ) . '</a>';
?></span>
                    <?php 
?>
            </td>
        </tr>
        <tr class="wtn_ticker_type">
            <th scope="row">
                <label><?php 
_e( 'Ticker Type', 'wp-top-news' );
?></label>
            </th>
            <td>
                <?php 
?>
                    <span><?php 
echo '<a href="' . wtn_fs()->get_upgrade_url() . '">' . __( 'Please Upgrade Now!', 'wp-top-news' ) . '</a>';
?></span>
                    <?php 
?>
            </td>
        </tr>
        <tr class="wtn_ticker_speed">
            <th scope="row">
                <label><?php 
_e( 'Ticker Speed', 'wp-top-news' );
?></label>
            </th>
            <td>
                <?php 
?>
                    <span><?php 
echo '<a href="' . wtn_fs()->get_upgrade_url() . '">' . __( 'Please Upgrade Now!', 'wp-top-news' ) . '</a>';
?></span>
                    <?php 
?>
            </td>
        </tr>
        <tr class="wtn_ticker_label_icon">
            <th scope="row">
                <label><?php 
_e( 'Ticker Label Icon', 'wp-top-news' );
?></label>
            </th>
            <td>
                <?php 
?>
                    <span><?php 
echo '<a href="' . wtn_fs()->get_upgrade_url() . '">' . __( 'Please Upgrade Now!', 'wp-top-news' ) . '</a>';
?></span>
                    <?php 
?>
            </td>
        </tr>
        <tr class="wtn_ticker_news_icon">
            <th scope="row">
                <label><?php 
_e( 'Ticker News Icon', 'wp-top-news' );
?></label>
            </th>
            <td>
                <?php 
?>
                    <span><?php 
echo '<a href="' . wtn_fs()->get_upgrade_url() . '">' . __( 'Please Upgrade Now!', 'wp-top-news' ) . '</a>';
?></span>
                    <?php 
?>
            </td>
        </tr>
        <tr class="wtn_shortcode">
            <th scope="row">
                <label for="wtn_shortcode"><?php 
_e( 'Shortcode', 'wp-top-news' );
?></label>
            </th>
            <td>
                <input type="text" name="wtn_shortcode" id="wtn_shortcode" class="regular-text" value="[wtn_news_ticker]" readonly />
                <code><?php 
_e( 'Use this shortcode to display ticker news.', 'wp-top-news' );
?></code>
            </td>
        </tr>
        </tbody>
    </table>
    <hr>
    <p class="submit">
        <button id="updateTickerContentSettings" name="updateTickerContentSettings" class="button button-primary wtn-button">
            <i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;<?php 
_e( 'Save Settings', 'wp-top-news' );
?>
        </button>
    </p>
</form>