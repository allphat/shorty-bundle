<?php

namespace AppBundle\Form;

use AppBundle\Entity\ShorturlEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
        	->add('url', TextType::class, [
                'label' => 'Enter your url',
                'attr' => ['placeholder' => 'https://www.alittlemarket.com/']
                ]
            )
            ->add('save', SubmitType::class, ['label' => 'Generate little link'])
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
	    	['data_class' => ShorturlEntity::class]
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