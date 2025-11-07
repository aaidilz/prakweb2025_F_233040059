<?php


class App
{
    // property
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    // method
    public function __construct()
    {
        $url = $this->parseURL();
        if ($url && isset($url[0]) && !empty($url[0])) {
            // controler
            if (file_exists(__DIR__ . '/../controllers/' . ucfirst($url[0]) . '.php')) {
                // jadi kontroler
                $this->controller = ucfirst($url[0]);
                // hilangin array ke 0
                unset($url[0]);
            }
        }
        require_once __DIR__ . '/../controllers/' . $this->controller . '.php';

        // mereka dapat controller dari sini buat di intansiasi
        $this->controller = new $this->controller;

        // method
        if (isset($url[1])) {
            // dari intansiasi controler atas
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // parameter
        if (!empty($url)) {
            // var_dump($url);
            $this->params = array_values($url);
        }

        // jalankan controller dan method serta params jika ada

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseURL()
    {
        if (isset($_GET['url'])) {
            // slash akhir jangan ada
            $url = rtrim($_GET['url'], '/');
            // bersihin
            $url = filter_var($url, FILTER_SANITIZE_URL);
            // jika url kosong, return null agar menggunakan controller default
            if (empty($url)) {
                return null;
            }
            $url = explode('/', $url);
            return $url;
        }
    }
}
