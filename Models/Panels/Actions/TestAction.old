<?php

namespace Modules\Blog\Models\Panels\Actions;

use GuzzleHttp\Client as GuzzleClient;
//-------- models -----------

//-------- services --------
use Modules\Xot\Models\Panels\Actions\XotBasePanelAction;

//-------- bases -----------

class TestAction extends XotBasePanelAction {
    public $onItem = true;

    public function __construct() {
        //require_once __DIR__.'/../../../vendor/autoload.php';
        $this->cookieJar = new \GuzzleHttp\Cookie\CookieJar();

        $this->httpClient = new GuzzleClient([
            //'base_uri' => $this->base_uri,
            'cookies' => $this->cookieJar,
        ]);
    }

    public function handle() {
        return $this->handleRestaurant();
    }

    public function handleProfile() {
        $data = factory(\Modules\Food\Models\Profile::class)->raw();
        $url = Route('container0.store', ['lang' => \App::getLocale(), 'container0' => 'profile']);
        //dd($url);

        $response = $this->httpClient->request('POST', $url, [
            'form_params' => $data,
        ]);
        $body = (string) $response->getBody();
        die($body);
    }

    public function handleRestaurant() {
        $data = factory(\Modules\Food\Models\Restaurant::class)->raw();
        $url = route('container0.store',
            [
                'lang' => \App::getLocale(),
                'container0' => 'restaurant',
            ]
        );

        //dddx([$url, $data]);

        $response = $this->httpClient->request('POST', $url, [
            'form_params' => $data,
        ]);
        $body = (string) $response->getBody();
        die($body);

        return 'preso';
    }
}
