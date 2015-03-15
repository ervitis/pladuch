<?php

namespace Pladuch\BackBundle\Controller;


use Doctrine\Bundle\DoctrineBundle\Registry;
use Pladuch\BackBundle\Forms\CatalogoForm;
use Pladuch\BackBundle\Forms\DetallesCatalogoForm;
use Pladuch\DataBundle\Entity\CatalogoPlatos;
use Pladuch\DataBundle\Entity\CatalogoPlatosTraduccion;
use Pladuch\DataBundle\Utilities\Utilities;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CatalogoController extends Controller
{
    /**
     * @Template("PladuchBackBundle:catalogo:index.html.twig")
     * @return array
     */
    public function indexAction()
    {
        $doctrine = $this->getDoctrine();

        $catalogo = $doctrine->getRepository('PladuchDataBundle:CatalogoPlatos')->findAll();
        $rutaFoto = (new CatalogoPlatos())->getUploadDir();

        //Encode data id
        $ids = array();
        foreach ($catalogo as $c) {
            $id = Utilities::encode($c->getId());
            array_push($ids, $id);
        }

        return array(
            'ids'      => $ids,
            'catalogo' => $catalogo,
            'rutaFoto' => $rutaFoto,
        );
    }

    /**
     * @Template("PladuchBackBundle:catalogo:new.html.twig")
     * @param Request $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function newAction(Request $request)
    {
        $catalogoPlatos = new CatalogoPlatos();
        $form = $this->createNewForm($catalogoPlatos);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($catalogoPlatos);
            $em->flush();

            return $this->redirect($this->generateUrl('pladuch_catalogo_index'));
        }

        return array(
            'form' => $form->createView(),
        );
    }

    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $id = Utilities::decode($id);
        $plato = $em->getRepository('PladuchDataBundle:CatalogoPlatos')->find($id);

        if (! $plato) {
            throw $this->createNotFoundException('Catalogo not found');
        }

        $em->remove($plato);
        $em->flush();

        return $this->redirect($this->generateUrl('pladuch_catalogo_index'));
    }

    /**
     * @Template("PladuchBackBundle:catalogo:show.html.twig")
     * @param $id
     * @param Request $request
     * @return array
     */
    public function showAction($id, Request $request)
    {
        $id = Utilities::decode($id);

        $doctrine = $this->getDoctrine();
        $plato = $doctrine->getRepository('PladuchDataBundle:CatalogoPlatos')->find($id);
        if (! $plato) {
            throw $this->createNotFoundException('Catalogo not found');
        }

        $platoDetalle = $doctrine->getRepository('PladuchDataBundle:CatalogoPlatosTraduccion')->findBy(array(
            'catalogoplatos' => $plato,
        ));

        $ids = array();
        foreach ($platoDetalle as $pd) {
            $id = Utilities::encode($pd->getId());
            array_push($ids, $id);
        }

        return array(
            'detalle' => $platoDetalle,
            'ids'     => $ids,
        );
    }

    public function editAction($id, Request $request)
    {
        $doctrine = $this->getDoctrine();

        if ($id) {
            $id = Utilities::decode($id);
            $traduccion = $doctrine->getRepository('PladuchDataBundle:CatalogoPlatosTraduccion')->find($id);
        } else {
            $traduccion = new CatalogoPlatosTraduccion();
        }

        $form = $this->createEditForm($traduccion);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $doctrine->getManager();

            $em->persist($traduccion);
            $em->flush();

            return $this->redirect($this->generateUrl('pladuch_catalogo_show'));
        }

        return $this->render('PladuchBackBundle:catalogo:edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    private function createEditForm(CatalogoPlatosTraduccion $traduccion)
    {
        return $this->createForm(new DetallesCatalogoForm(), $traduccion);
    }

    private function createNewForm(CatalogoPlatos $catalogoPlatos)
    {
        return $this->createForm(new CatalogoForm(), $catalogoPlatos);
    }
}
