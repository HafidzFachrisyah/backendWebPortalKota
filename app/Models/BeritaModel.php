<?php
namespace App\Models;

use CodeIgniter\Model;

class BeritaModel extends Model
{
    protected $table      = 't_berita';
    protected $primaryKey = 'beritaId';

    protected $useAutoIncrement = true;

    protected $useTimestamps = false;

}