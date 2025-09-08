<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materials_model extends MY_Model
{
    protected $table = 'materials';

    // Tentukan kolom untuk pencarian
    protected $searchable_columns = [];
}
