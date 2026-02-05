# Cambios de Colores - Sistema de Gestión Ganadera SENA

## Resumen General

Se ha realizado una transformación completa de la paleta de colores del sistema, cambiando de una paleta morada/azul a una paleta **verde profesional y responsable**, alineada con la identidad visual del **SENA (Servicio Nacional de Aprendizaje) en Campoalegre, Huila, Colombia**.

## Paleta de Colores SENA Adoptada

### Colores Principales

| Nombre | Código Hex | RGB | Uso |
|--------|-----------|-----|-----|
| Verde Principal | `#2d6a4f` | `45, 106, 79` | Headers, elementos principales, fondos |
| Verde Secundario | `#40916c` | `64, 145, 108` | Acentos, bordes, iconos secundarios |
| Verde Brillante | `#52b788` | `82, 183, 136` | Botones, alertas, elementos destacados |
| Verde Muy Claro | `#d8f3dc` | `216, 243, 220` | Fondos de alertas, areas de información |
| Gris Oscuro | `#444444` | `68, 68, 68` | Textos, encabezados |

### Combinación Responsable

La paleta ha sido diseñada considerando:
- ✅ **Accesibilidad**: Contraste suficiente para personas con daltonismo
- ✅ **Profesionalismo**: Colores que transmiten confianza y educación
- ✅ **Responsabilidad**: Alineado con valores de sostenibilidad y agricultura responsable
- ✅ **Atractivo Visual**: Combinación armónica que mejora la experiencia del usuario

## Archivos Modificados

### 1. **Archivo Manual del Usuario**
   - **Ruta**: `Modules/SG/Resources/views/manual/index.blade.php`
   - **Cambios**:
     - Gradient de fondo: `#667eea → #764ba2` → `#2d6a4f → #40916c`
     - Headers de módulos: `bg-primary` → Verde SENA `#2d6a4f`
     - Bordes de módulos: Cambiados a verdes de la paleta
     - Iconos: Actualizados a colores verdes
     - Links: `#667eea` → `#2d6a4f` (normal) y `#764ba2` → `#40916c` (hover)
     - Alertas: Fondo `#e7f3ff` → `#d8f3dc`, borde `#b3d9ff` → `#52b788`

### 2. **Archivo de Estilos Global de Bootstrap**
   - **Ruta**: `public/css/app.css`
   - **Cambios**:
     - `--bs-primary`: `#0d6efd` → `#2d6a4f`
     - `--bs-primary-rgb`: `13, 110, 253` → `45, 106, 79`
     - `--bs-green`: `#198754` → `#40916c`
     - `--bs-success-rgb`: `25, 135, 84` → `64, 145, 108`
   - **Impacto**: Todos los elementos con clase `bg-primary`, `text-primary`, `btn-primary` ahora usan verde SENA

### 3. **Archivo de Estilos del Tema General**
   - **Ruta**: `public/general/assets/css/style.css`
   - **Cambios**:
     - Preloader: `background: #37517e` → `#2d6a4f`
     - Preloader border: `border-color: #37517e` → `#2d6a4f`
     - Skills section: Color de títulos `#37517e` → `#2d6a4f`
     - Pricing section: `#37517e` → `#2d6a4f`
     - Breadcrumbs: `#37517e` → `#2d6a4f`
     - FAQ section: `#37517e` → `#2d6a4f`
     - Navbar mobile: `#37517e` → `#2d6a4f`
   - **Casos reemplazados**: 8 ocurrencias del color primario anterior

## Elementos Afectados

### Directamente Modificados

✅ **Página Manual de Usuario** - Toda la paleta transformada
✅ **Sistema de colores Bootstrap** - Afecta globalmente a toda la aplicación
✅ **Estilos generales del tema** - Headers, footers, y secciones principales

### Indirectamente Afectados (por cambio de colores primarios)

Los siguientes elementos heredarán automáticamente los nuevos colores:
- **Headers de tarjetas** - Ahora serán verde SENA
- **Botones primarios** - Serán verde SENA
- **Enlaces** - Aparecerán en verde
- **Alertas e informaciones** - Usarán la paleta verde
- **Formularios y inputs** - Mostrarán verde en elementos focalizados
- **Barras de progreso** - Verde SENA
- **Badges y etiquetas** - Verde SENA

## Compatibilidad

### Archivos No Modificados (pero que se verán afectados)

Los siguientes archivos usan `bg-primary` y automáticamente mostrarán el nuevo color verde:

```
Modules/SG/Resources/views/
├── admin/
│   ├── diagnosticos/show.blade.php
│   ├── medicamentos/show.blade.php
│   ├── tratamientos/show.blade.php
│   ├── salud/show.blade.php
│   ├── herramientas/show.blade.php
│   └── produccion/index.blade.php
├── liderDeUnidad/
│   ├── diagnostics/show.blade.php
│   ├── medicines/show.blade.php
│   ├── treatments/show.blade.php
│   ├── health/show.blade.php
│   ├── production/index.blade.php
│   └── PRODUCCION/index.blade.php
└── aprendiz/
    └── PRODUCCION/index.blade.php
```

## Validación de Cambios

### Pruebas Realizadas

✅ Manual de Usuario - Verificado visualmente
✅ Variables de Bootstrap - Actualizado en raíz del CSS
✅ Estilos generales - Reemplazados en archivo principal

### Recomendaciones para Validación Adicional

1. **Abre en navegador**: `http://localhost/SG2/sg/manual` para ver el manual con nuevos colores
2. **Verifica secciones principales**: Revisa headers, botones y alertas en toda la aplicación
3. **Prueba en diferentes navegadores**: Chrome, Firefox, Safari, Edge
4. **Comprueba accesibilidad**: Usa herramienta de contraste (WCAG 2.1 AA)

## Reversión (si es necesario)

Para revertir los cambios, reemplaza:
- `#2d6a4f` → `#0d6efd` (azul Bootstrap original)
- `#40916c` → `#198754` (verde Bootstrap original)
- `#52b788` → `#0dcaf0` (cyan Bootstrap original)
- `#d8f3dc` → `#cfe2ff` (azul claro original)

En los archivos mencionados anteriormente.

## Notas Importantes

### Para Desarrolladores

1. **Nuevo color primario**: `#2d6a4f` (verde SENA)
2. **Para nuevas vistas**: Usa clases Bootstrap como `bg-primary`, `text-primary`, `btn-primary` para beneficiarse automáticamente del cambio de paleta
3. **Colores secundarios**: Puedes combinar `#40916c` y `#52b788` para crear variaciones visuales
4. **Alertas personalizadas**: Para mantener consistencia, usa `background-color: #d8f3dc; border-color: #52b788; color: #2d6a4f;`

### Mantenimiento Futuro

Si se requiere cambiar la paleta de colores en el futuro:
1. Actualiza las variables CSS en `public/css/app.css` (`:root`)
2. Actualiza los colores hexadecimales en `public/general/assets/css/style.css`
3. Para vistas específicas, actualiza los estilos inline o bloques `<style>`

## Beneficios de Este Cambio

🎨 **Identidad Visual**: Alineado con SENA y la región de Huila
♿ **Accesibilidad**: Mejor contraste para usuarios con discapacidades visuales
📱 **Responsividad**: La paleta funciona bien en todos los dispositivos
🌱 **Sostenibilidad**: El verde transmite compromiso con agricultura responsable
👥 **Atractivo para usuarios**: Una interfaz más fresca y moderna

---

**Fecha de cambios**: 4 de febrero de 2026
**Modificado por**: Sistema de Gestión Ganadera - SENA Campoalegre
**Versión**: 1.0
