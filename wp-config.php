<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en « wp-config.php » et remplir les
 * valeurs.
 *
 * Ce fichier contient les réglages de configuration suivants :
 *
 * Réglages MySQL
 * Préfixe de table
 * Clés secrètes
 * Langue utilisée
 * ABSPATH
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'assises_bd' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', 'Dsi@2022' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define( 'DB_COLLATE', '' );

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'mdsys)$ke1|c#Wd1WPC7VRBq1pS3$[`aUl 7z ul~IE[Qi]FlT2d99>J&gk#Um[~' );
define( 'SECURE_AUTH_KEY',  '-=W>~G5_-e#_q!w_*KBgUSFqi21}wrWy/h^xf?BD{>C;(D{)9OFt`1&)KpXYZTH' );
define( 'LOGGED_IN_KEY',    'gF,E^ni= 5Cw$2jDavAR?,(icy6FMq+p30glOo<uLUlGi95 ;&4[ ]67>xvai6nw' );
define( 'NONCE_KEY',        'ixZuU[@cs@St8Y(be+ub,6#k.CcRFSwE3hhXuPpb:0[XMyzq/,~e{E[AU{XN2rb1' );
define( 'AUTH_SALT',        'Z. >/!q[{Cb_qDtX3}C&A{t9SnaJ^!+s .[@X86_?2Wg-nvj82A,7D(fJjfDTLI|' );
define( 'SECURE_AUTH_SALT', 'iT,kn2wr 9JYm|h.Ss|jUY4-Y|=^d[K0-t0Q^`[ Q`#E#/9#UD.!*q1RP(_yQSfw' );
define( 'LOGGED_IN_SALT',   'daAn!LabW8Ha4Nq$NLBCnW=jW7;{~CdDB81K]:J+iJ&3oE[ZaEU+]B@9##T;}}K-' );
define( 'NONCE_SALT',       'ek?>1FY)h(t_f}t_+U,o^;|@4gc77)61=ncAdKYoe}7skzA]r@Fh$MQg`c9O>h1q' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( ! defined( 'ABSPATH' ) )
  define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once( ABSPATH . 'wp-settings.php' );
//define('WP_MEMORY_LIMIT', '128M');
