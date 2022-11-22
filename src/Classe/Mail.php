<?php

namespace App\Classe;

use Mailjet\Client;
use Mailjet\Resources;


class Mail
{
    private $api_key = 'd6c38877a0a2ab8049e4f1fbc1280163';

    private $api_key_secret = '7c6708a6a7269b02eec9e918093c393f';

    public function send($to_email, $to_name, $subject, $content)
    {
        $mj = new Client($this->api_key, $this->api_key_secret, true,['version'=>'v3.1']);
      
        $body = [
                'Messages' => [
                    [
                        'From' => [
                            'Email' => "ludo.spysschaert@orange.fr",
                            'Name' => "TRT-CONSEIL"
                        ],
                        'To' => [
                            [
                                'Email' => $to_email,
                                'Name' => $to_name
                            ]
                        ],
                        'TemplateID' => 4373649,
                        'TemplateLanguage' => true,
                        'Subject' => $subject,
                    'Variables' => [
                        'content' => $content,
                        
                    ]
                    ]
                ]
            ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success(); 
    }
}