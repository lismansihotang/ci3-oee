<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prod_downtime_model extends MY_Model
{
    protected $table = 'prod_downtime';

    // Tentukan kolom untuk pencarian
    protected $searchable_columns = [];
}
