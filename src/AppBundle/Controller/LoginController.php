<?php
namespace App\AppBundle\Controller;

use Symfony\Component\Form\Forms;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\Routing\Annotation\Route;

Class LoginController extends AbstractController
{
    public function index()
    {
        $formFactory = Forms::createFormFactoryBuilder()
            ->addExtension(new HttpFoundationExtension())
            ->getFormFactory();

        $formBuilder = $formFactory->createBuilder(FormType::class, null, array(
            'action' => '/login',
            'method' => 'POST',
            'attr' => array('class' => "form-signin",),
        ));

        $form = $formBuilder->add('Username', TextType::class,
            array('required'   => true, 'attr'=> array('class'=>'col-sm-6, form-control',),)
        )
            ->add('Password', PasswordType::class,
                array(
                    'required'   => true,
                    'attr'=> array('class'=>'col-sm-6, form-control',),
                )
            )
            ->add('submit', SubmitType::class,
                array(
                    'label' => 'Submit',
                    'attr' => array('class'=>'btn btn-lg btn-primary btn-block',),
                ))
            ->getForm();

        return $this->render('UserBundle/Login/index.html.twig', array(
            'form' => $form->createView(),
            )
        );
    }
}