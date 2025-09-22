<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prod_qc_model extends MY_Model
{
    protected $table = 'prod_qc';

    // Tentukan kolom untuk pencarian
    protected $searchable_columns = [];
}
