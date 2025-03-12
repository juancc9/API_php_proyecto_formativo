<?php
require_once "./controllers/Trazabilidad/tipoPlagaController.php";
require_once "./controllers/Trazabilidad/tipoResiduoController.php";
require_once "./controllers/Trazabilidad/tipoEspecieController.php";
require_once "./controllers/Trazabilidad/tipoControlController.php";
require_once "./controllers/Trazabilidad/tipoActividadController.php";
require_once "./controllers/Trazabilidad/actividadController.php";
require_once "./controllers/Trazabilidad/residuoController.php";
require_once "./controllers/Trazabilidad/programacionController.php";
require_once "./controllers/Trazabilidad/productosControlController.php";
require_once "./controllers/Trazabilidad/plantacionController.php";
require_once "./controllers/Trazabilidad/plagaController.php";
require_once "./controllers/Trazabilidad/loteController.php";
require_once "./controllers/Trazabilidad/especieController.php";
require_once "./controllers/Trazabilidad/cultivoController.php";
require_once "./controllers/Trazabilidad/cosechasController.php";
require_once "./controllers/Trazabilidad/controlController.php";
require_once "./controllers/Trazabilidad/bancalController.php";
require_once "./controllers/Trazabilidad/afeccionesController.php";

require_once "./controllers/Inventario/InsumoController.php";
require_once "./controllers/Inventario/herramientaController.php";
require_once "./controllers/Inventario/InventarioController.php";
require_once "./controllers/Inventario/semilleroController.php";

require_once "./controllers/IoT/datosMeteorologicosController.php";
require_once "./controllers/IoT/sensorBancalController.php";
require_once "./controllers/IoT/sensoresController.php";

require_once "./controllers/Finanzas/salarioMinimoController.php";
require_once "./controllers/Finanzas/ventaController.php";

require_once "./controllers/Usuarios/RolController.php";
require_once "./controllers/Usuarios/usuarioController.php";

class ControllerCenter {
    public static function getController($resource) {
        switch ($resource) {
            case "actividad":
                return new ActividadController();
            case "tipo_plaga":
                return new TipoPlagaController();
            case "tipos_residuo":
                return new TipoResiduoController();
            case "tipo_especie":
                return new TipoEspecieController();
            case "tipo_control":
                return new TipoControlController();
            case "tipo_actividad":
                return new TipoActividadController();
            case "residuo":
                return new ResiduoController();
            case "programacion":
                return new ProgramacionController();
            case "productos_control":
                return new ProductoControlController();
            case "plantacion":
                return new PlantacionController();
            case "plaga":
                return new PlagaController();
            case "lote":
                return new LoteController();
            case "especie":
                return new EspecieController();
            case "cultivo":
                return new CultivoController();
            case "cosechas":
                return new CosechasController();
            case "control":
                return new ControlController();
            case "bancal":
                return new BancalController();
            case "afecciones":
                return new AfeccionesController();

            case "insumo":
                return new InsumoController();
            case "herramienta":
                return new HerramientaController();
            case "inventario":
                return new BodegaController();
            case "semillero":
                return new SemilleroController();

            case "datos_meteorologicos":
                return new DatosMeteorologicosController();
            case "sensor_bancal":
                return new SensorBancalController();
            case "sensores":
                return new SensorController();

            case "salario":
                return new SalarioMinimoController();
            case "venta":
                return new VentaController();

            case "rol":
                return new RolesController();
            case "usuario":
                return new UsuarioController();

            default:
                return null;
        }
    }
}
?>
