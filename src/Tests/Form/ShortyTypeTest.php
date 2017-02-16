<?php

namespace Tests\Alphat\Bundle\ShortyBundle\Form;

use Alphat\Bundle\ShortyBundle\Entity\ShortyEntity;
use Alphat\Bundle\ShortyBundle\Form\ShortyType;
use Symfony\Component\Form\Test\TypeTestCase;

class ShortTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $this->markTestSkipped('Error on Travis with guzzle curl cert file');
        $formData = array(
            'url' => 'http://test.com/'
        );

        $form = $this->factory->create(ShortyType::class);

        $object = new ShortyEntity();
        $object->setUrl($formData['url']);

        // submit the data to the form directly
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($object, $form->getData());

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }

    /**
     * @TODO find examples for other http response
     */
    public function testSubmitInvalidData()
    {
        $this->markTestSkipped('Error on Travis with guzzle curl cert file');

        $data = ['http://google.fr/dazdad/' =>'Submitted link is nowhere to be found.'];
        foreach ($data as $url => $message) {
            $formData = array(
                'url' => $url
            );

            $form = $this->factory->create(ShortyType::class);

            $object = new ShortyEntity();
            $object->setUrl($formData['url']);

            $form->submit($formData);
            $errors = $form->getErrors();
            $this->assertCount(1, $errors);

            $this->assertEquals($message, $errors[0]->getMessage());
        }
    }
}
