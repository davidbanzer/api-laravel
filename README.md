# API Laravel
API Realizada con Laravel, repasando los conceptos básicos.
La API consta de:
- Una relación 1 a 1 (User y Profile)
- Una relación 1 a n (Post y Comment)
- Una relación n a n (Company y Service)

Comandos Artisan:
1. Crear Controlador
```
php artisan make:controller NombreControlador
```
2. Crear Modelo
```
php artisan make:model NombreModelo
```
3. Crear Migración
```
php artisan make:migration nombre_migracion
```
4. Crear Modelo, Migración y Controlador
```
php artisan make:model Model -mcr
```
5. Ejecutar Migraciones
```
php artisan migrate
```
6. Correr el Servidor
```
php artisan serve
```
