<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'photofolio' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'oZ-p52gIY6$$e&lS([ol|Q[<uo 9BnD;PEM!AUYi9r]G}Z,2XpPzUfW^J`hana12' );
define( 'SECURE_AUTH_KEY',  ':@YWfZT*0%/G;wq6Ct*A):7:U6-7cGiU({=@ Z=MW}:PcogSM/ywb34XmybyHsLr' );
define( 'LOGGED_IN_KEY',    'k.o!yE<e.hS,h}U]+~>6LElL3x2{DRNc>WfG3A7y=Dpql(V/WDT`~)$UZa;/q-Pq' );
define( 'NONCE_KEY',        '2z`emX|7CAg2_)/|bIvb;rKopq}MLb_ajC:3Mo;n1kpj =h<_J:3W<t&Dr<I9`n&' );
define( 'AUTH_SALT',        'm-ox=6-7V%dN/Vx+2<CA:a:SP7^`_}VW9wg~{j3FKrhO4+;`f.13Ftm,IJ3V)Hdv' );
define( 'SECURE_AUTH_SALT', 'w[ymS0ocHB;=eq$I:vOia(;}#[ {x5yi-0&Vd;.Z2N=!JYT/,_OP8?|s0 p,e4@V' );
define( 'LOGGED_IN_SALT',   '<dr7:[3${O/Y{p,Ljt@6*F6t~Y~O^Hus>OasEKJx2dbxJ7Ww{VXs]qHfj1iPrVL)' );
define( 'NONCE_SALT',       'ahY;/)bv&L}WM?t *!gN?TG0(Zi+i1en-]6UI4A|[BbnjJ+$uphJqXBU1jzfa;s(' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
