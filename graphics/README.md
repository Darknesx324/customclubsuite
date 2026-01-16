# Diagramas del Proyecto - Custom Club Suite

Este directorio contiene los diagramas de diseño del sistema Custom Club Suite.

## Archivos de Diagramas

### 1. `diagrama_clases.puml`
**Diagrama de Clases UML**

Muestra la estructura de clases del sistema y sus relaciones:
- `DBConnection`: Clase base para conexión a base de datos
- `SystemSettings`: Gestión de configuración y sesiones
- `Login`: Manejo de autenticación
- `Users`: Gestión de usuarios
- `Master`: Operaciones CRUD principales
- `Zone`: Gestión de zonas/barangays

**Relaciones:**
- Herencia: Todas las clases heredan de `DBConnection`
- Composición: Varias clases utilizan `SystemSettings`

### 2. `diagrama_base_datos.puml`
**Diagrama Entidad-Relación (ER)**

Representa el esquema de la base de datos:
- **Tablas principales:**
  - `users`: Usuarios del sistema
  - `categories`: Categorías de vehículos
  - `service_list`: Lista de servicios disponibles
  - `mechanics_list`: Lista de mecánicos
  - `service_requests`: Solicitudes de servicio
  - `request_meta`: Metadatos de solicitudes (patrón EAV)
  - `system_info`: Configuración del sistema
  - `barangay_list`: Lista de zonas/barangays

**Relaciones:**
- `service_requests` → `categories` (muchos a uno)
- `service_requests` → `mechanics_list` (muchos a uno, opcional)
- `request_meta` → `service_requests` (muchos a uno)

### 3. `diagrama_arquitectura.puml`
**Diagrama de Arquitectura del Sistema**

Muestra la estructura en capas del sistema:
- **Capa de Presentación:** Páginas PHP, Admin Panel, Frontend
- **Capa de Lógica de Negocio:** Clases de dominio (Login, Users, Master, etc.)
- **Capa de Acceso a Datos:** DBConnection y MySQLi
- **Base de Datos:** MySQL/MariaDB
- **Recursos:** Assets, Uploads, Librerías

### 4. `diagrama_casos_uso.puml`
**Diagrama de Casos de Uso**

Describe las funcionalidades del sistema desde la perspectiva de los actores:
- **Administrador:** Acceso completo a todas las funcionalidades
- **Cliente:** Crear y ver solicitudes de servicio
- **Mecánico:** Ver solicitudes asignadas y actualizar estados

**Casos de uso principales:**
- Gestión de autenticación
- Gestión de usuarios
- Gestión de categorías, servicios y mecánicos
- Gestión de solicitudes de servicio
- Configuración del sistema
- Generación de reportes

### 5. `diagrama_flujo_solicitud.puml`
**Diagrama de Flujo - Proceso de Solicitud**

Ilustra el flujo completo del proceso de solicitud de servicio:
1. Cliente inicia sesión
2. Crea solicitud de servicio
3. Administrador revisa y asigna mecánico
4. Actualización de estados
5. Finalización del servicio

## Herramientas para Visualizar

Estos diagramas están en formato **PlantUML**. Para visualizarlos puedes usar:

1. **PlantUML Online:** https://plantuml.com/plantuml/uml/
2. **VS Code Extension:** Instalar "PlantUML" extension
3. **IntelliJ IDEA:** Soporte nativo para PlantUML
4. **PlantUML Server:** Servidor local para renderizar diagramas

## Cómo Usar

### Opción 1: Visualización Online
1. Copia el contenido de cualquier archivo `.puml`
2. Pégalo en https://plantuml.com/plantuml/uml/
3. El diagrama se renderizará automáticamente

### Opción 2: VS Code
1. Instala la extensión "PlantUML" en VS Code
2. Abre cualquier archivo `.puml`
3. Presiona `Alt+D` o usa el comando "PlantUML: Preview Current Diagram"

### Opción 3: Generar Imágenes
```bash
# Instalar PlantUML (requiere Java)
# Windows: choco install plantuml
# Linux: sudo apt-get install plantuml
# macOS: brew install plantuml

# Generar imagen PNG
plantuml diagrama_clases.puml

# Generar imagen SVG
plantuml -tsvg diagrama_clases.puml
```

## Notas

- Los diagramas están diseñados para ser mantenibles y actualizables
- Si se agregan nuevas clases o tablas, actualiza los diagramas correspondientes
- Los diagramas usan sintaxis estándar de PlantUML/UML

## Actualización de Diagramas

Cuando se realicen cambios en el sistema:
1. Actualiza el diagrama de clases si se agregan/modifican clases
2. Actualiza el diagrama de base de datos si cambia el esquema
3. Actualiza los casos de uso si se agregan nuevas funcionalidades
4. Actualiza los flujos si cambian los procesos de negocio
