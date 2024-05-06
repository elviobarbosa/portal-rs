<?php

namespace Users;

class Data {
    
    public static function getBeneficiarios()  {
        global $wpdb;
        $cfdb_table = $wpdb->prefix."db7_forms";
        $form_id = '15';
        $sql = "SELECT * FROM $cfdb_table WHERE form_post_id = $form_id";
        $sql = $wpdb->prepare($sql);
        $wp_data = $wpdb->get_results($sql);
        return $wp_data;
    }

    public static function getSolicitacoes()  {
        global $wpdb;
        $cfdb_table = $wpdb->prefix."db7_forms";
        $form_id = '24';
        $sql = "SELECT * FROM $cfdb_table WHERE form_post_id = $form_id";
        $sql = $wpdb->prepare($sql);
        $wp_data = $wpdb->get_results($sql);
        return $wp_data;
    }

    public static function getSolicitacoesByEmail($email) {
        global $wpdb;
        $cfdb_table = $wpdb->prefix."db7_forms";
        $user_info = $_SESSION['userData'];
        
        if ($email) {
            $form_id = '24';
            $like = '%"'.$email.'"%';
            $sql = "SELECT * FROM $cfdb_table WHERE form_post_id =$form_id AND form_value LIKE '$like' ";
            $sql = $wpdb->prepare($sql);
            $results = $wpdb->get_results($sql);
            return $results;
        }
        return 'Email não encontrado';
    }
}