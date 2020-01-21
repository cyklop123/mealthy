<?php


class AppController
{
    private $req_mthd;

    public function __construct()
    {
        session_start();
        $this->req_mthd = $_SERVER['REQUEST_METHOD'];
    }

    public function isPost() :bool
    {
        return $this->req_mthd === 'POST';
    }

    public function isGet() :bool
    {
        return $this->req_mthd === 'GET';
    }

    public function render(string $view=null, array $variables=[], string $controller=null)
    {
        $controller = $controller ? $controller : get_class($this);

        $dir = $view ? "Views/" . $controller . "/" . $view . ".php" : "";
        $out = "File not found";

        if(file_exists($dir))
        {
            $message='';
            $eats = [];
            extract($variables);

            ob_start();
            include $dir;
            $out = ob_get_clean();
        }
        print $out;
    }
}