<?php
class Trabajador
{
    private $Nombre;

    private $DNI;

    private $Edad;

    private $Departamento;

    public function __construct($Nombre, $DNI, $Edad, $Departamento)
    {
        $this->Nombre = $Nombre;
        $this->DNI = $DNI;
        $this->Edad = $Edad;
        $this->Departamento = $Departamento;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->Nombre;
    }

    /**
     * @param mixed $Nombre
     */
    public function setNombre($Nombre)
    {
        $this->Nombre = $Nombre;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDNI()
    {
        return $this->DNI;
    }

    /**
     * @param mixed $DNI
     */
    public function setDNI($DNI)
    {
        $this->DNI = $DNI;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEdad()
    {
        return $this->Edad;
    }

    /**
     * @param mixed $Edad
     */
    public function setEdad($Edad)
    {
        $this->Edad = $Edad;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDepartamento()
    {
        return $this->Departamento;
    }

    /**
     * @param mixed $Departamento
     */
    public function setDepartamento($Departamento)
    {
        $this->Departamento = $Departamento;
        return $this;
    }


}

