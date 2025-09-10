<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Purchase_orders_model extends MY_Model
{
    // Tentukan tabel
    protected $table = 'purchase_orders';
    // Tentukan kolom untuk pencarian
    protected $searchable_columns = [];
    // Tentukan tabel detail
    protected $detail_table = 'purchase_order_details';
    // Tentukan kolom foreign key
    protected $foreign_key = 'id_po';
}

