<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SafeBrowsingService
{
    public function check(string $url): bool {
        $response = Http::post(
            'https://safebrowsing.googleapis.com/v4/threatMatches:find?key='.env('SAFE_BROWSING_API_KEY'), 
            [
                "client"=> [
                    "clientId" =>      "safeBrowsingTest",
                    "clientVersion"=> "1.5.2"
                ],
                "threatInfo" => [
                    "threatTypes"=>  ["MALWARE", "SOCIAL_ENGINEERING", 'THREAT_TYPE_UNSPECIFIED', 'UNWANTED_SOFTWARE', 'POTENTIALLY_HARMFUL_APPLICATION'],
                    "platformTypes" =>   ["ANY_PLATFORM"],
                    "threatEntryTypes"=> ["THREAT_ENTRY_TYPE_UNSPECIFIED", 'URL', 'EXECUTABLE'],
                    "threatEntries"=> [
                        ["url"=> $url],
                    ]
                ]
            ]
        );
        return empty($response->json());
    }
    
}