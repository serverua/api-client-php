<?php
namespace Omnilance;

class Api
{

    private $url = "https://api.omnilance.com";
    private $api_version = '3';
    private $apikey;
    private $secretly;

    public function __construct($apikey, $secretly, $url = Null, $version = Null)
    {
        $this->apikey = $apikey;
        $this->secretly = $secretly;

        if (!empty($url))
            $this->url = $url;

        if (!empty($version))
            $this->api_version = $version;
    }

    /**
     * @param $cmd
     * @param array $data
     * @param string $request_type
     * @return mixed
     */
    private function Request($cmd, $data = [], $request_type = 'GET')
    {
        $endPoint = implode('/', [$this->url, "v" . $this->api_version, $cmd]);

        if ($request_type != 'GET') {
            $payLoad = json_encode($data);
        } else {
            $payLoad = '';
        }

        $sign = hash_hmac('sha256', $this->apikey . $endPoint . $payLoad, $this->secretly);

        $defaults = [
            CURLOPT_URL => $endPoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $request_type,
            CURLOPT_POSTFIELDS => $payLoad,
            CURLOPT_HTTPHEADER => [
                "X-OMNI-APIKEY: {$this->apikey}",
                "X-OMNI-SIGNATURE: $sign",
                "content-type: application/json"
            ]
        ];

        $ch = curl_init();
        curl_setopt_array($ch, $defaults);
        if (!$result = curl_exec($ch)) {
            trigger_error(curl_error($ch));
        }
        curl_close($ch);

        $response = json_decode($result);
        return $response;
    }

    /**
     * Customer Balance
     * @return mixed
     */
    public function customerBalance()
    {
        $response = $this->Request("balance");
        return $response;
    }

    /**
     * Check Availability
     * @param $domains_data
     * @return mixed
     */
    public function domainCheck($domains_data)
    {
        $response = $this->Request("domains/checkAvailability" ,$domains_data, "POST");
        return $response;
    }

    /**
     * Register Domain
     * @param $domains_data
     * @return mixed
     */
    public function createDomain($domains_data)
    {
        $response = $this->Request("domains/createDomain" ,$domains_data, "POST");
        return $response;
    }

    /**
     * List Domains
     * @return mixed
     */
    public function domains()
    {
        $response = $this->Request("domains");
        return $response;
    }

    /**
     * Getting Details Domain
     * @param $domain_name
     * @return mixed
     */
    public function getDomain($domain_name)
    {
        $response = $this->Request("domains/getDomain/". $domain_name);
        return $response;
    }

    /**
     * Renew Domain
     * @param $domain_data
     * @return mixed
     */
    public function renewDomain($domain_data)
    {
        $response = $this->Request("domains/renewDomain/". $domain_data['domain']['domainName'] ,$domain_data, "POST");
        return $response;
    }

    /**
     * Modify Name Servers
     * @param $domain_data
     * @return mixed
     */
    public function setNameservers($domain_data)
    {
        $response = $this->Request("domains/setNameservers/". $domain_data['domainName'] ,$domain_data, "POST");
        return $response;
    }

    /**
     * Enable Transfer Prohibited
     * @param $domain_data
     * @return mixed
     */
    public function lockTransfer($domain_data)
    {
        $response = $this->Request("domains/lockTransfer/". $domain_data['domainName'] ,$domain_data, "POST");
        return $response;
    }

    /**
     * Disable Transfer Prohibited
     * @param $domain_data
     * @return mixed
     */
    public function unlockTransfer($domain_data)
    {
        $response = $this->Request("domains/unlockTransfer/". $domain_data['domainName'] ,$domain_data, "POST");
        return $response;
    }

    /**
     * Suspend Domain
     * @param $domain_data
     * @return mixed
     */
    public function lock($domain_data)
    {
        $response = $this->Request("domains/lock/". $domain_data['domainName'] ,$domain_data, "POST");
        return $response;
    }

    /**
     * Unsuspend Domain
     * @param $domain_data
     * @return mixed
     */
    public function unlock($domain_data)
    {
        $response = $this->Request("domains/unlock/". $domain_data['domainName'] ,$domain_data, "POST");
        return $response;
    }

    /**
     * Enable lockUpdate
     * @param $domain_data
     * @return mixed
     */
    public function lockUpdate($domain_data)
    {
        $response = $this->Request("domains/lockUpdate/". $domain_data['domainName'] ,$domain_data, "POST");
        return $response;
    }

    /**
     * Disable lockUpdate
     * @param $domain_data
     * @return mixed
     */
    public function unlockUpdate($domain_data)
    {
        $response = $this->Request("domains/unlockUpdate/". $domain_data['domainName'] ,$domain_data, "POST");
        return $response;
    }

    /**
     * Enable AutoRenew
     * @param $domain_data
     * @return mixed
     */
    public function enableAutorenew($domain_data)
    {
        $response = $this->Request("domains/enableAutorenew/". $domain_data['domainName'] ,$domain_data, "POST");
        return $response;
    }

    /**
     * Disable AutoRenew
     * @param $domain_data
     * @return mixed
     */
    public function disableAutorenew($domain_data)
    {
        $response = $this->Request("domains/disableAutorenew/". $domain_data['domainName'] ,$domain_data, "POST");
        return $response;
    }

    /**
     * Adding GlueRecords
     * @param $domain_data
     * @return mixed
     */
    public function glueRecords($domain_data)
    {
        $response = $this->Request("domains/glueRecords/". $domain_data['domainName'] ,$domain_data, "POST");
        return $response;
    }

    /**
     * Modify GlueRecords
     * @param $domain_data
     * @return mixed
     */
    public function modifyGlueRecords($domain_data)
    {
        $response = $this->Request("domains/glueRecords/". $domain_data['domainName'] . '/' . $domain_data['hostname'], $domain_data, "PUT");
        return $response;
    }

    /**
     * Delete GlueRecords
     * @param $domain_data
     * @return mixed
     */
    public function deleteGlueRecords($domain_data)
    {
        $response = $this->Request("domains/glueRecords/". $domain_data['domainName'] . '/' . $domain_data['hostname'], $domain_data, "DELETE");
        return $response;
    }

    /**
     * List GlueRecords
     * @param $domain_name
     * @return mixed
     */
    public function listGlueRecords($domain_name)
    {
        $response = $this->Request("domains/glueRecords/". $domain_name);
        return $response;
    }

    /**
     * Get GlueRecords
     * @param $domain_name
     * @param $host_name
     * @return mixed
     */
    public function getGlueRecords($domain_name, $host_name)
    {
        $response = $this->Request("domains/glueRecords/". $domain_name . '/' . $host_name);
        return $response;
    }

    /**
     * Request Domain Transfer
     * @param $domain_data
     * @return mixed
     */
    public function requestTransfer($domain_data)
    {
        $response = $this->Request("domains/requestTransfer" ,$domain_data, "POST");
        return $response;
    }

    /**
     * Reject Domain Transfer
     * @param $domain_name
     * @return mixed
     */
    public function rejectTransfer($domain_name)
    {
        $response = $this->Request("domains/rejectTransfer/". $domain_name, [],"POST");
        return $response;
    }

    /**
     * Cancel Domain Transfer
     * @param $domain_name
     * @return mixed
     */
    public function cancelTransfer($domain_name)
    {
        $response = $this->Request("domains/cancelTransfer/". $domain_name, [], "POST");
        return $response;
    }

    /**
     * Approve Domain Transfer
     * @param $domain_name
     * @return mixed
     */
    public function approveTransfer($domain_name)
    {
        $response = $this->Request("domains/approveTransfer/". $domain_name, [], "POST");
        return $response;
    }

    /**
     * Modify AuthCode
     * @param $domain_data
     * @param $domain_name
     * @return mixed
     */
    public function setAuthcode($domain_name, $domain_data)
    {
        $response = $this->Request("domains/setAuthcode/". $domain_name, $domain_data, "POST");
        return $response;
    }

    /**
     * Get AuthCode
     * @param $domain_name
     * @return mixed
     */
    public function getAuthcode($domain_name)
    {
        $response = $this->Request("domains/getAuthcode/". $domain_name);
        return $response;
    }

    /**
     * Modifying Contacts
     * @param $domain_data
     * @return mixed
     */
    public function setContacts($domain_data)
    {
        $response = $this->Request("domains/setContacts/". $domain_data['domainName'], $domain_data, "POST");
        return $response;
    }

    /**
     * Create DNSSEC
     * @param $domain_name
     * @param $domain_data
     * @return mixed
     */
    public function dnssec($domain_name, $domain_data)
    {
        $response = $this->Request("domains/dnssec/". $domain_name, $domain_data, "POST");
        return $response;
    }

    /**
     * Delete DNSSEC
     * @param $domain_name
     * @param $digest
     * @return mixed
     */
    public function deleteDnssec($domain_name, $digest)
    {
        $response = $this->Request("domains/dnssec/". $domain_name . '/' . $digest, [], "DELETE");
        return $response;
    }

    /**
     * Get DNSSEC
     * @param $domain_name
     * @param $digest
     * @return mixed
     */
    public function getDnssec($domain_name, $digest)
    {
        $response = $this->Request("domains/dnssec/". $domain_name . '/' . $digest);
        return $response;
    }

    /**
     * List DNSSEC
     * @param $domain_name
     * @return mixed
     */
    public function listDnssec($domain_name)
    {
        $response = $this->Request("domains/dnssec/". $domain_name);
        return $response;
    }

    /**
     * Add DNS Zone
     * @param $domain_name
     * @param $domain_data
     * @return mixed
     */
    public function createZoneRecord($domain_name, $domain_data)
    {
        $response = $this->Request("domains/createZoneRecord/". $domain_name, $domain_data, "POST");
        return $response;
    }

    /**
     * Delete DNS Zone
     * @param $domain_name
     * @return mixed
     */
    public function deleteZoneRecord($domain_name)
    {
        $response = $this->Request("domains/deleteZoneRecord/". $domain_name, [], "DELETE");
        return $response;
    }

    /**
     * Get DNS Zone
     * @param $domain_name
     * @return mixed
     */
    public function getZoneRecord($domain_name)
    {
        $response = $this->Request("domains/getZoneRecord/". $domain_name);
        return $response;
    }

    /**
     * Add DNS Record
     * @param $domain_name
     * @param $data
     * @return mixed
     */
    public function createDnsRecord($domain_name, $data)
    {
        $response = $this->Request("domains/createDnsRecord/". $domain_name, $data, "POST");
        return $response;
    }

    /**
     * Modify DNS Record
     * @param $domain_name
     * @param $record
     * @param $data
     * @return mixed
     */
    public function modifyDnsRecord($domain_name, $record, $data)
    {
        $response = $this->Request("domains/modifyDnsRecord/". $domain_name. "/". $record, $data, "PUT");
        return $response;
    }

    /**
     * Delete DNS Record
     * @param $domain_name
     * @param $record
     * @return mixed
     */
    public function deleteDnsRecord($domain_name, $record)
    {
        $response = $this->Request("domains/deleteDnsRecord/". $domain_name. "/". $record, [], "DELETE");
        return $response;
    }

    /**
     * IDN Converter
     * @param $data
     * @return mixed
     */
    public function idnConverter($data)
    {
        $response = $this->Request("tool/idnConverter/$data");
        return $response;
    }
}
