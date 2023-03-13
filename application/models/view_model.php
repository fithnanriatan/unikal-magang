<?php

class View_model extends CI_Model
{
    public function main_view(
        $data = [],
        $body = 'blank',
        $script = 'blank',

        $header = 'header',
        $footer = 'footer',
        $sidebar = 'sidebar',
        $topbar = 'topbar'
    ) 
    {
        //<< --- Output List View --- >>\\
        $this->load->view('templates/' . $header, $data);
        $this->load->view('templates/' . $sidebar, $data);
        $this->load->view('templates/' . $topbar, $data);
        $this->load->view($body, $data);
        $this->load->view('templates/' . $footer, $data);
        $this->load->view($script, $data);
    }
}
