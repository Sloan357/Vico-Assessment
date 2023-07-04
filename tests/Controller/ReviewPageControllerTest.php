<?php

namespace App\Tests\Controller;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReviewPageControllerTest extends WebTestCase
{
    public function testIndexResponse(): void
    {
        $client = static::createClient();

        $client->request('GET', '/review/page');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testSucessfullFormSubmission()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/review/page');

        $form = $crawler->selectButton('Next')->form();
        $form['overall_rating'] = '5';
        $form['short_review'] = 'This is a test';

        $client->submit($form);

        $this->assertTrue($client->getResponse()->isRedirect());
    }

    public function testFailedFormSubmission()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/review/page');

        $form = $crawler->selectButton('Next')->form();

        $client->submit($form);

        $this->assertTrue($client->getResponse()->isRedirect());
        $client->followRedirect();

        $this->assertSelectorTextContains('.form-error-message', 'There was an error submitting the form.');
    }

    public function testFormSubmissionWithException()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/your-route');

        $form = $crawler->selectButton('Submit')->form();
        $form['overall_rating'] = 'This is not a choice';
        $form['short_review'] = 'This is a test';

        $client->submit($form);

        $this->assertEquals(500, $client->getResponse()->getStatusCode());
    }
}
