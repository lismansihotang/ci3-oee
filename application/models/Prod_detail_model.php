<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prod_detail_model extends MY_Model
{
    protected $table = 'prod_detail';

    // Tentukan kolom untuk pencarian
    protected $searchable_columns = [];
}
