# 🚀 Guía de Prueba del Schema GraphQL - Servicio Ministerios

## ✅ Verificación del Schema

El schema GraphQL ha sido verificado y **está funcionando correctamente**. 

### Cambios Realizados

1. **Modelo Ministerio Corregido**: Se cambió la clase base de `Illuminate\Database\Eloquent\Model` a `MongoDB\Laravel\Eloquent\Model` para compatibilidad con MongoDB.

```php
// Antes (INCORRECTO)
use Illuminate\Database\Eloquent\Model;
class Ministerio extends Model

// Ahora (CORRECTO)
use MongoDB\Laravel\Eloquent\Model;
class Ministerio extends Model
```

### Verificación del Schema

```bash
php artisan lighthouse:validate-schema
```

**Resultado**: ✅ `The defined schema is valid.`

## 📋 Schema GraphQL Definido

El schema incluye las siguientes operaciones:

### Queries (Consultas)

1. **ministerios**: Obtener todos los ministerios
   ```graphql
   {
     ministerios {
       id
       nombre
       fecha_creacion
       descripcion
       miembro_id
     }
   }
   ```

2. **ministerio**: Obtener un ministerio por ID
   ```graphql
   {
     ministerio(id: "ID_AQUI") {
       id
       nombre
       fecha_creacion
       descripcion
       miembro_id
     }
   }
   ```

### Mutations (Mutaciones)

1. **createMinisterio**: Crear un nuevo ministerio
   ```graphql
   mutation {
     createMinisterio(
       nombre: "Ministerio de Prueba"
       fecha_creacion: "2025-01-28T00:00:00Z"
       descripcion: "Descripción del ministerio"
       miembro_id: "miembro123"
     ) {
       id
       nombre
       fecha_creacion
       descripcion
       miembro_id
     }
   }
   ```

2. **updateMinisterio**: Actualizar un ministerio existente
   ```graphql
   mutation {
     updateMinisterio(
       id: "ID_AQUI"
       nombre: "Ministerio Actualizado"
     ) {
       id
       nombre
       fecha_creacion
       descripcion
       miembro_id
     }
   }
   ```

3. **deleteMinisterio**: Eliminar un ministerio
   ```graphql
   mutation {
     deleteMinisterio(id: "ID_AQUI") {
       id
       nombre
     }
   }
   ```

## 🌐 Cómo Probar el Schema en la Web

### Opción 1: Interfaz de Prueba Local (Recomendado)

Se ha creado una interfaz HTML interactiva para probar el schema:

1. **Iniciar el servidor Laravel**:
   ```bash
   php artisan serve --host=127.0.0.1 --port=8000
   ```

2. **Abrir en el navegador**:
   ```
   http://localhost:8000/graphql-test.html
   ```

3. **Características de la interfaz**:
   - ✅ Pestañas para Queries, Mutations e Introspección
   - ✅ Ejemplos pre-cargados para cada tipo de operación
   - ✅ Resultados formateados con colores (éxito/error)
   - ✅ Click en ejemplos para cargar automáticamente
   - ✅ Atajos de teclado (Ctrl+Enter para ejecutar)

### Opción 2: GraphQL Playground

1. **Instalar GraphQL Playground** (si no está instalado):
   ```bash
   # Opción A: Extensión de VS Code
   # Instalar extensión "GraphQL Playground"
   
   # Opción B: npm global
   npm install -g graphql-playground-electron
   ```

2. **Iniciar Playground**:
   ```bash
   graphql-playground-electron
   ```

3. **Configurar endpoint**:
   - URL: `http://localhost:8000/graphql`

### Opción 3: Postman

1. **Crear nueva petición POST**
2. **URL**: `http://localhost:8000/graphql`
3. **Headers**:
   ```
   Content-Type: application/json
   Accept: application/json
   ```
4. **Body (raw JSON)**:
   ```json
   {
     "query": "{ ministerios { id nombre fecha_creacion descripcion miembro_id } }"
   }
   ```

### Opción 4: cURL

```bash
# Query simple
curl -X POST http://localhost:8000/graphql \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{"query":"{ ministerios { id nombre fecha_creacion descripcion miembro_id } }"}'

# Mutation
curl -X POST http://localhost:8000/graphql \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{"query":"mutation { createMinisterio(nombre: \"Test\", fecha_creacion: \"2025-01-28T00:00:00Z\", descripcion: \"Test desc\", miembro_id: \"123\") { id nombre } }"}'
```

### Opción 5: Altair GraphQL Client

1. **Descargar**: https://altair.sirmuel.design/
2. **Instalar** la aplicación desktop
3. **Configurar endpoint**: `http://localhost:8000/graphql`

## 🔍 Introspección del Schema

Para explorar el schema completo:

```graphql
{
  __schema {
    types {
      name
      fields {
        name
        type {
          name
        }
      }
    }
    queryType {
      name
      fields {
        name
        description
        args {
          name
          type {
            name
          }
        }
      }
    }
    mutationType {
      name
      fields {
        name
        description
        args {
          name
          type {
            name
          }
        }
      }
    }
  }
}
```

## ⚙️ Configuración Verificada

✅ **Lighthouse GraphQL**: Instalado (versión 6.63)  
✅ **MongoDB Laravel**: Instalado (versión 5.5)  
✅ **Schema GraphQL**: Válido  
✅ **Modelo Ministerio**: Compatible con MongoDB  
✅ **Ruta GraphQL**: `/graphql` registrada  
✅ **Base de datos**: Configurada (MongoDB Atlas)

## 🐛 Solución de Problemas

### Error: "Connection refused"
- Verifica que el servidor esté corriendo: `php artisan serve`
- Verifica el puerto: por defecto es `8000`

### Error: "Class not found"
- Regenera autoload: `composer dump-autoload`

### Error: "Schema cache"
- Limpia la caché: `php artisan lighthouse:clear-schema-cache`

### Error: MongoDB Connection
- Verifica la configuración en `.env`:
  ```
  DB_CONNECTION=mongodb
  DB_DSN=mongodb+srv://...
  DB_DATABASE=software2
  ```

## 📝 Notas Importantes

1. **MongoDB**: El proyecto usa MongoDB, no SQL. Las IDs son strings.
2. **Directivas Lighthouse**: Se usan `@all`, `@find`, `@create`, `@update`, `@delete`
3. **Validación**: Las reglas de validación se aplican automáticamente
4. **Fecha**: El formato debe ser ISO 8601: `"2025-01-28T00:00:00Z"`

## 🎯 Próximos Pasos

1. Probar todas las operaciones (Queries y Mutations)
2. Verificar que los datos se guarden correctamente en MongoDB
3. Agregar más tipos si es necesario
4. Considerar agregar autenticación si es requerido
5. Agregar paginación si hay muchos datos

---

**¡El schema GraphQL está listo para usar! 🎉**



