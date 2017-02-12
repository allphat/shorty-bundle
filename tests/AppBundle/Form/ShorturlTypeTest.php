<?php

namespace Tests\AppBundle\Form;

use AppBundle\Entity\ShorturlEntity;
use AppBundle\Form\ShorturlType;
use Symfony\Component\Form\Test\TypeTestCase;

class TestedTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $this->markTestSkipped('Error on Travis with guzzle curl cert file');
        $formData = array(
            'url' => 'http://test.com/'
        );

        $form = $this->factory->create(ShorturlType::class);

        $object = new ShorturlEntity();
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

            $form = $this->factory->create(ShorturlType::class);

            $object = new ShorturlEntity();
            $object->setUrl($formData['url']);

            // submit the data to the form directly
            $form->submit($formData);
            $errors = $form->getErrors();
            $this->assertCount(1, $errors);

            $this->assertEquals($message, $errors[0]->getMessage());
        }
    }
}
