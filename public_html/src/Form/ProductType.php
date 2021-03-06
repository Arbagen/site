<?php
namespace App\Form;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\ProductParam;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\Loader\CallbackChoiceLoader;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

/**
 * Class ProductType
 *
 * @package App\Form
 */
class ProductType extends AbstractType
{
    
    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array                                        $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('name', TextType::class)
          ->add('description', TextareaType::class)
          ->add('price', MoneyType::class, [
            'currency' => 'UAH'
          ])
          ->add('imagesToUpload', FileType::class, [
            'label' => 'Images', 'multiple' => true, 'required' => false
          ])
          ->add('category', EntityType::class, [
            'choice_label' => 'getName', 'required' => false, 'class' => Category::class
          ])
          ->add('submit', SubmitType::class);
    }
    
    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
          'data_class' => Product::class,
        ]);
    }
}