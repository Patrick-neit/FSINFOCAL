<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Alumno
 *
 * @property int $id
 * @property string $nombre
 * @property string $apellido
 * @property int $ci
 * @property string|null $lugar_nacimiento
 * @property string $fecha_nacimiento
 * @property string $domicilio
 * @property int $celular
 * @property string|null $sexo
 * @property string $email
 * @property string|null $beca
 * @property int $empresa_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Empresa|null $empresa
 * @method static \Illuminate\Database\Eloquent\Builder|Alumno newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Alumno newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Alumno onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Alumno query()
 * @method static \Illuminate\Database\Eloquent\Builder|Alumno withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Alumno withoutTrashed()
 */
	class Alumno extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AlumnoCurso
 *
 * @method static \Illuminate\Database\Eloquent\Builder|AlumnoCurso newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AlumnoCurso newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AlumnoCurso query()
 */
	class AlumnoCurso extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Binnacle
 *
 * @property int $id
 * @property int $user_id
 * @property string $ip
 * @property string $binnacleable_type
 * @property int $binnacleable_id
 * @property string $action
 * @property string $created_model_at
 * @property string|null $updated_model_at
 * @property string|null $deleted_model_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $binnacleable
 * @method static \Illuminate\Database\Eloquent\Builder|Binnacle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Binnacle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Binnacle onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Binnacle query()
 * @method static \Illuminate\Database\Eloquent\Builder|Binnacle withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Binnacle withoutTrashed()
 */
	class Binnacle extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ConfiguracionImpuesto
 *
 * @property int $id
 * @property string $nombre_sistema
 * @property int $ambiente 1:Produccion|2:Pruebas
 * @property int $modalidad 1:Linea|2:OffLinea
 * @property string $codigo_sistema
 * @property string $token_sistema
 * @property int $empresa_id
 * @property int $estado
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Binnacle> $binacle
 * @property-read int|null $binacle_count
 * @property-read \App\Models\Empresa|null $empresa
 * @method static \Illuminate\Database\Eloquent\Builder|ConfiguracionImpuesto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConfiguracionImpuesto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ConfiguracionImpuesto onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ConfiguracionImpuesto query()
 * @method static \Illuminate\Database\Eloquent\Builder|ConfiguracionImpuesto withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ConfiguracionImpuesto withoutTrashed()
 */
	class ConfiguracionImpuesto extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Correlativo
 *
 * @property int $id
 * @property int $sucursal_id
 * @property string $documento
 * @property string $serie
 * @property int $numero
 * @method static \Illuminate\Database\Eloquent\Builder|Correlativo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Correlativo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Correlativo query()
 */
	class Correlativo extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Curso
 *
 * @property int $id
 * @property string $nombre_curso
 * @property string $turno
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * @property float $costo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Curso newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Curso newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Curso query()
 */
	class Curso extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Docente
 *
 * @property int $id
 * @property string $nombre_completo
 * @property string $matricula
 * @property string $fecha_incorporacion
 * @property int $telefono
 * @property string $direccion
 * @property string $estado A=Activo|I=Inactivo|S=Suspendido
 * @property int $empresa_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Empresa|null $empresa
 * @method static \Illuminate\Database\Eloquent\Builder|Docente newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Docente newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Docente onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Docente query()
 * @method static \Illuminate\Database\Eloquent\Builder|Docente withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Docente withoutTrashed()
 */
	class Docente extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Empresa
 *
 * @property int $id
 * @property string $nombre_empresa
 * @property string $nro_nit_empresa
 * @property string $direccion
 * @property string $telefono
 * @property string $correo
 * @property string|null $logo
 * @property string|null $representante_legal
 * @property int $estado
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Alumno> $alumnos
 * @property-read int|null $alumnos_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Binnacle> $binacle
 * @property-read int|null $binacle_count
 * @property-read \App\Models\ConfiguracionImpuesto|null $configuracion_impuesto
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Docente> $docentes
 * @property-read int|null $docentes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ImpuestoCufd> $impuestos_cufds
 * @property-read int|null $impuestos_cufds_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ImpuestoCuis> $impuestos_cuis
 * @property-read int|null $impuestos_cuis_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PuntoVenta> $puntos_ventas
 * @property-read int|null $puntos_ventas_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Sucursal> $sucursales
 * @property-read int|null $sucursales_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa query()
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa withoutTrashed()
 */
	class Empresa extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ImpuestoCufd
 *
 * @property int $id
 * @property string $fecha_generado
 * @property string $fecha_vencimiento
 * @property string $codigo_cufd
 * @property string $codigo_control
 * @property string $direccion
 * @property string $estado
 * @property int $sucursal_id
 * @property int $empresa_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Empresa|null $empresa
 * @property-read \App\Models\Sucursal|null $sucursal
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoCufd newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoCufd newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoCufd onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoCufd query()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoCufd withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoCufd withoutTrashed()
 */
	class ImpuestoCufd extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ImpuestoCuis
 *
 * @property int $id
 * @property string $fecha_generado
 * @property string $fecha_vencimiento
 * @property string $codigo_cuis
 * @property string $estado
 * @property int $sucursal_id
 * @property int $empresa_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Empresa|null $empresa
 * @property-read \App\Models\Sucursal|null $sucursal
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoCuis newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoCuis newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoCuis onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoCuis query()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoCuis withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoCuis withoutTrashed()
 */
	class ImpuestoCuis extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ImpuestoDocumentoIdentidad
 *
 * @property int $id
 * @property int $codigo_clasificador
 * @property string $descripcion
 * @property string $transaccion
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoDocumentoIdentidad newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoDocumentoIdentidad newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoDocumentoIdentidad query()
 */
	class ImpuestoDocumentoIdentidad extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ImpuestoDocumentoSector
 *
 * @property int $id
 * @property string $codigo_actividad
 * @property int $codigo_documento_sector
 * @property string $tipo_documento_sector
 * @property string $transaccion
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoDocumentoSector newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoDocumentoSector newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoDocumentoSector query()
 */
	class ImpuestoDocumentoSector extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ImpuestoEventoSignificativo
 *
 * @property int $id
 * @property int $codigo_clasificador
 * @property string $descripcion
 * @property string $transaccion
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoEventoSignificativo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoEventoSignificativo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoEventoSignificativo query()
 */
	class ImpuestoEventoSignificativo extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ImpuestoFechaHora
 *
 * @property int $id
 * @property string $fecha_hora
 * @property string $transaccion
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoFechaHora newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoFechaHora newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoFechaHora query()
 */
	class ImpuestoFechaHora extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ImpuestoLeyendaFactura
 *
 * @property int $id
 * @property string $codigo_actividad
 * @property string $descripcion_leyenda
 * @property string $transaccion
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoLeyendaFactura newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoLeyendaFactura newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoLeyendaFactura query()
 */
	class ImpuestoLeyendaFactura extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ImpuestoListadoActividad
 *
 * @property int $id
 * @property int $codigo_caeb
 * @property string $descripcion
 * @property string $tipo_actividad
 * @property string $transaccion
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoListadoActividad newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoListadoActividad newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoListadoActividad query()
 */
	class ImpuestoListadoActividad extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ImpuestoListadoPais
 *
 * @property int $id
 * @property int $codigo_clasificador
 * @property string $descripcion
 * @property string $transaccion
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoListadoPais newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoListadoPais newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoListadoPais query()
 */
	class ImpuestoListadoPais extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ImpuestoMensajeServicio
 *
 * @property int $id
 * @property int $codigo_clasificador
 * @property string $descripcion
 * @property string $transaccion
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoMensajeServicio newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoMensajeServicio newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoMensajeServicio query()
 */
	class ImpuestoMensajeServicio extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ImpuestoMetodoPago
 *
 * @property int $id
 * @property int $codigo_clasificador
 * @property string $descripcion
 * @property string $transaccion
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoMetodoPago newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoMetodoPago newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoMetodoPago query()
 */
	class ImpuestoMetodoPago extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ImpuestoMotivoAnulacion
 *
 * @property int $id
 * @property int $codigo_clasificador
 * @property string $descripcion
 * @property string $transaccion
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoMotivoAnulacion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoMotivoAnulacion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoMotivoAnulacion query()
 */
	class ImpuestoMotivoAnulacion extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ImpuestoProductoServicio
 *
 * @property int $id
 * @property string $codigo_actividad
 * @property int $codigo_producto
 * @property string $descripcion_producto
 * @property mixed|null $nandina
 * @property string $transaccion
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoProductoServicio newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoProductoServicio newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoProductoServicio query()
 */
	class ImpuestoProductoServicio extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ImpuestoTipoDocumentoSector
 *
 * @property int $id
 * @property int $codigo_clasificador
 * @property string $descripcion
 * @property string $transaccion
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoTipoDocumentoSector newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoTipoDocumentoSector newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoTipoDocumentoSector query()
 */
	class ImpuestoTipoDocumentoSector extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ImpuestoTipoEmision
 *
 * @property int $id
 * @property int $codigo_clasificador
 * @property string $descripcion
 * @property string $transaccion
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoTipoEmision newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoTipoEmision newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoTipoEmision query()
 */
	class ImpuestoTipoEmision extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ImpuestoTipoFactura
 *
 * @property int $id
 * @property int $codigo_clasificador
 * @property string $descripcion
 * @property string $transaccion
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoTipoFactura newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoTipoFactura newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoTipoFactura query()
 */
	class ImpuestoTipoFactura extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ImpuestoTipoHabitacion
 *
 * @property int $id
 * @property int $codigo_clasificador
 * @property string $descripcion
 * @property string $transaccion
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoTipoHabitacion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoTipoHabitacion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoTipoHabitacion query()
 */
	class ImpuestoTipoHabitacion extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ImpuestoTipoMoneda
 *
 * @property int $id
 * @property int $codigo_clasificador
 * @property string $descripcion
 * @property string $transaccion
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoTipoMoneda newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoTipoMoneda newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoTipoMoneda query()
 */
	class ImpuestoTipoMoneda extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ImpuestoTipoPuntoVenta
 *
 * @property int $id
 * @property int $codigo_clasificador
 * @property string $descripcion
 * @property string $transaccion
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoTipoPuntoVenta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoTipoPuntoVenta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoTipoPuntoVenta query()
 */
	class ImpuestoTipoPuntoVenta extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ImpuestoUnidadMedida
 *
 * @property int $id
 * @property int $codigo_clasificador
 * @property string $descripcion
 * @property string $transaccion
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoUnidadMedida newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoUnidadMedida newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImpuestoUnidadMedida query()
 */
	class ImpuestoUnidadMedida extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Marca
 *
 * @property int $id
 * @property string $nombre_marca
 * @property int $estado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Marca newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Marca newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Marca onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Marca query()
 * @method static \Illuminate\Database\Eloquent\Builder|Marca withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Marca withoutTrashed()
 */
	class Marca extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PuntoVenta
 *
 * @property int $id
 * @property string $nombre_punto_venta
 * @property int $tipo_punto_venta
 * @property int $codigo_punto_venta
 * @property string|null $descripcion_punto_venta
 * @property int $sucursal_id
 * @property int $empresa_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Binnacle> $binacle
 * @property-read int|null $binacle_count
 * @property-read \App\Models\Empresa|null $empresa
 * @property-read \App\Models\Sucursal|null $sucursal
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|PuntoVenta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PuntoVenta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PuntoVenta onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PuntoVenta query()
 * @method static \Illuminate\Database\Eloquent\Builder|PuntoVenta withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PuntoVenta withoutTrashed()
 */
	class PuntoVenta extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PuntoVentaCufd
 *
 * @property int $id
 * @property int $cuis_id
 * @property int $cufd_id
 * @property int $punto_venta_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PuntoVentaCufd newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PuntoVentaCufd newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PuntoVentaCufd query()
 */
	class PuntoVentaCufd extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Sucursal
 *
 * @property int $id
 * @property string $nombre_sucursal
 * @property string $direccion
 * @property int $codigo_sucursal
 * @property int $telefono
 * @property int $empresa_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Empresa|null $empresa
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ImpuestoCuis> $impuestos_cuis
 * @property-read int|null $impuestos_cuis_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PuntoVenta> $puntos_ventas
 * @property-read int|null $puntos_ventas_count
 * @method static \Illuminate\Database\Eloquent\Builder|Sucursal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sucursal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sucursal onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Sucursal query()
 * @method static \Illuminate\Database\Eloquent\Builder|Sucursal withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Sucursal withoutTrashed()
 */
	class Sucursal extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $apellidos
 * @property int $departamento_id
 * @property string $email
 * @property string $password
 * @property string $fecha_nacimiento
 * @property string $ci
 * @property string $fotografia
 * @property string|null $google_id
 * @property string|null $google_token
 * @property string|null $google_refresh_token
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $banned_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Cog\Laravel\Ban\Models\Ban> $bans
 * @property-read int|null $bans_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Binnacle> $binacle
 * @property-read int|null $binacle_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Empresa> $empresas
 * @property-read int|null $empresas_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \App\Models\PuntoVenta|null $punto_venta
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutRole($roles, $guard = null)
 */
	class User extends \Eloquent implements \Cog\Contracts\Ban\Bannable {}
}

