<?php
class Trabajador
{
   private $Nombre;

   private $DNI;

   private $Edad;

   private $Departamento;

   public function getNombre()
   {
      return $this->Nombre;
   }

   public function getDNI()
   {
      return $this->DNI;
   }

   public function getEdad()
   {
      return $this->Edad;
   }

   public function getDepartamento()
   {
      return $this->Departamento;
   }

   public function setNombre(string $Nombre)
   {
      $this->Nombre = $Nombre;

      return $this;
   }

   public function setDNI(string $DNI)
   {
      $this->DNI = $DNI;

      return $this;
   }

   public function setEdad(string $Edad)
   {
      $this->Edad = $Edad;

      return $this;
   }

   public function setDepartamento(string $Departamento)
   {
      $this->Departamento = $Departamento;

      return $this;
   }
}
