# 🔧 Guía de Personalización - Página de Bienvenida SIGANA

## 📍 Ubicación del Archivo

```
Modules/SG/Resources/views/layouts/masterusers.blade.php
```

---

## 🎨 Cómo Personalizar Elementos

### 1. Cambiar Colores Principales

**Ubicación**: Dentro del tag `<style>` del `<head>`

```css
/* Verde actual */
.text-green-400 { /* color: #22c55e */ }

/* Para cambiar a otro color, modifica el Tailwind class */
/* Opciones: text-blue-400, text-yellow-400, text-red-400, etc */
```

**Ejemplo**: Cambiar de verde a azul
```html
<!-- Antes -->
<span class="text-green-400">Unidad Ganadera</span>

<!-- Después -->
<span class="text-blue-400">Unidad Ganadera</span>
```

### 2. Modificar Imágenes del Carrusel

**Ubicación**: Sección "Hero con carrusel mejorado" (línea ~130)

```html
<div class="carousel-slide absolute inset-0 opacity-0 transition-opacity duration-1000" data-slide="0">
    <img src="{{ asset('images/imagen1.jpg') }}" alt="Ganadería" class="w-full h-full object-cover">
</div>
```

Cambia `'images/imagen1.jpg'` por tu nueva ruta de imagen.

### 3. Ajustar Velocidad del Carrusel

**Ubicación**: Script del carrusel (línea ~160)

```javascript
autoplayInterval = setInterval(nextSlide, 6000); // 6 segundos
```

Cambia `6000` a cualquier valor en milisegundos:
- 3000 = 3 segundos
- 5000 = 5 segundos
- 8000 = 8 segundos

### 4. Cambiar Textos Principales

**Hero Title** (línea ~135)
```html
<h1 class="text-5xl md:text-6xl font-extrabold leading-tight">
    Gestión Integral de tu <span class="text-green-400">Unidad Ganadera</span>
</h1>
```

**Hero Subtitle** (línea ~140)
```html
<p class="text-lg text-slate-200/90 leading-relaxed">
    Monitorea, organiza y mejora tus procesos productivos...
</p>
```

### 5. Agregar Nuevas Secciones

**Estructura Base**:
```html
<section id="nueva-seccion" class="py-20 bg-black/60 backdrop-blur-md fade-up">
  <div class="max-w-6xl mx-auto px-6 text-center">
    <h2 class="text-4xl font-bold text-green-400 mb-12">Título de Sección</h2>
    <!-- Contenido aquí -->
  </div>
</section>
```

### 6. Modificar Números en Estadísticas

**Ubicación**: Sección "Estadísticas mejoradas" (línea ~240)

```html
<div class="text-5xl font-bold text-green-400 mb-2 pulse-animation">95%</div>
<p class="text-slate-400 text-sm font-semibold">Salud Animal</p>
```

Cambia `95%` y el texto descriptivo.

### 7. Agregar Nuevos Iconos

Font Awesome está integrado. Busca iconos en: https://fontawesome.com/icons

```html
<i class="fas fa-cow"></i>  <!-- Vaca -->
<i class="fas fa-heart"></i>  <!-- Corazón -->
<i class="fas fa-leaf"></i>  <!-- Hoja -->
<i class="fas fa-industry"></i>  <!-- Industria -->
```

---

## 🎯 Secciones y Sus Ubicaciones

| Sección | Línea Aprox | Función |
|---------|------------|---------|
| Head y Estilos | 1-40 | Metadatos y CSS |
| Navbar | 45-105 | Navegación superior |
| Hero + Carrusel | 107-195 | Portada principal |
| Módulos | 198-230 | 3 tarjetas principales |
| Beneficios | 233-260 | 4 ventajas |
| Procesos Ganaderos | 263-330 | 4 áreas detalladas |
| Estadísticas | 333-365 | Métricas KPI |
| Testimonios | 368-405 | 3 opiniones usuario |
| CTA | 408-440 | Llamada a acción |
| Footer | 443-535 | Pie de página |
| Scripts | 538-580 | JavaScript |

---

## 🎬 Personalizar Animaciones

### Velocidad de Fade-Up

```css
.fade-up { animation: fadeUp 0.8s ease-out; }
          /* Cambia 0.8s: 0.3s rápido, 1.5s lento */
```

### Agregar Nueva Animación

```css
@keyframes myAnimation {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.my-class { animation: myAnimation 0.8s ease-out; }
```

---

## 🔗 Modificar Enlaces de Autenticación

**Login Button** (línea ~145)
```html
<a href="{{ route('login') }}" class="...">
```

**Panel Button** (línea ~150)
```html
<a href="{{ url('/') }}" class="...">
```

**Admin Panel** (línea ~95)
```html
@if(checkRol('sg.admin'))
  <a href="{{ route('sg.admin.welcome') }}">...
```

---

## 📋 Guía de Estructura CSS

### Classes de Utilidad Tailwind Principales

```css
/* Espaciado */
py-20   = padding vertical 80px
px-6    = padding horizontal 24px
mb-12   = margin-bottom 48px

/* Colores */
bg-black/60     = background con 60% opacidad
text-green-400  = texto verde claro
border-green-500/30 = borde con 30% opacidad

/* Responsive */
md:  = pantallas medianas (768px+)
lg:  = pantallas grandes (1024px+)

/* Grid */
grid-cols-1      = 1 columna mobile
md:grid-cols-3   = 3 columnas en tablet+
```

---

## 🚨 Problemas Comunes

### Las imágenes no cargan
```php
// Verifica que las imágenes existan en:
public/images/imagen1.jpg
public/images/imagen2.jpg
etc.

// O usa asset() como se hace en el código:
{{ asset('images/imagen1.jpg') }}
```

### Carrusel no funciona
- Verifica que haya 4 imágenes
- Asegúrate de que el script esté dentro de `<script>` tags
- Revisa la consola del navegador (F12)

### Estilos no aplican
- Verifica que Tailwind CSS esté cargando
- Limpia el caché del navegador
- Usa clases exactas de Tailwind (sin typos)

### Autenticación rota
- No toques la sección de rutas `@auth` `@guest`
- Verifica los nombres de rutas: `route('login')`, `route('sg.admin.welcome')`
- Revisa que los middlewares estén configurados

---

## 📝 Ejemplo: Agregar Nuevo Módulo

```html
<!-- Copiar esta estructura -->
<div class="p-8 bg-gradient-to-br from-slate-900/80 to-slate-900/40 rounded-2xl shadow-lg hover:shadow-2xl hover:shadow-green-500/20 transition-all duration-300 border border-green-500/10 hover:border-green-500/40">
    <div class="relative mb-4 h-40 rounded-lg overflow-hidden">
        <img src="{{ asset('images/nueva.jpg') }}" class="w-full h-full object-cover transition-transform duration-300 hover:scale-110">
        <div class="absolute inset-0 bg-black/40"></div>
        <i class="fas fa-icon-aqui absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-4xl text-green-400"></i>
    </div>
    <h3 class="text-xl font-semibold mb-2 text-green-400">Nuevo Módulo</h3>
    <p class="text-slate-300 text-sm leading-relaxed">Descripción del nuevo módulo.</p>
</div>
```

---

## 🔐 Mantener Seguridad

✅ **PERMITIDO**
- Cambiar colores, textos, imágenes
- Agregar nuevas secciones
- Modificar estilos CSS
- Agregar iconos Font Awesome

❌ **NO TOQUES**
- La lógica de autenticación `@auth` `@guest`
- Las rutas Laravel `{{ route() }}`
- Las funciones PHP `checkRol()`
- El script de Blade `{{ asset() }}`

---

## 📞 Recursos Útiles

- **Tailwind CSS Docs**: https://tailwindcss.com/docs
- **Font Awesome Icons**: https://fontawesome.com/icons
- **CSS Animations**: https://developer.mozilla.org/es/docs/Web/CSS/animation
- **Laravel Routes**: https://laravel.com/docs/routing

---

## ✅ Checklist Antes de Subir a Producción

- [ ] Todas las imágenes cargan correctamente
- [ ] El carrusel funciona (indicadores y botones)
- [ ] El login funciona
- [ ] El responsive se ve bien en mobile
- [ ] Sin errores en la consola (F12)
- [ ] Los enlaces internos navegan suavemente
- [ ] Las animaciones no ralentizan la página
- [ ] Los iconos se muestran correctamente

---

**Última actualización**: 30 de enero de 2026  
**Versión**: 3.2.0
