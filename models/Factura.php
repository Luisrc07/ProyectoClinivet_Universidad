<?
class Factura {
    private $idFactura;
    private $montoTotal;
    private $fecha;

    // Métodos para acceder y modificar los atributos
    public function getIdFactura() { return $this->idFactura; }
    public function setIdFactura($idFactura) { $this->idFactura = $idFactura; }

    public function getMontoTotal() { return $this->montoTotal; }
    public function setMontoTotal($montoTotal) { $this->montoTotal = $montoTotal; }

    public function getFecha() { return $this->fecha; }
    public function setFecha($fecha) { $this->fecha = $fecha; }
}
?>