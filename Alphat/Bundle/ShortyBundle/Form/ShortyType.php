<?php

namespace Alphat\Bundle\ShortyBundle\Form;

use Alphat\Bundle\ShortyBundle\Entity\ShortyEntity;
use GuzzleHttp\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ShortyType extends AbstractType
{
	/**
	 * @param  FormBuilderInterface $builder
	 * @param  array                $options
	 */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        	->add('url', TextType::class, [
                'label' => 'Enter your url',
                'attr' => ['placeholder' => 'https://www.alittlemarket.com/']
                ]
            )
            ->add('save', SubmitType::class, ['label' => 'Generate a little link'])
            ->addEventListener(
                FormEvents::PRE_SUBMIT,
                array($this, 'onPreBind')
            )
        ;
    }

    /**
     * @param  FormEvent $event
     */
    public function onPreBind(FormEvent $event)
    {
        $user = $event->getData();
        $form = $event->getForm();

        if (!$user) {
            return;
        }

        $client = new Client(['http_errors' => false]);
        $response = $client->head($user['url']);
        switch ($response->getStatusCode()) {
            case 301:
            case 302:
                $form->get('url')->addError(new FormError('Redirection links are not allowed.'));
                break;
            case 400:
                $form->get('url')->addError(new FormError('Looks like your url is malformed.'));
                break;
            case 403:
                $form->get('url')->addError(new FormError('Private links are malformed.'));
                break;
            case 404:
                $form->addError(new FormError('Submitted link is nowhere to be found.'));
                break;
            case 500:
                $form->get('url')->addError(new FormError('Submitted url does not work yet, please retry later.'));
                break;
        }
    }

    /**
     * @param  OptionsResolver $resolver
     */
	public function configureOptions(OptionsResolver $resolver)
	{
	    $resolver->setDefaults(
	    	['data_class' => ShortyEntity::class]
	    );
	}
	/**
	 * @return string
	 */
	public function getName()
	{
	    return 'create_shorty';
	}
}
