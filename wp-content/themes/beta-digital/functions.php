<?php
define("URLTEMA", get_bloginfo("template_url"));
define("RESOURCES", get_bloginfo("template_url") . "/resources/");
define("IMGPATH", RESOURCES . "/images/");
define("SVGPATH", IMGPATH . "/svg/");
define("WHASTSAPP", '(85) 99194-2140');
define("WHATSAPP_LINK", 'https://api.whatsapp.com/send?phone=5585991942140&text=Olá estou intressado em um imóvel, você pode me ajudar?');
define("CFDB_TABLE", $wpdb->prefix."db7_forms");
define("CONFIRMADO_TABLE", $wpdb->prefix."confirmado");
define("PER_PAGE", 10);
add_filter('show_admin_bar', '__return_false');

require_once 'app/admin.php';
require_once 'app/config.php';
require_once 'app/utils.php';
require_once 'app/ajax.php';
require_once 'app/enqueue.php';
require_once 'app/cpt.php';
require_once 'app/members.php';


