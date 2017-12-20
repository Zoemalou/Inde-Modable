<?php

/**
 * @package SteamSpy
 */
class SteamSpy_Widget extends WP_Widget {

  const API_URL = 'http://steamspy.com/api.php';

  /**
   * SteamSpy constructor.
   */
  function __construct() {
    parent::__construct( 'steamspy_widget',
    __( 'SteamSpy Widget', 'steamspy' ),
    array( 'description' => __( 'Displays information about games on Steam from SteamSpy.' , 'steamspy' ) ) );
  }

  /**
   * Displays the widget.
   *
   * @param array $args
   *   Widgets arguments provided by WordPress.
   * @param array $instance
   *   Configuration information for this widget.
   */
  function widget( $args, $instance ) {
    echo $args['before_widget'];

    echo '<h2 class="widget-title">Top Ten Games on Steam</h2>';

    $games = $this->get_top_steam_games(10);

    if ( !empty( $games ) ) {
      echo '<ul>';
      foreach ( $games as $game ) {
        echo '<li><a href="http://store.steampowered.com/app/' . $game->appid . '" target="_blank">' . $game->name . '</a>';
      }
      echo '</ul>';
    }

    echo $args['after_widget'];
  }

  /**
   * Gets the top selling games on Steam over the past two weeks.
   *
   * @param int $limit
   *   The number of games to get. Maximum of 100.
   *
   * @return array
   *   Array of game objects.
   *   For structure, see: http://steamspy.com/api.php
   */
  function get_top_steam_games( $limit = 100 ) {
    $response = wp_remote_get( self::API_URL . '?request=top100in2weeks' );

    if ( is_array( $response ) ) {
      $results = ( array ) json_decode( $response['body'] );
      return array_slice( $results, 0, $limit );
    }

    return NULL;
  }

}

/**
 * Registers the widget.
 */
function steamspy_register_widgets() {
  register_widget( 'SteamSpy_Widget' );
}

add_action( 'widgets_init', 'steamspy_register_widgets' );
