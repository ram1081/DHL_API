<?php
namespace DHLApi\Calls;
use DHLApi\Api\DHLAbstractAPI;

    class GetTracking extends DHLAbstractAPI
    {
        private $trackingNumber;


        public function __construct()
        {
            parent::__construct();

        }

        /**
         * Called from DHLAbstractAPI
         *
         * @return [string] XML string; 
         */
        public function toXML():String
        {
            $xml = new \XmlWriter();
            $xml->openMemory();
            $xml->setIndent(TRUE);
            $xml->setIndentString("  ");
            $xml->startDocument('1.0', 'UTF-8');
            $xml->startElement('req:KnownTrackingRequest');
            $xml->writeAttribute('xmlns:req', "http://www.dhl.com");
            $xml->writeAttribute('xmlns:xsi', "http://www.w3.org/2001/XMLSchema-instance");
            $xml->writeAttribute('xsi:schemaLocation', "http://www.dhl.com TrackingRequestKnown.xsd");
            $xml->startElement('Request');
            $xml->startElement('ServiceHeader');
            $xml->writeElement('MessageTime', date('Y-m-d') . "T" . date('H:i:s') . ".000+02:00");
            $xml->writeElement('MessageReference', $this->reference); 
            $xml->writeElement('SiteID', $this->siteid);
            $xml->writeElement('Password', $this->password);
            $xml->endElement();
            $xml->endElement();
            $xml->writeElement('LanguageCode', 'en');
            $xml->writeElement('AWBNumber', $this->trackingNumber);
            $xml->writeElement('LevelOfDetails', 'ALL_CHECK_POINTS');            
            $xml->endElement();
            $xml->endElement();
            $xml->endDocument();
            return $this->xmlRequest = $xml->outputMemory();
        }


        public function trackingNumber($value = NULL):Self
        {
            if (empty($value)) {
                return $this->trackingNumber;
            }

            $this->trackingNumber = $value;

            return $this;
        }

        
    }