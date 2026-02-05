@extends('layouts.app')

@section('title', 'Manual de Usuario - Sistema de Gestión Ganadera')

@section('content')
<div class="container-fluid py-5" style="background: linear-gradient(135deg, #1B5E20 0%, #2E7D32 100%); min-height: 100vh;">
    <!-- Encabezado -->
    <div class="row mb-5">
        <div class="col-12 text-center text-white">
            <h1 class="display-4 fw-bold mb-3">
                <i class="fas fa-book-open"></i> Manual de Usuario
            </h1>
            <p class="lead">Sistema de Gestión Ganadera - Guía Completa</p>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-12 text-center">
            <a href="{{ route('cefa.sg.index') }}" class="btn btn-lg fw-bold shadow-lg" style="border-radius: 50px; font-size: 1.2rem; background: linear-gradient(135deg, #1B5E20 0%, #2E7D32 100%); color: white; padding: 15px 40px; border: 2px solid #fff; transition: all 0.3s ease; position: relative; overflow: hidden;" 
               onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 15px 35px rgba(27, 94, 32, 0.4)';" 
               onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 8px 20px rgba(0, 0, 0, 0.2)';">
                <i class="fas fa-home me-2"></i>Volver al Inicio
            </a>
        </div>
    </div>

    <!-- Tabla de Contenidos -->
    <div class="row mb-5">
        <div class="col-lg-10 mx-auto">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-green text-white p-4">
                    <h5 class="mb-0"><i class="fas fa-list-check"></i> Contenido</h5>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li class="mb-2"><a href="#modulo-1" class="text-decoration-none">1. Gestión de Animales</a></li>
                                <li class="mb-2"><a href="#modulo-2" class="text-decoration-none">2. Catálogos Básicos</a></li>
                                <li class="mb-2"><a href="#modulo-3" class="text-decoration-none">3. Reproducción</a></li>
                                <li class="mb-2"><a href="#modulo-4" class="text-decoration-none">4. Salud Animal</a></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li class="mb-2"><a href="#modulo-5" class="text-decoration-none">5. Producción Lechera</a></li>
                                <li class="mb-2"><a href="#modulo-6" class="text-decoration-none">6. Desarrollo y Pesaje</a></li>
                                <li class="mb-2"><a href="#modulo-7" class="text-decoration-none">7. Recursos e Insumos</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MÓDULO 1: GESTIÓN DE ANIMALES -->
    <div id="modulo-1" class="row mb-5">
        <div class="col-lg-10 mx-auto">
            <div class="card shadow-lg border-0 border-left border-primary border-4">
                <div class="card-header bg-light p-4">
                    <h3 class="mb-0"><i class="fas fa-cow text-danger"></i> 1. Gestión de Animales</h3>
                </div>
                <div class="card-body p-4">
                    <p class="lead mb-4">Administra el registro y seguimiento de todos los bovinos en tu hato ganadero.</p>
                    
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card bg-light h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-list-ul text-primary"></i> Listado de Bovinos</h5>
                                    <p class="card-text"><strong>¿Qué puedes hacer?</strong></p>
                                    <ul class="small">
                                        <li>Ver todos los bovinos registrados</li>
                                        <li>Buscar animales por ID o nombre</li>
                                        <li>Filtrar por raza, edad o estado</li>
                                        <li>Ver detalles completos de cada animal</li>
                                        <li>Editar información existente</li>
                                        <li>Eliminar registros (si es necesario)</li>
                                    </ul>
                                    <p class="text-muted mt-3"><strong>Ubicación:</strong> Menú Principal → Gestión de Animales → Listado de Bovinos</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card bg-light h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-plus-circle text-success"></i> Registrar Nuevo Bovino</h5>
                                    <p class="card-text"><strong>Pasos para registrar:</strong></p>
                                    <ol class="small">
                                        <li>Haz clic en "Registrar Nuevo Bovino"</li>
                                        <li>Completa los datos básicos:
                                            <ul>
                                                <li>ID/Código del animal</li>
                                                <li>Nombre</li>
                                                <li>Raza</li>
                                                <li>Fecha de nacimiento</li>
                                                <li>Sexo</li>
                                                <li>Color/Marca distintiva</li>
                                            </ul>
                                        </li>
                                        <li>Haz clic en "Guardar"</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info mt-4" role="alert">
                        <i class="fas fa-lightbulb"></i> <strong>Consejo:</strong> Asigna un código único a cada animal para facilitar su identificación en toda la plataforma.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MÓDULO 2: CATÁLOGOS BÁSICOS -->
    <div id="modulo-2" class="row mb-5">
        <div class="col-lg-10 mx-auto">
            <div class="card shadow-lg border-0 border-left border-warning border-4">
                <div class="card-header bg-light p-4">
                    <h3 class="mb-0"><i class="fas fa-book text-warning"></i> 2. Catálogos Básicos</h3>
                </div>
                <div class="card-body p-4">
                    <p class="lead mb-4">Gestiona la información de referencia necesaria para el funcionamiento del sistema.</p>
                    
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card bg-light h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-dna text-info"></i> Catálogo de Razas</h5>
                                    <p class="card-text"><strong>¿Qué contiene?</strong></p>
                                    <ul class="small">
                                        <li>Registro de todas las razas disponibles</li>
                                        <li>Características de cada raza</li>
                                        <li>Peso promedio</li>
                                        <li>Productividad esperada</li>
                                    </ul>
                                    <p class="text-muted mt-3"><strong>¿Cuándo usarlo?</strong> Antes de registrar nuevos animales, verifica que su raza esté en el catálogo.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card bg-light h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-pills text-danger"></i> Catálogo de Medicamentos</h5>
                                    <p class="card-text"><strong>¿Qué registrar?</strong></p>
                                    <ul class="small">
                                        <li>Nombre del medicamento</li>
                                        <li>Principio activo</li>
                                        <li>Dosis recomendada</li>
                                        <li>Vía de administración</li>
                                        <li>Efectos adversos</li>
                                        <li>Período de retiro (si aplica)</li>
                                    </ul>
                                    <p class="text-muted mt-3"><strong>Importancia:</strong> Facilita la trazabilidad de tratamientos.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info mt-4" role="alert">
                        <i class="fas fa-lightbulb"></i> <strong>Recomendación:</strong> Mantén estos catálogos actualizados para garantizar registros precisos en otros módulos.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MÓDULO 3: REPRODUCCIÓN -->
    <div id="modulo-3" class="row mb-5">
        <div class="col-lg-10 mx-auto">
            <div class="card shadow-lg border-0 border-left border-danger border-4">
                <div class="card-header bg-light p-4">
                    <h3 class="mb-0"><i class="fas fa-dna text-danger"></i> 3. Reproducción</h3>
                </div>
                <div class="card-body p-4">
                    <p class="lead mb-4">Controla y registra toda la actividad reproductiva de tu hato.</p>
                    
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card bg-light h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-syringe text-primary"></i> Inseminaciones</h5>
                                    <p class="card-text"><strong>Registra:</strong></p>
                                    <ul class="small">
                                        <li>Bovino a inseminar</li>
                                        <li>Fecha de inseminación</li>
                                        <li>Toro/semental utilizado</li>
                                        <li>Técnico que realiza el procedimiento</li>
                                        <li>Número de dosis utilizada</li>
                                        <li>Observaciones</li>
                                    </ul>
                                    <p class="text-muted mt-3"><strong>Beneficio:</strong> Mantén un historial reproductivo completo de cada hembra.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card bg-light h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-baby text-success"></i> Partos y Nacimientos</h5>
                                    <p class="card-text"><strong>Documenta:</strong></p>
                                    <ul class="small">
                                        <li>Madre (bovino que pare)</li>
                                        <li>Fecha y hora del parto</li>
                                        <li>Número de crías nacidas</li>
                                        <li>Sexo de la cría</li>
                                        <li>Peso al nacer</li>
                                        <li>Estado de salud</li>
                                        <li>Complicaciones (si las hay)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-warning mt-4" role="alert">
                        <i class="fas fa-exclamation-triangle"></i> <strong>Importante:</strong> Registra las inseminaciones para calcular la fecha probable de parto y prepararte con anticipación.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MÓDULO 4: SALUD ANIMAL -->
    <div id="modulo-4" class="row mb-5">
        <div class="col-lg-10 mx-auto">
            <div class="card shadow-lg border-0 border-left border-success border-4">
                <div class="card-header bg-light p-4">
                    <h3 class="mb-0"><i class="fas fa-heartbeat text-success"></i> 4. Salud Animal</h3>
                </div>
                <div class="card-body p-4">
                    <p class="lead mb-4">Mantén un control completo de la salud y bienestar de tus animales.</p>
                    
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="card bg-light h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-notes-medical text-info"></i> Historias Clínicas</h5>
                                    <p class="card-text"><strong>Contenido:</strong></p>
                                    <ul class="small">
                                        <li>Animal afectado</li>
                                        <li>Fecha de consulta</li>
                                        <li>Síntomas observados</li>
                                        <li>Examen físico</li>
                                        <li>Antecedentes</li>
                                        <li>Plan de tratamiento</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card bg-light h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-prescription-bottle-alt text-warning"></i> Tratamientos</h5>
                                    <p class="card-text"><strong>Registra:</strong></p>
                                    <ul class="small">
                                        <li>Animal a tratar</li>
                                        <li>Medicamento utilizado</li>
                                        <li>Dosis administrada</li>
                                        <li>Vía de administración</li>
                                        <li>Fecha de inicio</li>
                                        <li>Duración del tratamiento</li>
                                        <li>Costo</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card bg-light h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-vial text-danger"></i> Diagnósticos</h5>
                                    <p class="card-text"><strong>Incluye:</strong></p>
                                    <ul class="small">
                                        <li>Animal diagnosticado</li>
                                        <li>Enfermedad/condición</li>
                                        <li>Fecha del diagnóstico</li>
                                        <li>Resultado de análisis</li>
                                        <li>Recomendaciones</li>
                                        <li>Pronóstico</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info mt-4" role="alert">
                        <i class="fas fa-lightbulb"></i> <strong>Buena práctica:</strong> Registra cada consulta veterinaria y tratamiento para mantener un historial completo y detectar patrones de enfermedad.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MÓDULO 5: PRODUCCIÓN LECHERA -->
    <div id="modulo-5" class="row mb-5">
        <div class="col-lg-10 mx-auto">
            <div class="card shadow-lg border-0 border-left border-info border-4">
                <div class="card-header bg-light p-4">
                    <h3 class="mb-0"><i class="fas fa-flask text-info"></i> 5. Producción Lechera</h3>
                </div>
                <div class="card-body p-4">
                    <p class="lead mb-4">Monitorea y controla la producción de leche de tu hato.</p>
                    
                    <div class="card bg-light mb-4">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-clipboard-list text-primary"></i> Control de Ordeño</h5>
                            <p class="card-text"><strong>¿Qué registrar en cada ordeño?</strong></p>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <p class="small"><strong>Datos del animal:</strong></p>
                                    <ul class="small">
                                        <li>Identificación de la vaca</li>
                                        <li>Fecha del ordeño</li>
                                        <li>Hora del ordeño</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <p class="small"><strong>Datos de producción:</strong></p>
                                    <ul class="small">
                                        <li>Volumen de leche (litros)</li>
                                        <li>Calidad (% grasa, proteína)</li>
                                        <li>Observaciones</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <p class="small text-muted mt-4"><strong>¿Para qué sirve?</strong></p>
                            <ul class="small">
                                <li>Identificar vacas de mayor productividad</li>
                                <li>Detectar disminuciones anormales de producción (señal de enfermedad)</li>
                                <li>Calcular promedios diarios y mensuales</li>
                                <li>Tomar decisiones de reproducción y alimentación</li>
                            </ul>
                        </div>
                    </div>

                    <div class="alert alert-success mt-4" role="alert">
                        <i class="fas fa-chart-line"></i> <strong>Ventaja:</strong> El sistema genera reportes automáticos de producción lechera para análisis de rendimiento.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MÓDULO 6: DESARROLLO Y PESAJE -->
    <div id="modulo-6" class="row mb-5">
        <div class="col-lg-10 mx-auto">
            <div class="card shadow-lg border-0 border-left border-primary border-4">
                <div class="card-header bg-light p-4">
                    <h3 class="mb-0"><i class="fas fa-leaf text-primary"></i> 6. Desarrollo y Pesaje</h3>
                </div>
                <div class="card-body p-4">
                    <p class="lead mb-4">Realiza seguimiento del crecimiento y desarrollo de tus animales.</p>
                    
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-weight text-success"></i> Control de Peso</h5>
                            <p class="card-text"><strong>Información a registrar:</strong></p>
                            
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <p class="small"><strong>Datos básicos:</strong></p>
                                    <ul class="small">
                                        <li>Animal pesado</li>
                                        <li>Fecha del pesaje</li>
                                        <li>Peso actual (kg)</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <p class="small"><strong>Análisis:</strong></p>
                                    <ul class="small">
                                        <li>Ganancia de peso desde último registro</li>
                                        <li>Ganancia diaria promedio (GDP)</li>
                                        <li>Observaciones sobre condición corporal</li>
                                    </ul>
                                </div>
                            </div>

                            <p class="small mt-4"><strong>Recomendaciones de pesaje:</strong></p>
                            <ul class="small">
                                <li>🐄 <strong>Terneros:</strong> Semanalmente</li>
                                <li>🐄 <strong>Animales en crecimiento:</strong> Quincenal o mensual</li>
                                <li>🐄 <strong>Adultos:</strong> Mensual o según necesidad</li>
                            </ul>

                            <div class="alert alert-info small mt-3" role="alert">
                                <i class="fas fa-info-circle"></i> Compara el peso con los estándares de raza para evaluar si el desarrollo es óptimo.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MÓDULO 7: RECURSOS E INSUMOS -->
    <div id="modulo-7" class="row mb-5">
        <div class="col-lg-10 mx-auto">
            <div class="card shadow-lg border-0 border-left border-warning border-4">
                <div class="card-header bg-light p-4">
                    <h3 class="mb-0"><i class="fas fa-warehouse text-warning"></i> 7. Recursos e Insumos</h3>
                </div>
                <div class="card-body p-4">
                    <p class="lead mb-4">Administra el inventario de recursos, insumos y herramientas de la explotación.</p>
                    
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="card bg-light h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-seedling text-success"></i> Insumos Ganaderos</h5>
                                    <p class="card-text"><strong>Registra:</strong></p>
                                    <ul class="small">
                                        <li>Alimentos y forrajes</li>
                                        <li>Concentrados</li>
                                        <li>Minerales y vitaminas</li>
                                        <li>Aditivos para alimentación</li>
                                        <li>Cantidad disponible</li>
                                        <li>Fecha de vencimiento</li>
                                        <li>Proveedor</li>
                                        <li>Costo unitario</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card bg-light h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-tools text-primary"></i> Herramientas</h5>
                                    <p class="card-text"><strong>Incluye:</strong></p>
                                    <ul class="small">
                                        <li>Equipos de ordeño</li>
                                        <li>Herramientas de trabajo</li>
                                        <li>Equipos de sanidad</li>
                                        <li>Equipos de medición</li>
                                        <li>Estado de la herramienta</li>
                                        <li>Fecha de última revisión</li>
                                        <li>Responsable</li>
                                        <li>Mantenimiento requerido</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card bg-light h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-building text-info"></i> Bodegas</h5>
                                    <p class="card-text"><strong>Administra:</strong></p>
                                    <ul class="small">
                                        <li>Ubicación de bodegas</li>
                                        <li>Capacidad total</li>
                                        <li>Espacio utilizado</li>
                                        <li>Inventario actual</li>
                                        <li>Condiciones de almacenamiento</li>
                                        <li>Responsable de bodega</li>
                                        <li>Últimas actualizaciones</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-warning mt-4" role="alert">
                        <i class="fas fa-exclamation-circle"></i> <strong>Recomendación:</strong> Revisa regularmente el inventario para evitar desabastecimiento de insumos críticos y mantener herramientas en buen estado.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SECCIÓN DE CONSEJOS GENERALES -->
    <div class="row mb-5">
        <div class="col-lg-10 mx-auto">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-dark text-white p-4">
                    <h4 class="mb-0"><i class="fas fa-star"></i> Consejos Generales de Uso</h4>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-check-circle text-success fa-2x"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6>Actualiza regularmente</h6>
                                    <p class="small mb-0">Registra la información en el mismo día que ocurren los eventos para mantener datos precisos.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-database text-info fa-2x"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6>Mantén códigos únicos</h6>
                                    <p class="small mb-0">Usa identificadores consistentes para cada animal en todos los módulos.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-chart-bar text-warning fa-2x"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6>Revisa reportes</h6>
                                    <p class="small mb-0">Consulta regularmente los reportes para tomar decisiones basadas en datos.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-shield-alt text-danger fa-2x"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6>Seguridad de datos</h6>
                                    <p class="small mb-0">No compartas tu contraseña y cierra sesión al terminar de usar el sistema.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PREGUNTAS FRECUENTES -->
    <div class="row mb-5">
        <div class="col-lg-10 mx-auto">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-success text-white p-4">
                    <h4 class="mb-0"><i class="fas fa-question-circle"></i> Preguntas Frecuentes</h4>
                </div>
                <div class="card-body p-4">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item border-0 mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    ¿Qué debo hacer si necesito editar información anterior?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Dirígete al listado del módulo correspondiente, busca el registro, haz clic en "Editar", realiza los cambios necesarios y guarda los cambios.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    ¿Cómo recupero un registro eliminado?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Contacta con el administrador del sistema. Los datos eliminados pueden recuperarse desde las copias de seguridad.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    ¿Con qué frecuencia se hacen copias de seguridad?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    El sistema realiza copias automáticas diarias. Consúltale al administrador para más detalles sobre la política de respaldos.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                    ¿Puedo exportar datos para usarlos en otros programas?
                                </button>
                            </h2>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Sí, la mayoría de listados tienen opciones para exportar en formato Excel o PDF. Busca el botón de exportación en el listado.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                                    ¿Qué hago si encontré un error en el sistema?
                                </button>
                            </h2>
                            <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Reporta el error al administrador del sistema con una descripción detallada de qué sucedió y en qué módulo ocurrió.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="alert alert-light border text-center p-4">
                <h6 class="mb-2"><i class="fas fa-info-circle text-primary"></i> ¿Necesitas ayuda?</h6>
                <p class="small mb-0">Si tienes dudas o problemas al usar el sistema, contacta al administrador o consulta la documentación técnica.</p>
            </div>
        </div>
    </div>

</div>

<style>
    .border-left {
        border-left: 4px solid !important;
    }
    
    .border-4 {
        border-width: 4px !important;
    }

    .card {
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }

    .accordion-button:not(.collapsed) {
        background-color: #f0f0f0;
        color: #333;
    }

    .accordion-button:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
    }

    a {
        color: #667eea;
        text-decoration: none;
    }

    a:hover {
        color: #764ba2;
        text-decoration: underline;
    }

    .alert-info {
        background-color: #e7f3ff;
        border-color: #b3d9ff;
        color: #004085;
    }

    .alert-warning {
        background-color: #fff3cd;
        border-color: #ffecb5;
        color: #856404;
    }
</style>

@endsection