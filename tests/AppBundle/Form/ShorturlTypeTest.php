<?php

namespace Tests\AppBundle\Form;

use AppBundle\Entity\ShorturlEntity;
use AppBundle\Form\ShorturlType;
use Symfony\Component\Form\Test\TypeTestCase;

class TestedTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
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
}
