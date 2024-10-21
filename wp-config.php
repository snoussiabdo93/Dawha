<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'Dawha3' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost:3308' );

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
define( 'AUTH_KEY',         'uZCV4o0?9rb:5u]?}1xu)d||)PT)0-_*7}LS>u8aY>ohz.pGodpm5:Et7w`P$h(n' );
define( 'SECURE_AUTH_KEY',  '^EhO>errNy|pqR.j`:|&,DB<#l~!N35-KD9TY>~&JBAt9-,xX`[^I%eS,~zj2[]U' );
define( 'LOGGED_IN_KEY',    'O-xz#-r3eZ9`dIiRk3m[VVUH+.kKZ.zzq!t,L+3O9C%90S%?_rGP%]#YtMTa4-pO' );
define( 'NONCE_KEY',        'U|rK O{kk8@My|S%nZH(87A5^bon&[F.ez^SyWi!5/#=l%q2NCy*rJCivB.]?IA)' );
define( 'AUTH_SALT',        '8(cMvj^cjfQL?lR2o[aD x)5~F#_+?FGkKlN^KomsO/<)izk6HoYa&6-x(|Aia*2' );
define( 'SECURE_AUTH_SALT', '*L;M?/_Y3o<I&JR>mJ2-GY<GrZ8O;U?J+xF`B>Cs|^-6hT<.?w$5SZ9Ve>6lO2-]' );
define( 'LOGGED_IN_SALT',   'Qt otr(0XDV:g7d~d.p%<7vbk]79:s<d<(/FixKe5BfTzEloH@0DH>-za,~FOE(;' );
define( 'NONCE_SALT',       '}df/}+tx|{YHv0H>rTh~74o; idPgRTmXeqUQVsnm(QZf4zNXFq(i1M$2di`.Ln*' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
