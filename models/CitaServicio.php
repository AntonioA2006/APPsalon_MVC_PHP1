<?php
namespace Model;

class CitaServicio extends ActiveRecord{
    protected static $tabla = 'citas_has_servicios';

    protected static $columnasDB = ['id', 'Citas_id', 'Servicios_id'];

    public $id;
    public $Citas_id;
    public $Servicios_id;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->Citas_id = $args['citaId'] ?? '';
        $this->Servicios_id = $args['servicioId'] ?? '';
    }

}