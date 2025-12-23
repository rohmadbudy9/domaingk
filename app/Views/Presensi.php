<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Presensi extends CI_Controller
{
    public function index($devid = null)
    {
        if (!$devid) show_404();
        $data['devid'] = $devid;
        $this->load->view('presensi_view', $data);
    }
}
