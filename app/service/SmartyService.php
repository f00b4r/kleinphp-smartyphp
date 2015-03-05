<?php

final class SmartyService
{

    /** @var string */
    private $cacheDir;

    /** @var string */
    private $compileDir;

    /** @var bool */
    private $debugging;

    /** @var bool */
    private $caching;

    /** @var int */
    private $cachingLifetime;

    /**
     * @param string $cacheDir
     */
    public function setCacheDir($cacheDir)
    {
        $this->cacheDir = $cacheDir;
    }

    /**
     * @param string $compileDir
     */
    public function setCompileDir($compileDir)
    {
        $this->compileDir = $compileDir;
    }

    /**
     * @param boolean $debugging
     */
    public function setDebugging($debugging)
    {
        $this->debugging = $debugging;
    }

    /**
     * @param boolean $caching
     */
    public function setCaching($caching)
    {
        $this->caching = $caching;
    }

    /**
     * @param int $cachingLifetime
     */
    public function setCachingLifetime($cachingLifetime)
    {
        $this->cachingLifetime = $cachingLifetime;
    }

    /**
     * @return Smarty
     */
    public function create()
    {
        $smarty = new Smarty();

        $smarty->setCacheDir($this->cacheDir);
        $smarty->setCompileDir($this->compileDir);
        $smarty->debugging = $this->debugging;

        if ($this->caching) {
            $smarty->caching = $this->caching;
            $smarty->cache_lifetime = $this->cachingLifetime;
        }

        return $smarty;
    }
}