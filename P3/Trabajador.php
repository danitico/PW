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
     * @return string
     */
    public function getNombre()
    {
        return $this->Nombre;
    }

    /**
     * @param string $Nombre
     * @return Trabajador
     */
    public function setNombre($Nombre)
    {
        $this->Nombre = $Nombre;
        return $this;
    }

    /**
     * @return string
     */
    public function getDNI()
    {
        return $this->DNI;
    }

    /**
     * @param string $DNI
     * @return Trabajador
     */
    public function setDNI(string $DNI)
    {
        $this->DNI = $DNI;
        return $this;
    }

    /**
     * @return int
     */
    public function getEdad()
    {
        return $this->Edad;
    }

    /**
     * @param int $Edad
     * @return Trabajador
     */
    public function setEdad(int $Edad)
    {
        $this->Edad = $Edad;
        return $this;
    }

    /**
     * @return string
     */
    public function getDepartamento()
    {
        return $this->Departamento;
    }

    /**
     * @param string $Departamento
     * @return Trabajador
     */
    public function setDepartamento(string $Departamento)
    {
        $this->Departamento = $Departamento;
        return $this;
    }
}
