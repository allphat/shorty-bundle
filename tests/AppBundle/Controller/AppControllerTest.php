<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AppControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient([], ['HTTP_HOST' => 'redir.alittlemarket.com']);

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Litte Url Shortener', $crawler->filter('h1')->text());

        $form = $crawler->selectButton('Generate little link')->form();

        $form->setValues(['shorturl' => ['url' => 'http://test.com']]);

        $crawler = $client->submit($form);

        $this->assertEquals(302, $client->getResponse()->getStatusCode());

        $crawler = $client->followRedirect();

        $this->assertContains('Short url created:', $crawler->filter('div')->text());

        $info = $crawler->filter('a');
        $link = $info->html();
    }
}
