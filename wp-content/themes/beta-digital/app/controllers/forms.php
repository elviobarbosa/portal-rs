<?php

namespace Forms;

class Controller {

    private static function randomCode() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $randomCode = substr(str_shuffle(str_repeat($alphabet, 10)), 0, 10);
        return $randomCode;
    }

    public static function formID($title) {
        $post_id = get_page_by_title($title, OBJECT, 'wpcf7_contact_form');
        return $post_id->ID;
    }

    public static function formVoluntarioID() {
        return self::formID('Voluntário');
    }

    public static function formBeneficiarioID() {
        return self::formID('Beneficiário');
    }

    public static function formDoacaoID() {
        return self::formID('Solicitar doação');
    }

    public static function createCodeValidator($email, $type, $form_id) {
    
        if (isset($email)) {
            global $wpdb;
            $table_name = CONFIRMADO_TABLE;
            $existing_user = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE email = %s", $email));

            if ($existing_user) {
                $code = $existing_user->codigo;
                $confirmed = $existing_user->confirmado == 1;

                if ($confirmed) {
                    return array('success' => true, 'title'=>'Voluntário ja confirmado', 'message' => 'Seu email já foi confirmado');
                };

                $send = self::sendCode($email, $code, $type);
                if ($send) {
                    return array('success' => $send, 'title'=>'Confirme seu email', 'message' => 'Enviamos um email para confirmar o cadastro.');
                } else {
                    return array('success' => $send, 'title'=>'Ops, houve um erro no envio do email.', 'message' => $send);
                }
            } else {
                $code = self::randomCode();
                $result = $wpdb->insert($table_name, array(
                    'email' => $email,
                    'codigo' => $code,
                    'tipo' => $type,
                    'form_id' => $form_id
                    
                ), array(
                    '%s',
                    '%s',
                    '%s',
                    '%d'
                ));

                if(!$result) {
                    return $wpdb->last_error;
                }

                $send = self::sendCode($email, $code, $type);

                if ($send) {
                    return array('success' => $send, 'title'=>'Confirme seu email', 'message' => 'Enviamos um email para confirmar o cadastro.');
                } else {
                    return array('success' => $send, 'title'=>'Ops, houve um erro no envio do email.',  'message' => $send);
                }
            }
        }
    }

    public static function confirmUser($email, $code) {
    
        if (isset($email)) {
            global $wpdb;
            $table_name = CONFIRMADO_TABLE;
            $existing_user = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE email = %s AND codigo = %s", $email, $code));

            if ($existing_user) {
                $user_id = $existing_user->id;
                $wpdb->update(
                    $table_name,
                    array('confirmado' => 1),
                    array('email' => $email, 'codigo' => $code),
                    array('%d'),
                    array('%s', '%s')
                );
        
                
                return array('success' => true, 'title'=>'Email confirmado', 'message' => 'Seu email foi confirmado com sucesso.');
                
            } else {
                return array('success' => $send, 'title'=>'Ops, houve um erro.',  'message' => $send);
            }
        }
    }

    public static function createWPUser($email, $role) {
        $user_id = username_exists( $username );

        if ( $user_id ) {
            return $user_id;
        } else {

            global $wpdb;
            $cfdb_table = $wpdb->prefix."db7_forms";
            
            $form_id = '15';
            $like = '%"'.$email.'"%';
            $sql = "SELECT * FROM $cfdb_table WHERE form_post_id =$form_id AND form_value LIKE '$like' ";
            $sql = $wpdb->prepare($sql);
            $results = $wpdb->get_results($sql);
            $user_data = unserialize($results[0]->form_value);
            $user_id = wp_create_user($user_data['email'], $user_data['password'], $user_data['email']);
            $user = get_user_by('ID', $user_id);
            $user->remove_all_caps();
            $user->add_role($role);
            wp_update_user($user);
            return $user_id;
        }
        
    }
    

    private static function sendCode($email, $code, $type) {
        $subject = 'Seu código de confirmação';
        $body = 'Clique no link abaixo para confirmar seu cadastro.<br><br>'. get_bloginfo('wpurl').'/confirmar-'. $type .'?email='.$email.'&code='.$code;

        $headers = array('Content-Type: text/html; charset=UTF-8', 'From: noreply@portalsosrs.com.br' );
        $send = wp_mail($email, $subject, $body, $headers);

        if ( $send ) {
            return true;
        } else {
            return wp_mail_smtp()->get_logs()->get_last_error();
        }
    }

    
}