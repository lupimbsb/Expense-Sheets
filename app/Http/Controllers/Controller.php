<?php

namespace Gastos\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getDomainFromUrl($url) {
        $host = parse_url($url, PHP_URL_HOST);
        // If the URL can't be parsed, use the original URL
        // Change to "return false" if you don't want that
        if (!$host)
            $host = $url;
        // You might also want to limit the length if screen space is limited
        return $host;
    }

    public function conect($url, $cookieName = 0, $downloadFile = 0, $createCookie = 0, $post = 0, $referer = 0, $timeout = 50) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($post) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }
        if ($referer) {
            curl_setopt($ch, CURLOPT_AUTOREFERER, true);
            curl_setopt($ch, CURLOPT_REFERER, $referer);
        }

        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

        if ($createCookie) {
            curl_setopt($ch, CURLOPT_COOKIEJAR, "/home/hosting/geralink/tmpck/" . $cookieName);
        } else
            if ($cookieName) {
                curl_setopt($ch, CURLOPT_COOKIEFILE, "/home/hosting/geralink/tmpck/" . $cookieName);
            }

        if ($downloadFile) {
            $fp = fopen($this->storage . $this->fileName, 'w+');
            // write curl response to file
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            $result = curl_exec($ch);
            curl_close($ch);
            fclose($fp);
        } else {

            $result = curl_exec($ch);
            curl_close($ch);
        }
        return $result;
    }
}
