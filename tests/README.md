# Pruebas Unitarias - Custom Club Suite

Este directorio contiene las pruebas unitarias para el proyecto Custom Club Suite.

## Instalación

### Requisitos
- PHP >= 7.4
- Composer
- PHPUnit >= 9.5

### Pasos de instalación

1. Instalar las dependencias de Composer:
```bash
composer install
```

O si Composer está instalado globalmente:
```bash
composer require --dev phpunit/phpunit
```

## Archivos de Pruebas

1. **DBConnectionTest.php** - Pruebas para la clase DBConnection
   - Verificación de existencia de clase
   - Pruebas de conexión a base de datos
   - Validación de propiedades

2. **SystemSettingsTest.php** - Pruebas para la clase SystemSettings
   - Pruebas de métodos de sesión (set_userdata, userdata, flashdata)
   - Pruebas de destrucción de sesión
   - Validación de herencia

3. **UsersTest.php** - Pruebas para la clase Users
   - Validación de métodos existentes
   - Pruebas de hash de contraseñas (MD5)
   - Validación de lógica de datos

4. **MasterTest.php** - Pruebas para la clase Master
   - Validación de métodos CRUD
   - Pruebas de codificación HTML
   - Validación de construcción de queries SQL

5. **UtilityFunctionsTest.php** - Pruebas para funciones de utilidad
   - Pruebas de validación de imágenes
   - Detección de dispositivos móviles
   - Validación de constantes del sistema

6. **SessionTest.php** - Pruebas para funcionalidad de sesiones
   - Pruebas de inicio de sesión
   - Pruebas de almacenamiento y recuperación de datos
   - Pruebas de flashdata y system_info

## Ejecutar las Pruebas

### Ejecutar todas las pruebas:
```bash
./vendor/bin/phpunit
```

O si PHPUnit está instalado globalmente:
```bash
phpunit
```

### Ejecutar una prueba específica:
```bash
./vendor/bin/phpunit tests/DBConnectionTest.php
```

### Ejecutar con cobertura de código:
```bash
./vendor/bin/phpunit --coverage-html coverage
```

### Ejecutar con formato verbose:
```bash
./vendor/bin/phpunit --verbose
```

## Notas

- Algunas pruebas pueden requerir conexión a la base de datos. Si la base de datos no está disponible, estas pruebas se marcarán como "skipped".
- Las pruebas de sesión requieren que las sesiones estén habilitadas en PHP.
- Asegúrate de que las constantes de configuración estén definidas correctamente (ver `initialize.php`).

## Estructura

```
tests/
├── bootstrap.php           # Archivo de inicialización para PHPUnit
├── DBConnectionTest.php    # Pruebas para DBConnection
├── SystemSettingsTest.php  # Pruebas para SystemSettings
├── UsersTest.php          # Pruebas para Users
├── MasterTest.php         # Pruebas para Master
├── UtilityFunctionsTest.php # Pruebas para funciones de utilidad
├── SessionTest.php        # Pruebas para sesiones
└── README.md             # Este archivo
```

## Configuración

El archivo `phpunit.xml` en la raíz del proyecto contiene la configuración de PHPUnit, incluyendo:
- Bootstrap file
- Directorios de pruebas
- Configuración de cobertura de código
