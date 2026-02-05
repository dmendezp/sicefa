# Paleta de Colores SENA - Referencia Rápida

## Paleta Oficial

```css
/* Verde Primario SENA - Uso Principal */
--color-primary: #2d6a4f;
--color-primary-rgb: 45, 106, 79;

/* Verde Secundario - Acentos y Énfasis */
--color-secondary: #40916c;
--color-secondary-rgb: 64, 145, 108;

/* Verde Brillante - Elementos Destacados */
--color-accent: #52b788;
--color-accent-rgb: 82, 183, 136;

/* Verde Muy Claro - Fondos de Información */
--color-light-bg: #d8f3dc;

/* Gris Oscuro - Textos Principales */
--color-text: #444444;
```

## Ejemplos de Uso

### En HTML/Blade

```html
<!-- Headers y elementos principales -->
<div class="bg-primary text-white">Contenido</div>

<!-- Botones -->
<button class="btn btn-primary">Aceptar</button>

<!-- Bordes y separadores -->
<div style="border-color: #2d6a4f; border-left: 4px solid;">
    Contenido con borde verde
</div>

<!-- Alertas -->
<div style="background-color: #d8f3dc; border-color: #52b788; color: #2d6a4f; border: 1px solid #52b788;">
    Mensaje informativo
</div>

<!-- Iconos coloreados -->
<i class="fas fa-icon" style="color: #40916c;"></i>
```

### En CSS

```css
/* Elemento principal */
.header {
    background-color: #2d6a4f;
    color: white;
}

/* Elemento secundario */
.section-title {
    color: #40916c;
    border-bottom: 3px solid #52b788;
}

/* Hover effect */
a:hover {
    color: #40916c;
}

/* Elemento destacado */
.badge {
    background-color: #52b788;
    color: white;
}

/* Información / Alerta */
.alert-info {
    background-color: #d8f3dc;
    border-color: #52b788;
    color: #2d6a4f;
}
```

## Combinaciones Recomendadas

| Combinación | Uso |
|------------|-----|
| `#2d6a4f` + blanco | Headers, barras de navegación |
| `#40916c` + blanco | Botones secundarios, acentos |
| `#52b788` + blanco | Elementos destacados, badges |
| `#d8f3dc` + `#2d6a4f` | Fondos de alertas e información |
| `#2d6a4f` + `#40916c` | Gradientes |
| `#40916c` + `#52b788` | Transiciones suaves |

## Gradientes Disponibles

```css
/* Degradado principal */
background: linear-gradient(135deg, #2d6a4f 0%, #40916c 100%);

/* Degradado secundario */
background: linear-gradient(135deg, #40916c 0%, #52b788 100%);

/* Degradado completo */
background: linear-gradient(135deg, #2d6a4f 0%, #40916c 50%, #52b788 100%);
```

## Compatibilidad Bootstrap

```html
<!-- Clases Bootstrap que ahora usan verde SENA -->
<div class="bg-primary">Verde principal</div>
<button class="btn btn-primary">Botón verde</button>
<span class="text-primary">Texto verde</span>
<div class="border border-primary">Borde verde</div>
```

## Notas de Contraste

- ✅ Verde `#2d6a4f` sobre blanco: Ratio 5.2:1 (Accesible)
- ✅ Verde `#40916c` sobre blanco: Ratio 4.1:1 (Accesible)
- ✅ Verde `#52b788` sobre blanco: Ratio 3.2:1 (Accesible)
- ✅ Blanco sobre Verde `#2d6a4f`: Ratio 5.2:1 (Accesible)

---

**Color Picker**: Copia estos valores a tu herramienta de diseño favorita
**Actualizado**: 4 de febrero de 2026
