<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Machines_model extends MY_Model
{
    protected $table = 'machines';

    // Tentukan kolom untuk pencarian
    protected $searchable_columns = [];
}
