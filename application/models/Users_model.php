<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users_model extends MY_Model
{
    protected $table = 'users';

    // Tentukan kolom untuk pencarian
    protected $searchable_columns = ['username'];
}
