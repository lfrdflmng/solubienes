<?php
/*
Plugin Name: Manage Your Posts Only
Version: 0.1
Plugin URI: http://code.mincus.com/41/manage-your-posts-only-in-wordpress/
Description: Makes it so normal users can see only their posts and drafts from the manage posts screen.  Great for multi-user blogs where you want users to only see posts that they have created.  Wordpress already makes it so they cannot edit the posts, but still allows them to see the titles.  This can get annoying to find your posts mixed in with thousands of others.
Author: Allen Holman
Author URI: http://code.mincus.com
*/

function mypo_parse_query_useronly( $wp_query ) {
    if ( strpos( $_SERVER[ 'REQUEST_URI' ], '/wp-admin/edit.php' ) !== false ) {
        if ( !current_user_can( 'level_10' ) ) {
            global $current_user;
            $wp_query->set( 'author', $current_user->id );
        }
    }
}

add_filter('parse_query', 'mypo_parse_query_useronly' );
?>