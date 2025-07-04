<?
class DetallesFactura {
    private $idDetallesFactura;
    private $idFactura;
    private $montoServicio;

    // Métodos para acceder y modificar los atributos
    public function getIdDetallesFactura() { return $this->idDetallesFactura; }
    public function setIdDetallesFactura($idDetallesFactura) { $this->idDetallesFactura = $idDetallesFactura; }

    public function getIdFactura() { return $this->idFactura; }
    public function setIdFactura($idFactura) { $this->idFactura = $idFactura; }

    public function getMontoServicio() { return $this->montoServicio; }
    public function setMontoServicio($montoServicio) { $this->montoServicio = $montoServicio; }
}
?>