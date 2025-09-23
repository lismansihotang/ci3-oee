<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products_model extends MY_Model
{
    protected $table = 'products';

    // Tentukan kolom untuk pencarian
    protected $searchable_columns = [];
}
