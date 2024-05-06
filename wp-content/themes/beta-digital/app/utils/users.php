<?php
namespace Users;

$controller_file = __DIR__ .'/../controllers/forms.php';
require_once $controller_file;
Data::$formVoluntarioID = \Forms\Controller::formVoluntarioID();
Data::$formBeneficiarioID = \Forms\Controller::formBeneficiarioID();
Data::$formDoacaoID = \Forms\Controller::formDoacaoID();

class Data {
    public static $formVoluntarioID;
    public static $formBeneficiarioID;
    public static $formDoacaoID;
    public static function getBeneficiarios()  {
        global $wpdb;
        $cfdb_table = $wpdb->prefix."db7_forms";
        $form_id = '15';
        $sql = "SELECT * FROM $cfdb_table WHERE form_post_id = $form_id";
        $sql = $wpdb->prepare($sql);
        $wp_data = $wpdb->get_results($sql);
        return $wp_data;
    }

    public static function getVoluntarios()  {
        global $wpdb;
        $cfdb_table = CFDB_TABLE;
        $confirmado_table = CONFIRMADO_TABLE;

        $results_per_page = PER_PAGE;
        $current_page = max(1, get_query_var('paged'));
        $offset = ($current_page - 1) * $results_per_page;

        $form_id = self::$formVoluntarioID;
    
        $sql = $wpdb->prepare("
            SELECT c.* 
            FROM $confirmado_table v 
            JOIN $cfdb_table c ON v.form_id = c.form_id 
            WHERE form_post_id = %d AND v.confirmado = 1
            LIMIT %d OFFSET %d
        ", $form_id, $results_per_page, $offset);
        $wp_data = $wpdb->get_results($sql);
        $total_results = $wpdb->get_var("SELECT COUNT(*) FROM $confirmado_table WHERE confirmado = 1 AND tipo = 'voluntario'");
        return Array('data' => $wp_data, 'total' => $total_results, 'current_page' => $current_page);
    }

    public static function getVoluntarioByEmail($email) {
        global $wpdb;
        $cfdb_table = CFDB_TABLE;
    
        if ($email) {
            $form_id = self::$formVoluntarioID;
            $like = '%"'.$email.'"%';
            $sql = "SELECT * FROM $cfdb_table WHERE form_post_id =$form_id AND form_value LIKE '$like' ";
            $sql = $wpdb->prepare($sql);
            $results = $wpdb->get_results($sql);
            return $results;
        }
        return 'Email não encontrado';
    }

    public static function getBeneficiarioByEmail($email) {
        global $wpdb;
        $cfdb_table = CFDB_TABLE;
    
        if ($email) {
            $form_id = self::$formBeneficiarioID;
            $like = '%"'.$email.'"%';
            $sql = "SELECT * FROM $cfdb_table WHERE form_post_id =$form_id AND form_value LIKE '$like' ";
            $sql = $wpdb->prepare($sql);
            $results = $wpdb->get_results($sql);
            return $results;
        }
        return 'Email não encontrado';
    }

    public static function getSolicitacoes()  {
        global $wpdb;
        $cfdb_table = CFDB_TABLE;
        $form_id = self::$formDoacaoID;
        //$sql = "SELECT * FROM $cfdb_table WHERE form_post_id = %d";

        $results_per_page = PER_PAGE;
        $current_page = max(1, get_query_var('paged'));
        $offset = ($current_page - 1) * $results_per_page;

        $total_results = $wpdb->get_var("SELECT COUNT(*) FROM $cfdb_table WHERE form_post_id = $form_id");

        $sql = $wpdb->prepare("
            SELECT * FROM $cfdb_table WHERE form_post_id = %d
            LIMIT %d OFFSET %d
        ", $form_id, $results_per_page, $offset);

        $sql = $wpdb->prepare($sql);
        $wp_data = $wpdb->get_results($sql);
        return Array('data' => $wp_data, 'total' => $total_results, 'current_page' => $current_page);;
    }

    public static function getSolicitacoesByEmail($email) {
        global $wpdb;
        $cfdb_table = CFDB_TABLE;
        $user_info = $_SESSION['userData'];
        
        if ($email) {
            $form_id = self::$formDoacaoID;;
            $like = '%"'.$email.'"%';

            $results_per_page = PER_PAGE;
            $current_page = max(1, get_query_var('paged'));
            $offset = ($current_page - 1) * $results_per_page;
            $total_results = $wpdb->get_var("SELECT COUNT(*) FROM $cfdb_table WHERE form_post_id =$form_id AND form_value LIKE '$like'");

            $sql = "SELECT * FROM $cfdb_table WHERE form_post_id =$form_id AND form_value LIKE '$like' LIMIT $results_per_page OFFSET $offset";
            $sql = $wpdb->prepare($sql);
            $results = $wpdb->get_results($sql);
            return Array('data' => $results, 'total' => $total_results, 'current_page' => $current_page);
        }
        return 'Email não encontrado';
    }

    public static function getSolicitacaoByID($id) {
        global $wpdb;
        $cfdb_table = CFDB_TABLE;
        
        if ($id) {
            $form_id = self::$formDoacaoID;;
            $sql = "SELECT * FROM $cfdb_table WHERE form_id = $id";
            $sql = $wpdb->prepare($sql);
            $results = $wpdb->get_results($sql);
            return $results[0]->form_value;
        }
        return 'ID não encontrado';
    }
}