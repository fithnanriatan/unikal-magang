<?php

class Flash_model extends CI_Model {

    public function flash_login( $type, $message )
    {
        $this->session->set_flashdata(
            'validasi-login',
            '<div class="alert alert-'.$type.'" role="alert">
                '.$message.'
            </div>'
        );
    }

}