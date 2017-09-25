<?php
namespace Common\Model;

/**
 * http 类
 *
 * 封装 https://github.com/joomla-framework/http/blob/master/src/Transport/Curl.php 类
 */
class HttpModel
{
    /**
     * 默认超时时间
     * 单位:秒
     * @var unknown
     */
    private $timeout = 15;

    /**
     * 请求方的agent标识符
     * @var unknown
     */
    private $useragent = null;

    /**
     * 请求响应
     * @var unknown
     */
    private $response = '';


    /**
     * 设置ca证书路径
     * @var unknown
     */
    private $curlopt_cainfo = '';


    /**
     * get 请求
     * @param   string $url The URI to the resource to request.
     * @param   array $headers An array of request headers to send with the request.
     */
    public function get($url, $headers = array())
    {
        $this->response = $this->request('GET', $url, null, $headers);

        return $this->response->body;
    }

    /**
     * post 请求
     * @param   string $url The URI to the resource to request.
     * @param   mixed $data Either an associative array or a string to be sent with the request.
     * @param   array $headers An array of request headers to send with the request.
     */
    public function post($url, $data, $headers = array())
    {
        $this->response = $this->request('POST', $url, $data, $headers);

        return $this->response->body;
    }

    /**
     * 获取相应
     */
    public function getResponseCode()
    {
        return isset($this->response->code) ? $this->response->code : null;
    }

    /**
     * 获取返回头部的值
     */
    public function getResponseHeaders()
    {
        return isset($this->response->headers) ? $this->response->headers : null;
    }

    /**
     * 设置请求超时时间
     * @param unknown $seconds
     * @return \Common\Model\HttpModel
     */
    public function setTimeout($seconds)
    {
        $this->timeout = (int)$seconds;

        return $this;
    }

    /**
     * The optional user agent string to send with the request.
     * @param unknown $agent
     * @return \Common\Model\HttpModel
     */
    public function setUserAgent($agent)
    {
        $this->useragent = (string)$agent;

        return $this;
    }

    /**
     * 设置ca证书路径
     * @param unknown $path
     */
    public function setCA($path)
    {
        $this->curlopt_cainfo = realpath($path);
        if (!is_file($this->curlopt_cainfo)) {
            throw new \Exception("{$path} is a not valid file");
        }

        return $this;
    }

    /**
     * 发送请求
     * @from https://github.com/joomla-framework/http/blob/master/src/Transport/Curl.php
     *
     * @param   string $method The HTTP method for sending the request.
     * @param   string $url The URI to the resource to request.
     * @param   mixed $data Either an associative array or a string to be sent with the request.
     * @param   array $headers An array of request headers to send with the request.
     *
     * @return  Response
     * @since   1.0
     * @throws  \RuntimeException
     */
    public function request($method, $url, $data = null, array $headers = null)
    {
        // Setup the cURL handle.
        $ch = curl_init();
        // Set the request method.
        $options[CURLOPT_CUSTOMREQUEST] = strtoupper($method);

        // Don't wait for body when $method is HEAD
        $options[CURLOPT_NOBODY] = ($method === 'HEAD');

        // If data exists let's encode it and make sure our Content-type header is set.
        if (isset($data)) {

            // If the data is a scalar value simply add it to the cURL post fields.
            if (is_scalar($data) || (isset($headers['Content-Type']) && strpos($headers['Content-Type'], 'multipart/form-data') === 0)) {
                $options[CURLOPT_POSTFIELDS] = $data;
            } else // Otherwise we need to encode the value first.
            {
                $options[CURLOPT_POSTFIELDS] = http_build_query($data);
            }

            if (!isset($headers['Content-Type'])) {
                $headers['Content-Type'] = 'application/x-www-form-urlencoded; charset=utf-8';
            }

            // Add the relevant headers.
            if (is_scalar($options[CURLOPT_POSTFIELDS])) {
                $headers['Content-Length'] = strlen($options[CURLOPT_POSTFIELDS]);
            }
        }

        // Build the headers string for the request.
        $headerArray = array();

        if (isset($headers)) {
            foreach ($headers as $key => $value) {
                $headerArray[] = $key . ': ' . $value;
            }

            // Add the headers string into the stream context options array.
            $options[CURLOPT_HTTPHEADER] = $headerArray;
        }

        if (isset($this->timeout)) {
            $options[CURLOPT_TIMEOUT] = (int)$this->timeout;
            $options[CURLOPT_CONNECTTIMEOUT] = (int)$this->timeout;
        }

        // If an explicit user agent is given use it.
        if (isset($this->useragent) && $this->useragent) {
            $options[CURLOPT_USERAGENT] = $this->useragent;
        }

        // Set the request URL.
        $options[CURLOPT_URL] = (string)$url;

        // We want our headers. :-)
        $options[CURLOPT_HEADER] = true;

        //for https @hack by wandaijin
        if (stripos($url, 'https://') === 0) {
            $options[CURLOPT_SSL_VERIFYPEER] = true;
            $options[CURLOPT_SSL_VERIFYHOST] = 2;
            $options[CURLOPT_CAINFO] = $this->curlopt_cainfo;
        }

        // Return it... echoing it would be tacky.
        $options[CURLOPT_RETURNTRANSFER] = true;

        // Override the Expect header to prevent cURL from confusing itself in its own stupidity.
        // Link: http://the-stickman.com/web-development/php-and-curl-disabling-100-continue-header/
        $options[CURLOPT_HTTPHEADER][] = 'Expect:';

        // Set any custom transport options
        if (isset($this->options)) {
            foreach ($this->options as $key => $value) {
                $options[$key] = $value;
            }
        }

        // Set the cURL options.
        curl_setopt_array($ch, $options);

        // Execute the request and close the connection.
        $content = curl_exec($ch);

        // Check if the content is a string. If it is not, it must be an error.
        if (!is_string($content)) {
            $message = curl_error($ch);

            if (empty($message)) {
                // Error but nothing from cURL? Create our own
                $message = 'No HTTP response received';
            }

            throw new \Exception($message);
        }

        // Get the request information.
        $info = curl_getinfo($ch);

        // Close the connection.
        curl_close($ch);

        return $this->getResponse($content, $info);
    }

    /**
     * Method to get a response object from a server response.
     *
     * @param   string $content The complete server response, including headers
     *                            as a string if the response has no errors.
     * @param   array $info The cURL request information.
     *
     * @return  Response
     *
     * @since   1.0
     * @throws  \UnexpectedValueException
     */
    protected function getResponse($content, $info)
    {
        // Create the response object.
        $return = new \stdClass();

        // Get the number of redirects that occurred.
        $redirects = isset($info['redirect_count']) ? $info['redirect_count'] : 0;

        /*
         * Split the response into headers and body. If cURL encountered redirects, the headers for the redirected requests will
         * also be included. So we split the response into header + body + the number of redirects and only use the last two
         * sections which should be the last set of headers and the actual body.
         */
        $response = explode("\r\n\r\n", $content, 2 + $redirects);

        // Set the body for the response.
        $return->body = array_pop($response);

        // Get the last set of response headers as an array.
        $headers = explode("\r\n", array_pop($response));

        // Get the response code from the first offset of the response headers.
        preg_match('/[0-9]{3}/', array_shift($headers), $matches);

        $code = count($matches) ? $matches[0] : null;

        if (is_numeric($code)) {
            $return->code = (int)$code;
        } // No valid response code was detected.
        else {
            throw new \Exception('No HTTP response code found.');
        }

        // Add the response headers to the response object.
        foreach ($headers as $header) {
            $pos = strpos($header, ':');
            $return->headers[trim(substr($header, 0, $pos))] = trim(substr($header, ($pos + 1)));
        }

        return $return;
    }
}