<?php

namespace Nieruchomosci\Form;

use Laminas\Form\Form;

class OfertaSzukajForm extends Form
{
    public function __construct()
    {
        parent::__construct('oferta_szukaj');

        $this->setAttribute('method', 'get');
        $this->add([
            'name' => 'typ_oferty',
            'type' => 'Select',
            'options' => [
                'label' => 'Typ oferty',
                'empty_option' => '-',
                'value_options' => [
                    'S' => 'sprzedaż',
                    'W' => 'wynajem',
                ],
            ],
        ]);
        $this->add([
            'name' => 'typ_nieruchomosci',
            'type' => 'Select',
            'options' => [
                'label' => 'Typ nieruchomości',
                'empty_option' => '-',
                'value_options' => [
                    'M' => 'mieszkanie',
                    'D' => 'dom',
                    'G' => 'grunt',
                ],
            ],
        ]);
        $this->add([
            'name' => 'numer',
            'type' => 'Text',
            'options' => [
                'label' => 'Numer',
            ],
        ]);
        $this->add([
            'name' => 'cena_od',
            'type' => 'Text',
            'options' => [
                'label' => 'Cena',
            ],
        ]);
        $this->add([
            'name' => 'cena_do',
            'type' => 'Text',
            'options' => [
                'label' => 'Cena',
            ],
        ]);
        $this->add([
            'name' => 'powierzchnia_od',
            'type' => 'Text',
            'options' => [
                'label' => 'Powierzchnia',
            ],
        ]);
        $this->add([
            'name' => 'powierzchnia_do',
            'type' => 'Text',
            'options' => [
                'label' => 'Powierzchnia',
            ],
        ]);
        $this->add([
            'name' => 'szukaj',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Szukaj',
                'class' => 'btn btn-primary',
            ],
            'options' => [
                'label' => 'Szukaj',
            ],
        ]);
    }
}
