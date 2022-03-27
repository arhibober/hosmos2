<?php
/**
 * Основные параметры WordPress.
 *
 * Этот файл содержит следующие параметры: настройки MySQL, префикс таблиц,
 * секретные ключи, язык WordPress и ABSPATH. Дополнительную информацию можно найти
 * на странице {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Кодекса. Настройки MySQL можно узнать у хостинг-провайдера.
 *
 * Этот файл используется сценарием создания wp-config.php в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать этот файл
 * с именем "wp-config.php" и заполнить значения.
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'hosmos2');

/** Имя пользователя MySQL */
define('DB_USER', 'root');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется снова авторизоваться.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '-~f.v}s8V5wv|r}GW#_m^u/7M3|a-rWATI0[.jIra<j?;}Ae(~UK7m,$,]LMP[0e');
define('SECURE_AUTH_KEY',  '}aDJw3@cNIe.Qq[{Z]&JU^s&]S3V0f^ivpG:{E9&Fs+T{rf]H^rT2~]@HvDm|P}q');
define('LOGGED_IN_KEY',    'EelRud|5 ~BwcA/X@BJcfy*P(wdiu6COu#m~8q3F}_-#<DxkbX2_|,Ih(8$/+~m`');
define('NONCE_KEY',        '2#]c4a<z/dR];%-E)^Qra)+#3gHB_1#U+jMB*2R&ul2CMm.fkV!t/2^> P0|PRh9');
define('AUTH_SALT',        '`Z7$HMyaGLZY3{W3S9==r%osC|+hux1kp|fh h1{7b>rK{Hb g$kyLhm<fU)Y!b_');
define('SECURE_AUTH_SALT', 'a{FV;MO/mF9}!As$Ej3hTVq6/SX@+C{ri@:s PTheSs46|S)nWV9(pFrMThac]T@');
define('LOGGED_IN_SALT',   'vu5,F_]SI#*PxX(qE`R%xtNlN4V<hQ+*97&]TR=gPOJ|s.NHFJPh!_;i%>9=p^hM');
define('NONCE_SALT',       'sx,QCsE[^et|c?74o>_ti14 :^Ji9g{SZC3OL3N-{B@+ e1})xZm*|EZ1gJoBRDU');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько блогов в одну базу данных, если вы будете использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Язык локализации WordPress, по умолчанию английский.
 *
 * Измените этот параметр, чтобы настроить локализацию. Соответствующий MO-файл
 * для выбранного языка должен быть установлен в wp-content/languages. Например,
 * чтобы включить поддержку русского языка, скопируйте ru_RU.mo в wp-content/languages
 * и присвойте WPLANG значение 'ru_RU'.
 */
define('WPLANG', 'ru_RU');

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Настоятельно рекомендуется, чтобы разработчики плагинов и тем использовали WP_DEBUG
 * в своём рабочем окружении.
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
