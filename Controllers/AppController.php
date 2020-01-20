<?php


class AppController
{
    private $req_mthd;

    public function __construct()
    {
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

    public function render(string $view=null, array $variables=[])
    {
        $dir = $view ? "Views/" . get_class($this) . "/" . $view . ".php" : "";
        $out = "File not found";

        if(file_exists($dir))
        {
            extract($variables);

            ob_start();
            include $dir;
            $out = ob_get_clean();
        }
        print $out;
    }
}