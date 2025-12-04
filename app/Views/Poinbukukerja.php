<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Poinbukukerja extends CI_Controller
{
    public function index()
    {
        $this->load->view('poinbukukerja_view'); // ✅ benar
    }
}
