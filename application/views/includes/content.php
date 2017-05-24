<?php
        $this->load->view('includes/header', $title);
        $this->load->view('includes/navi');
        $this->load->view($content);
        $this->load->view('includes/footer');
?>