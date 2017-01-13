<?php

namespace AppBundle\Form;

use AppBundle\Entity\Shorturl;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ShorturlType extends AbstractType
{
	/**
	 * [buildForm description]
	 * @param  FormBuilderInterface $builder [description]
	 * @param  array                $options [description]
	 * @return [type]                        [description]
	 */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        	->add('url', UrlType::class)
            ->add('save', SubmitType::class)
        ;
    }

    /**
     * [configureOptions description]
     * @param  OptionsResolver $resolver [description]
     * @return [type]                    [description]
     */
	public function configureOptions(OptionsResolver $resolver)
	{
	    $resolver->setDefaults(
	    	['data_class' => Shorturl::class]
	    );
	}
	/**
	 * @return string
	 */
	public function getName()
	{
	    return 'create_short_url';
	}
}