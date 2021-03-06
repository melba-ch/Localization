<?php namespace Arcanedev\Localization\Entities;

use Arcanedev\Support\Collection;

/**
 * Class     LocaleCollection
 *
 * @package  Arcanedev\Localization\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LocaleCollection extends Collection
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Supported locales.
     *
     * @var array
     */
    protected $supported = [];

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Set supported locales keys.
     *
     * @param  array  $supported
     *
     * @return self
     */
    public function setSupportedKeys(array $supported)
    {
        $this->supported = $supported;

        return $this;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the first locale from the collection.
     *
     * @param  callable|null  $callback
     * @param  mixed          $default
     *
     * @return \Arcanedev\Localization\Entities\Locale|mixed
     */
    public function first(callable $callback = null, $default = null)
    {
        return parent::first($callback, $default);
    }

    /**
     * Get supported locales collection.
     *
     * @return self
     */
    public function getSupported()
    {
        return $this->filter(function(Locale $locale) {
            return in_array($locale->key(), $this->supported);
        });
    }

    /**
     * Load from config.
     *
     * @return self
     */
    public function loadFromConfig()
    {
        $this->loadFromArray(
            config('localization.locales', [])
        );
        $this->setSupportedKeys(
            config('localization.supported-locales', [])
        );

        return $this;
    }

    /**
     * Load locales from array.
     *
     * @param  array  $locales
     *
     * @return self
     */
    public function loadFromArray(array $locales)
    {
        $this->reset();

        foreach ($locales as $key => $locale) {
            $this->put($key, Locale::make($key, $locale));
        }

        return $this;
    }
}
