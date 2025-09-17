function artisan { docker compose exec app php artisan $args }
function composer { docker compose exec app composer $args }
function npm { docker compose exec app npm $args }

function docker-bash {
    param(
        [string]$container = "cronosena_app"   # Cambia "cronosena_app" por otro contenedor si es necesario ejm: cronosena_db
    )
    docker exec -it $container bash
}
