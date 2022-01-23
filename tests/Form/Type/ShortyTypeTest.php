<?php

namespace Tests\Allphat\ShortyBundleForm\Type;

use Allphat\ShortyBundle\Form\Type\ShortyType;
use Allphat\ShortyBundle\Entity\ShortyEntity;
use Symfony\Component\Form\Test\TypeTestCase;

class ShortyTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = [
            'sourceUrl' => 'http://test.fr/test'
        ];

        $model = new ShortyEntity();
        // $model will retrieve data from the form submission; pass it as the second argument
        $form = $this->factory->create(ShortyType::class, $model);

        $expected = new ShortyEntity();
        $expected->setSourceUrl('http://test.fr/test');
        // ...populate $object properties with the data stored in $formData

        // submit the data to the form directly
        $form->submit($formData);

        // This check ensures there are no transformation failures
        $this->assertTrue($form->isSynchronized());

        // check that $model was modified as expected when the form was submitted
        $this->assertEquals($expected, $model);
    }

    public function testCustomFormView()
    {
        $formData = new ShortyEntity();
        $formDatas->etSourceUrl('http://test.fr/test');
        // ... prepare the data as you need

        // The initial data may be used to compute custom view variables
        $view = $this->factory->create(ShortyType::class, $formData)
            ->createView();

        $this->assertArrayHasKey('source_url', $view->vars);
        $this->assertSame('http://test.fr/test', $view->vars['source_url']);
    }
}
