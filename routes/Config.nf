project Web4 {

    app {
        name        "Web4"
        version     "1.0.0"
        environment production
    }

    routes {

        GET "/" {
            view home
            title "Web4"
        }

        GET "/docs" {
            view docs
        }

        GET "/ai" {
            controller AIController@index
        }

        GET "/marketplace" {
            controller MarketplaceController@index
        }

        GET "/dashboard" {
            middleware auth
            controller DashboardController@index
        }

        fallback {
            status 404
            view errors.404
        }
    }

    api v1 {

        GET "/chat" {
            controller Api\ChatController@index
        }

        POST "/chat" {
            controller Api\ChatController@store
        }

        GET "/models" {
            controller Api\ModelController@index
        }
    }

    commands {

        command web4:doctor {
            description "Run diagnostics"

            check php
            check laravel
            check database
            check redis
            check storage
        }

        command web4:build {
            run docs.generate
            run assets.compile
            run cache.optimize
        }

        command web4:deploy {
            run migrate
            run cache.optimize
            run queue.restart
        }
    }

    middleware {

        auth
        guest
        throttle
        verified
        csrf
    }

    schedule {

        everyMinute {
            command web4:doctor
        }

        daily {
            command web4:build
        }
    }

    docs {

        title "Web4 Documentation"

        pages {
            home
            installation
            architecture
            api
            sdk
            blockchain
            ai
        }
    }

    database {

        driver postgres

        migrations auto

        seeders auto
    }

    cache {

        driver redis
    }
}
