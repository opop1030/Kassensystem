        <?php
        $this->load->view('includes/header', $title);
        if($status['navi'] === true) { //status[navi] enthält informationen ob eine Navibar benötigt ist oder nicht
                $this->load->view('includes/navi', $status);
        }
        $this->load->view($content);
        $this->load->view('includes/footer');
        ?>