<?php

namespace Nieruchomosci\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Nieruchomosci\Form;
use Nieruchomosci\Model\Oferta;

class OfertyController extends AbstractActionController
{
    private Oferta $oferta;

    /**
     * OfertyController constructor.
     *
     * @param Oferta $oferta
     */
    public function __construct(Oferta $oferta)
    {
        $this->oferta = $oferta;
    }

    public function listaAction()
    {
        $parametry = $this->params()->fromQuery();
        $strona = $parametry['strona'] ?? 1;

        // pobierz dane ofert
        $paginator = $this->oferta->pobierzWszystko($parametry);
        $paginator->setItemCountPerPage(10)->setCurrentPageNumber($strona);

        // zbuduj formularz wyszukiwania
        $form = new Form\OfertaSzukajForm();
        $form->populateValues($parametry);

        return new ViewModel([
            'form' => $form,
            'oferty' => $paginator,
            'parametry' => $parametry,
        ]);
    }

    public function szczegolyAction()
    {
        $daneOferty = $this->oferta->pobierz($this->params('id'));

        return ['oferta' => $daneOferty];
    }
}
