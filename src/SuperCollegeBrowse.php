<?php
/**
 * This file is part of Jrean\SuperCollegeBrowse package.
 *
 * (c) Jean Ragouin <go@askjong.com> <www.askjong.com>
 */
namespace Jrean\SuperCollegeBrowse;

use SoapClient;
use LogicException;
use Exception;

class SuperCollegeBrowse
{
    /**
     * SOAP client instance.
     *
     * @var \SoapClient
     */
    protected $client;

    /**
     * SuperCollege API default parameters.
     *
     * @var array
     */
    protected $params = [
        "returnF"       => "",
        "apiKey"        => "",
        "siteId"        => "",
        "cat"           => "",
        "categoryId"    => "",
        "majorId"       => "",
        "sortKey"       => "0",
        "sortDirection" => "0",
        "pageSize"      => "1000",
        "pageNumber"    => "0",
    ];

    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->checkDefaultConfig();

        $this->client = $this->makeClient();

        $this->prepareParams();
    }

    /**
     * Check if mandatory config values are set in config file.
     *
     * @return void
     *
     * @throws \LogicException
     */
    protected function checkDefaultConfig()
    {
        if (is_null($this->getWsdl()) || empty($this->getWsdl())) {
            throw new LogicException("SuperCollege Browse - Wsdl not set in config file");
        }

        if (is_null($this->getApiKey()) || empty($this->getApiKey())) {
            throw new LogicException("SuperCollege Browse - Api key not set in config file");
        }

        if (is_null($this->getSiteId()) || empty($this->getSiteId())) {
            throw new LogicException("SuperCollege Browse - Site ID not set in config file");
        }

        if (is_null($this->getReturnFormat()) || empty($this->getReturnFormat())) {
            throw new LogicException("SuperCollege Browse - Return format not set in config file");
        }
    }

    /**
     * Make new SOAP client instance.
     *
     * @return \SoapClient
     */
    protected function makeClient()
    {
        $options = [
            'trace'      => true,
            'exceptions' => true,
            'encoding'   => "UTF-8",
        ];

        return new SoapClient($this->getWsdl(), $options);
    }

    /**
     * Inject authentification values in params.
     *
     * @return void
     */
    protected function prepareParams()
    {
        $this->params['returnF'] = $this->getReturnFormat();
        $this->params['apiKey']  = $this->getApiKey();
        $this->params['siteId']  = $this->getSiteId();
    }

    /**
     * Get the API Key from the config file.
     *
     * @return string|null
     */
    protected function getApiKey()
    {
        return config('supercollege_browse.api_key');
    }

    /**
     * Get the site ID from the config file.
     *
     * @return string|null
     */
    protected function getSiteId()
    {
        return config('supercollege_browse.site_id');
    }

    /**
     * Get the return format from the config file.
     *
     * @return string|null
     */
    protected function getReturnFormat()
    {
        return config('supercollege_browse.api_return_format');
    }

    /**
     * Get the wsdl from the config file.
     *
     * @return string|null
     */
    protected function getWsdl()
    {
        return config('supercollege_browse.wsdl');
    }

    /**
     * Get params.
     *
     * @return array
     */
    protected function getParams()
    {
        return $this->params;
    }

    /**
     * Get scholarships by params.
     *
     * @param  array  $params
     * @return \Illuminate\Support\Collection
     */
    public function getByParams(array $params)
    {
        $params = array_merge($this->getParams(), $params);

        return $this->getScholarships($params);
    }

    /**
     * Get scholarships.
     *
     * @param  array  $params
     * @return \Illuminate\Support\Collection
     *
     * @throws \Exception
     */
    public function getScholarships(array $params)
    {
        // @TODO Check if the params array is compliant

        try {
            $response = call_user_func_array(array($this->client, "getawards"), array_flatten($params));

            return empty($response->award) ? collect() : collect((array) $response->award->details);
        } catch (Exception $e) {
            // @TODO Implement better exception handling.
            throw new Exception($e->getMessage() . ' - SoapClient error on getawards method');
        }
    }
}
