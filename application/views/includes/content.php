        <?php
        $this->load->view('includes/header', $title);
        if($status['navi'] === true) { //status[navi] enth�lt informationen ob eine Navibar ben�tigt ist oder nicht
                $this->load->view('includes/navi', $status);
        }
        $this->load->view($content);
        $this->load->view('includes/footer');
        ?>