<?php
include_once "api.php";

use Omnilance\Api;

$config = require 'config.php';

$api = new Api($config["apikey"], $config["secretly"], $url = "https://api.omnilance.com", $version = '3');

// Get Customer Balance
$response = $api->customerBalance();
echo sprintf("Customer Balance result: %s\n", var_export($response, true));

// Check domains available
$domains_data = [
    "domainNames" => ['so.xyz']
];
$response = $api->domainCheck($domains_data);
echo sprintf("Check Domains: %s\n", json_encode($domains_data['domainNames']));
echo sprintf("Check results: %s\n", var_export($response->results, true));

// Register Domain
$domains_data = [
    'domain' =>
        array (
            'domainName' => 'so.xyz',
            'nameservers' =>
                array (
                    0 => 'ns1.rx-name.net',
                    1 => 'ns2.rx-name.net',
                    2 => 'ns3.rx-name.net',
                ),
            'contacts' =>
                array (
                    'reg-contact' =>
                        array (
                            'name' => 'Jone Omni',
                            'company-name' => 'OMNILANCE LTD',
                            'address1' => '77 North Star street',
                            'city' => 'North',
                            'state' => 'North Pole',
                            'country' => 'UA',
                            'phone' => '380.931700001',
                            'email' => 'alex@so.xyz',
                            'zipcode' => 10000,
                        ),
                    'admin-contact' =>
                        array (
                            'name' => 'Jone Omni',
                            'company-name' => 'OMNILANCE LTD',
                            'address1' => '77 North Star street',
                            'city' => 'North',
                            'state' => 'North Pole',
                            'country' => 'UA',
                            'phone' => '380.931700001',
                            'email' => 'alex@so.xyz',
                            'zipcode' => 10000,
                        ),
                    'tech-contact' =>
                        array (
                            'name' => 'Jone Omni',
                            'company-name' => 'OMNILANCE LTD',
                            'address1' => '77 North Star street',
                            'city' => 'North',
                            'state' => 'North Pole',
                            'country' => 'UA',
                            'phone' => '380.931700001',
                            'email' => 'alex@so.xyz',
                            'zipcode' => 10000,
                        ),
                    'billing-contact' =>
                        array (
                            'name' => 'Jone Omni',
                            'company-name' => 'OMNILANCE LTD',
                            'address1' => '77 North Star street',
                            'city' => 'North',
                            'state' => 'North Pole',
                            'country' => 'UA',
                            'phone' => '380.931700001',
                            'email' => 'alex@so.xyz',
                            'zipcode' => 10000,
                        ),
                ),
            'privacyEnabled' => false,
            'lockedEnabled' => false,
            'autorenewEnabled' => false,
        ),
    'years' => 1,
];
$response = $api->createDomain($domains_data);
echo sprintf("Create Domain: %s\n", $domains_data['domain']['domainName']);
echo sprintf("Create Domain result: %s\n", var_export($response, true));

// List Domains
$response = $api->domains();
echo sprintf("List Domains: %s\n", var_export($response, true));

// Getting Domain Details
$domain_name = 'so.xyz';
$response = $api->getDomain($domain_name);
echo sprintf("Domain Details: %s\n", var_export($response, true));

// Renew Domain
$domain_data = [
    'domain' => ['domainName' => 'so.xyz', 'years' => 1]
];
$response = $api->renewDomain($domain_data);
echo sprintf("Renew Domain: %s\n", $domain_data['domain']['domainName']);
echo sprintf("Renew Domain result: %s\n", var_export($response, true));

// Modify Name Servers
$domain_data = [
    "domainName" => 'so.xyz',
    "nameservers" => ["ns1.rx-name.net","ns2.rx-name.net"]
];
$response = $api->setNameservers($domain_data);
echo sprintf("Set Nameservers Domain: %s\n", $domain_data['domainName']);
echo sprintf("Set Nameservers result: %s\n", var_export($response, true));

// Enable Transfer Prohibited
$domain_data = [
    "domainName" => 'so.xyz',
];
$response = $api->lockTransfer($domain_data);
echo sprintf("Lock Transfer Domain: %s\n", $domain_data['domainName']);
echo sprintf("Lock Transfer result: %s\n", var_export($response, true));

// Disable Transfer Prohibited
$domain_data = [
    "domainName" => 'so.xyz',
];
$response = $api->unlockTransfer($domain_data);
echo sprintf("Lock Transfer Domain: %s\n", $domain_data['domainName']);
echo sprintf("Lock Transfer result: %s\n", var_export($response, true));

// Suspend Domain
$domain_data = [
    "domainName" => 'so.xyz',
];
$response = $api->lock($domain_data);
echo sprintf("Lock Domain: %s\n", $domain_data['domainName']);
echo sprintf("Lock Domain result: %s\n", var_export($response, true));

// Unsuspend Domain
$domain_data = [
    "domainName" => 'so.xyz',
];
$response = $api->unlock($domain_data);
echo sprintf("Unlock Domain: %s\n", $domain_data['domainName']);
echo sprintf("Unlock Domain result: %s\n", var_export($response, true));

// Enable lockUpdate
$domain_data = [
    "domainName" => 'so.xyz',
];
$response = $api->lockUpdate($domain_data);
echo sprintf("Enable lockUpdate domain: %s\n", $domain_data['domainName']);
echo sprintf("Enable lockUpdate result: %s\n", var_export($response, true));

// Disable lockUpdate
$domain_data = [
    "domainName" => 'so.xyz',
];
$response = $api->unlockUpdate($domain_data);
echo sprintf("Disable lockUpdate domain: %s\n", $domain_data['domainName']);
echo sprintf("Disable lockUpdate result: %s\n", var_export($response, true));

// Enable AutoRenew
$domain_data = [
    "domainName" => 'so.xyz',
];
$response = $api->enableAutorenew($domain_data);
echo sprintf("Enable AutoRenew domain: %s\n", $domain_data['domainName']);
echo sprintf("Enable AutoRenew result: %s\n", var_export($response, true));

// Disable AutoRenew
$domain_data = [
    "domainName" => 'so.xyz',
];
$response = $api->disableAutorenew($domain_data);
echo sprintf("Disable AutoRenew domain: %s\n", $domain_data['domainName']);
echo sprintf("Disable AutoRenew result: %s\n", var_export($response, true));

// Adding GlueRecords
$domain_data = [
    "domainName" => 'so.xyz',
    "hostname" => "ns1", "ips" => ["195.189.226.1"]
];
$response = $api->glueRecords($domain_data);
echo sprintf("Adding GlueRecords domain: %s\n", $domain_data['domainName']);
echo sprintf("Adding GlueRecords result: %s\n", var_export($response, true));

// Modify GlueRecords
$domain_data = [
    "domainName" => 'so.xyz',
    "hostname" => "ns1", "ips" => ["195.189.226.7"]
];
$response = $api->modifyGlueRecords($domain_data);
echo sprintf("Modify GlueRecords domain: %s\n", $domain_data['domainName']);
echo sprintf("Modify GlueRecords result: %s\n", var_export($response, true));

// Delete GlueRecords
$domain_data = [
    "domainName" => 'so.xyz',
    "hostname" => "ns1",
];
$response = $api->deleteGlueRecords($domain_data);
echo sprintf("Delete GlueRecords domain: %s\n", $domain_data['domainName']);
echo sprintf("Delete GlueRecords result: %s\n", var_export($response, true));

// List GlueRecords
$domain_name = 'so.xyz';
$response = $api->listGlueRecords($domain_name);
echo sprintf("List GlueRecords domain: %s\n", $domain_name);
echo sprintf("List GlueRecords result: %s\n", var_export($response, true));

// Get GlueRecords
$domain_name = 'so.xyz';
$host_name = 'ns1';

$response = $api->getGlueRecords($domain_name, $host_name);
echo sprintf("Get GlueRecords domain: %s\n", $domain_name);
echo sprintf("Get GlueRecords result: %s\n", var_export($response, true));

// Request Domain Transfer
$domain_data = [
    'domain' =>
        array (
            'domainName' => 'so.xyz',
            'nameservers' =>
                array (
                    0 => 'ns1.rx-name.net',
                    1 => 'ns2.rx-name.net',
                    2 => 'ns3.rx-name.net',
                ),
            'contacts' =>
                array (
                    'reg-contact' =>
                        array (
                            'name' => 'Jone Omni',
                            'company-name' => 'OMNILANCE LTD',
                            'address1' => '77 North Star street',
                            'city' => 'North',
                            'state' => 'North Pole',
                            'country' => 'UA',
                            'phone' => '380.931700001',
                            'email' => 'alex@so.xyz',
                            'zipcode' => '10000',
                        ),
                    'admin-contact' =>
                        array (
                            'name' => 'Jone Omni',
                            'company-name' => 'OMNILANCE LTD',
                            'address1' => '77 North Star street',
                            'city' => 'North',
                            'state' => 'North Pole',
                            'country' => 'UA',
                            'phone' => '380.931700001',
                            'email' => 'alex@so.xyz',
                            'zipcode' => '10000',
                        ),
                    'tech-contact' =>
                        array (
                            'name' => 'Jone Omni',
                            'company-name' => 'OMNILANCE LTD',
                            'address1' => '77 North Star street',
                            'city' => 'North',
                            'state' => 'North Pole',
                            'country' => 'UA',
                            'phone' => '380.931700001',
                            'email' => 'alex@so.xyz',
                            'zipcode' => '10000',
                        ),
                    'billing-contact' =>
                        array (
                            'name' => 'Jone Omni',
                            'company-name' => 'OMNILANCE LTD',
                            'address1' => '77 North Star street',
                            'city' => 'North',
                            'state' => 'North Pole',
                            'country' => 'UA',
                            'phone' => '380.931700001',
                            'email' => 'alex@so.xyz',
                            'zipcode' => '10000',
                        ),
                ),
            'privacyEnabled' => false,
            'lockedEnabled' => false,
            'autorenewEnabled' => false,
        ),
    'authCode' => 'VfG0e7gGs3de67591',
    'years' => 1,
];
$response = $api->requestTransfer($domain_data);
echo sprintf("Request Domain Transfer: %s\n", $domain_data['domainName']);
echo sprintf("Request Domain Transfer result: %s\n", var_export($response, true));

// Reject Domain Transfer
$domain_name = 'so.xyz';
$response = $api->rejectTransfer($domain_name);
echo sprintf("Reject Domain Transfer: %s\n", $domain_name);
echo sprintf("Reject Domain Transfer result: %s\n", var_export($response, true));

// Cancel Domain Transfer
$domain_name = 'so.xyz';
$response = $api->cancelTransfer($domain_name);
echo sprintf("Cancel Domain Transfer: %s\n", $domain_name);
echo sprintf("Cancel Domain Transfer result: %s\n", var_export($response, true));

// Approve Domain Transfer
$domain_name = 'so.xyz';
$response = $api->approveTransfer($domain_name);
echo sprintf("Approve Domain Transfer: %s\n", $domain_name);
echo sprintf("Approve Domain Transfer result: %s\n", var_export($response, true));

// Modify AuthCode
$domain_name = 'so.xyz';
$domain_data = [
    "authcode" => "9ccnwvyopgic}sfwjgunsokqjxrvcAstnTncpzxyg#bmdwr7",
];
$response = $api->setAuthcode($domain_name, $domain_data);
echo sprintf("Modify AuthCode domain: %s\n", $domain_name);
echo sprintf("Modify AuthCode result: %s\n", var_export($response, true));

// Get AuthCode
$domain_name = 'so.xyz';
$response = $api->getAuthcode($domain_name);
echo sprintf("Get AuthCode domain: %s\n", $domain_name);
echo sprintf("Get AuthCode result: %s\n", var_export($response, true));

// Modifying Contacts
$domain_data = [
    "domainName" => 'so.xyz',
    'contacts' =>
        array (
            'reg-contact' =>
                array (
                    'name' => 'Jone Lance',
                    'company-name' => 'OMNILANCE LTD',
                    'address1' => '77 North Star street',
                    'city' => 'Varna',
                    'state' => 'North Pole',
                    'zipcode' => '10000',
                    'country' => 'UA',
                    'phone' => '+380.931700001',
                    'fax' => '',
                    'email' => 'alex-lance@so.xyz',
                ),
            'admin-contact' =>
                array (
                    'name' => 'Jone Lance',
                    'company-name' => 'OMNILANCE LTD',
                    'address1' => '77 North Star street',
                    'city' => 'Varna',
                    'state' => 'North Pole',
                    'zipcode' => '10000',
                    'country' => 'UA',
                    'phone' => '+380.931700001',
                    'fax' => '',
                    'email' => 'alex@so.xyz',
                ),
            'tech-contact' =>
                array (
                    'name' => 'Jone Lance',
                    'company-name' => 'OMNILANCE LTD',
                    'address1' => '77 North Star street',
                    'city' => 'Varna',
                    'state' => 'North Pole',
                    'zipcode' => '10000',
                    'country' => 'UA',
                    'phone' => '+380.931700001',
                    'fax' => '',
                    'email' => 'alex@so.xyz',
                ),
            'billing-contact' =>
                array (
                    'name' => 'Jone Lance',
                    'company-name' => 'OMNILANCE LTD',
                    'address1' => '77 North Star street',
                    'city' => 'Varna',
                    'state' => 'North Pole',
                    'zipcode' => '10000',
                    'country' => 'UA',
                    'phone' => '+380.931700001',
                    'fax' => '',
                    'email' => 'alex-lance@so.xyz',
                ),
        ),
];
$response = $api->setContacts($domain_data);
echo sprintf("Modifying Contacts domain: %s\n", $domain_data['domainName']);
echo sprintf("Modifying Contacts result: %s\n", var_export($response, true));

// Create DNSSEC
$domain_name = 'so.xyz';
$domain_data = [
    "keyTag" => 30909, "algorithm" => 8, "digestType" => 2, "digest" => "X2F7C936F6DEEAC73294E8268RB5485047A833FC5459578F4A9125CFF41B5777",
];
$response = $api->dnssec($domain_name, $domain_data);
echo sprintf("Create DNSSEC domain: %s\n", $domain_name);
echo sprintf("Create DNSSEC result: %s\n", var_export($response, true));

// Delete DNSSEC
$domain_name = 'so.xyz';
$digest = 'X2F7C936F6DEEAC73294E8268RB5485047A833FC5459578F4A9125CFF41B5777';
$response = $api->deleteDnssec($domain_name, $digest);
echo sprintf("Delete DNSSEC domain: %s\n", $domain_name);
echo sprintf("Delete DNSSEC result: %s\n", var_export($response, true));

// Get DNSSEC
$domain_name = 'so.xyz';
$digest = 'X2F7C936F6DEEAC73294E8268RB5485047A833FC5459578F4A9125CFF41B5777';
$response = $api->getDnssec($domain_name, $digest);
echo sprintf("Get DNSSEC domain: %s\n", $domain_name);
echo sprintf("Get DNSSEC result: %s\n", var_export($response, true));

// List DNSSEC
$domain_name = 'so.xyz';
$response = $api->listDnssec($domain_name);
echo sprintf("List DNSSEC domain: %s\n", $domain_name);
echo sprintf("List DNSSEC result: %s\n", var_export($response, true));

// Add DNS Zone
$domain_name = 'so.xyz';
$domain_data = [
    'type' => 'A',
    'name' => 'www',
    'ttl' => 86400,
    'priority' => '',
    'value' =>
        array (
            0 => '194.54.80.32',
            1 => '194.54.80.33',
            2 => '194.54.80.34',
        ),
];
$response = $api->createZoneRecord($domain_name, $domain_data);
echo sprintf("Add DNS Zone domain: %s\n", $domain_name);
echo sprintf("Add DNS Zone result: %s\n", var_export($response, true));

// Delete DNS Zone
$domain_name = 'so.xyz';
$response = $api->deleteZoneRecord($domain_name);
echo sprintf("Delete DNS Zone domain: %s\n", $domain_name);
echo sprintf("Delete DNS Zone result: %s\n", var_export($response, true));

// Get DNS Zone
$domain_name = 'so.xyz';
$response = $api->getZoneRecord($domain_name);
echo sprintf("Get DNS Zone domain: %s\n", $domain_name);
echo sprintf("Get DNS Zone result: %s\n", var_export($response, true));

// Add DNS Record
$domain_name = 'so.xyz';
$data = [
    "type"=>"A","name"=>"panel","ttl"=>86400,"priority"=>"","value"=>["194.54.80.32"]
];
$response = $api->createDnsRecord($domain_name, $data);
echo sprintf("Add DNS Record domain: %s\n", $domain_name);
echo sprintf("Add DNS Record result: %s\n", var_export($response, true));

// Modify DNS Record
$domain_name = 'so.xyz';
$record = 'www';
$data = [
    "type"=>"A","name"=>"panel","ttl"=>86400,"priority"=>"","value"=>["192.54.80.32"],
];
$response = $api->modifyDnsRecord($domain_name, $record, $data);
echo sprintf("Modify DNS Record domain: %s\n", $domain_name);
echo sprintf("Modify DNS Record result: %s\n", var_export($response, true));

// Delete DNS Record
$domain_name = 'so.xyz';
$record = 'www';
$response = $api->deleteDnsRecord($domain_name, $record);
echo sprintf("Delete DNS Record domain: %s\n", $domain_name);
echo sprintf("Delete DNS Record result: %s\n", var_export($response, true));

// IDN Converter
$data = 'españa.com';
$response = $api->idnConverter($data);
echo sprintf("IDN Converter result: %s\n", var_export($response, true));