<?php
namespace App\Controller;
use App\Entity\Category;
use App\Entity\PriceSearch;
use App\Entity\PropertySearch;
use App\Form\CommFactType;

use App\Form\PriceSearchType;
use App\Form\PropertySearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

// Include Dompdf required namespaces
use Dompdf\Dompdf;
use Dompdf\Options;

use App\Entity\Commande;
use App\Entity\Facture;
use App\Entity\Article;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class IndexController extends AbstractController
{
    /**
     *@Route("/",name="article_list")
     */
    public function home(Request $request)
    {
        $propertySearch = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class,$propertySearch);
        $form->handleRequest($request);
        //initialement le tableau des articles est vide,
        //c.a.d on affiche les articles que lorsque l'utilisateur
        //clique sur le bouton rechercher
        $articles= [];

        if($form->isSubmitted() && $form->isValid()) {
            //on récupère le nom d'article tapé dans le formulaire

            $NumFacture = $propertySearch->getNom();
            if ($NumFacture!="")
                //si on a fourni un nom d'article on affiche tous les articles ayant ce nom
 $articles= $this->getDoctrine()->getRepository(Facture::class)->findBy(['NumFacture' => $NumFacture] );
 else
 //si si aucun nom n'est fourni on affiche tous les articles
 $articles= $this->getDoctrine()->getRepository(Facture::class)->findAll();
 }
        return $this->render('articles/index.html.twig',[ 'form' =>$form->createView(), 'articles' => $articles]);
 }



    /**
     * @Route("/article/pdf/{id}", name="article_pdf")
     * Method({"GET"})
     */
    public function pdf(Request $request ,$id)
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();

        $pdfOptions->set('defaultFont', 'Arial');


        $dompdf = new Dompdf($pdfOptions);
        $articles = $this->getDoctrine()->getRepository(Facture::class)->findAll();

        $html = $this->renderView('articles/pdf.html.twig', ['articles' => $articles,'id'=>$id]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false
        ]);
    }



    /**
     * @Route("/article/edit/{id}", name="edit_article")
     * Method({"GET", "POST"})
     */
    public function edit(Request $request, $id) {
       // $article = new Facture();
        $article = $this->getDoctrine()->getRepository(Facture::class)->find($id);

        $form = $this->createFormBuilder($article)
            ->add('NumFacture', TextType::class)
            ->add('DatePaiement', TextType::class)
            ->add('Montanttotalht', TextType::class)
            ->add('Montanttotalttc', TextType::class)
            ->add('save', SubmitType::class, array(
                'label' => 'Modifier'
            ))->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('article_list');
        }

        return $this->render('articles/edit.html.twig', ['form' => $form->createView()]);
 }

    /**
     * @Route("/article/delete/{id}",name="delete_article")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id) {
        $article = $this->getDoctrine()->getRepository(Facture::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
         $entityManager->remove($article);
        $entityManager->flush();

 $response = new Response();
 $response->send();
 return $this->redirectToRoute('article_list');
 }


    /**
     * @Route("/article/new", name="new_article")
     * Method({"GET", "POST"})
     */
    public function new(Request $request) {
        $article = new Facture();
        $form = $this->createFormBuilder($article)

               ->add('NumFacture', TextType::class)
               ->add('DatePaiement', TextType::class)
               ->add('Montanttotalht', TextType::class)
               ->add('Montanttotalttc', TextType::class)
               ->add('save', SubmitType::class, array(
                   'label' => 'Ajouter'
               ))->getForm();


        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('article_list');
        }
        return $this->render('articles/new.html.twig',['form' => $form->createView()]);
    }

    /**
     * @Route("/category/newCat", name="new_category")
     * Method({"GET", "POST"})
     */
    public function newCommande(Request $request) {
        $category = new Commande();
        $form = $this->createForm(CommFactType::class,$category);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();
        }
        return $this->render('articles/commande.html.twig',['form'=>
            $form->createView()]);
    }





    /**
     * @Route("/article/rechercheparprix", name="article_par_prix")
     * Method({"GET"})
     */
    public function articlesParPrix(Request $request)
    {

        $priceSearch = new PriceSearch();
        $form = $this->createForm(PriceSearchType::class,$priceSearch);
        $form->handleRequest($request);
        $articles= [];
        if($form->isSubmitted() && $form->isValid()) {
            $minPrice = $priceSearch->getMinPrice();
            $maxPrice = $priceSearch->getMaxPrice();

            $articles= $this->getDoctrine()->
            getRepository(Facture::class)->findByPriceRange($minPrice,$maxPrice);
        }
        return $this->render('articles/rechercheparprix.html.twig',[ 'form' =>$form->createView(), 'articles' => $articles]); }


}
