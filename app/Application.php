<?php

class Application
{
    /** @var Smarty */
    private $smarty;

    /** @var string */
    private $templateExtension = '.tpl';

    /** @var */
    private $applicationDir;

    /** @var bool */
    private $rendered = FALSE;

    /**
     * @param  $applicationDir
     */
    public function setApplicationDir($applicationDir)
    {
        $this->applicationDir = $applicationDir;
    }

    /**
     * @return
     */
    public function getApplicationDir()
    {
        return $this->applicationDir;
    }

    /**
     * @param \Smarty $smarty
     */
    public function setSmarty($smarty)
    {
        $this->smarty = $smarty;
    }

    /**
     * @return \Smarty
     */
    public function getSmarty()
    {
        return $this->smarty;
    }

    /**
     * @param string $templateExtension
     */
    public function setTemplateExtension($templateExtension)
    {
        $this->templateExtension = $templateExtension;
    }

    /**
     * @return string
     */
    public function getTemplateExtension()
    {
        return $this->templateExtension;
    }

    /**
     * @return boolean
     */
    public function isRendered()
    {
        return $this->rendered;
    }

    /**
     * Boot application
     */
    public function boot()
    {
        // Create smarty
        $this->smarty = new Smarty();

        // Setup smarty dirs
        $this->smarty->setTemplateDir(APP_DIR . '/templates');
        $this->smarty->setCompileDir(TEMP_DIR . '/compiled');
        $this->smarty->setConfigDir(APP_DIR . '/configs');
        $this->smarty->setCacheDir(TEMP_DIR . '/cache');

        // Production vs development?
        $this->smarty->debugging = TRUE;
    }

    /**
     * Process requests
     */
    public function run()
    {
        $app = $this;

        // Application routes

        respond($this->applicationDir . '/[:name]', function ($request, $response) use ($app) {
            $app->render($app->formateTemplateName($request->name));
        });
        respond($this->applicationDir . '/', function () use ($app) {
            $app->render($app->formateTemplateName());
        });
        dispatch();

        // Error route

        if ($this->rendered === FALSE) {
            $app->render($app->formateTemplateName('error'));
        }
    }

    /**
     * @param $template
     * @return void
     */
    public function render($template)
    {
        $this->rendered = TRUE;
        $this->smarty->display($template);
    }

    /**
     * @param string|null $name
     * @return string
     */
    public function formateTemplateName($name = NULL)
    {
        if (empty($name) || $name == '') {
            return 'homepage' . $this->templateExtension;
        }

        $name = preg_replace('#[^a-z0-9' . preg_quote(NULL, '#') . ']+#i', '-', $name);
        $name = trim($name, '-');

        return $name . $this->templateExtension;
    }

}