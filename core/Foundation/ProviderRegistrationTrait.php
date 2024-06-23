<?php
namespace Core\Foundation;

trait ProviderRegistrationTrait{

    //TODO убрать force
    public function register($provider, $force = false)
    {
        $registered  = array_values($this->getProviders($provider))[0] ?? null;

        //если сервис провайдер уже зарегистрирован, то возвращаем его
        if ($registered && !$force) {
            return $registered;
        }

        //если строка, то делаем класс
        if (is_string($provider)) $provider = new $provider($this);

        //вызываем метод register в сервис провайдере
        $provider->register();

        //регистрация простых связываний в сервис провайдере
        if (property_exists($provider, 'bindings')) {
            foreach ($provider->bindings as $key => $value) {
                $this->bind($key, $value);
            }
        }

        if (property_exists($provider, 'singletons')) {
            foreach ($provider->singletons as $key => $value) {
                $key = is_int($key) ? $value : $key;
                $this->singleton($key, $value);
            }
        }
        //помещаем провайдер в $serviceProviders и $loadedProviders
        $this->markAsRegistered($provider);

        // If the application has already booted, we will call this boot method on
        // the provider class so it has an opportunity to do its boot logic and
        // will be ready for any usage by this developer's application logic.
        if ($this->isBooted()) {
            $this->bootProvider($provider);
        }

        return $provider;
    }

    public function getProviders($provider)
    {
        $name = is_string($provider) ? $provider : get_class($provider);
        return array_filter($this->serviceProviders, fn ($value) => $value instanceof $name, ARRAY_FILTER_USE_BOTH);
    }

    public function isBooted()
    {
        return $this->booted;
    }

    protected function bootProvider(ServiceProvider $provider): void
    {
        $provider->callBootingCallbacks();

        if (method_exists($provider, 'boot')) {
            $this->call([$provider, 'boot']);
        }

        $provider->callBootedCallbacks();
    }

    protected function markAsRegistered($provider)
    {
        $this->serviceProviders[] = $provider;
        $this->loadedProviders[get_class($provider)] = true;
    }
}