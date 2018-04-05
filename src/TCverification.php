<?php

namespace HasanEmektar\tc;

use GuzzleHttp\Client;

class TCverification
{
    private $TC_number, $Name, $Surname, $Year_of_birth;

    public function __construct($TC_number,$Name,$Surname,$Year_of_birth)
    {
        $this->TC_number = $TC_number;
        $this->Name = strtoupper($Name);
        $this->Surname = strtoupper($Surname);
        $this->Year_of_birth = $Year_of_birth;
    }

    public function verify()
    {
        return $this->search();
    }

    private function search()
    {
        if(strlen($this->TC_number) == 11 && strlen($this->Year_of_birth) == 4)
        {
            $gonder = '<?xml version="1.0" encoding="utf-8"?>
		<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
            <soap:Body>
                <TCKimlikNoDogrula xmlns="http://tckimlik.nvi.gov.tr/WS">
                    <TCKimlikNo>'.$this->TC_number.'</TCKimlikNo>
                    <Ad>'.$this->Name.'</Ad>
                    <Soyad>'.$this->Surname.'</Soyad>
                    <DogumYili>'.$this->Year_of_birth.'</DogumYili>
                </TCKimlikNoDogrula>
            </soap:Body>
		</soap:Envelope>';

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL,            "https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx" );
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt($ch, CURLOPT_POST,           true );
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POSTFIELDS,    $gonder);
            curl_setopt($ch, CURLOPT_HTTPHEADER,     array(
                'POST /Service/KPSPublic.asmx HTTP/1.1',
                'Host: tckimlik.nvi.gov.tr',
                'Content-Type: text/xml; charset=utf-8',
                'SOAPAction: "http://tckimlik.nvi.gov.tr/WS/TCKimlikNoDogrula"',
                'Content-Length: '.strlen($gonder)
            ));
            $gelen = curl_exec($ch);
            curl_close($ch);
            return strip_tags($gelen);
        }
        return null;
    }
}