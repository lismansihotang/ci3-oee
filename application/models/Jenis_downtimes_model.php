<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_downtimes_model extends MY_Model
{
    protected $table = 'jenis_downtimes';

    // Tentukan kolom untuk pencarian
    protected $searchable_columns = ['kode', 'nama'];
}
