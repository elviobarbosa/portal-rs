<?php

namespace Communs;

class Utils {
    public static function isProtectedPage() {
        return is_page( array('solicitar-ajuda', 'minhas-solicitacoes') );
    }

}