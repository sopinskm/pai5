<?php

namespace Nieruchomosci\Model;

use Laminas\Db\Adapter as DbAdapter;
use Laminas\Db\Sql\Sql;
use Laminas\Paginator\Adapter\LaminasDb\DbSelect;
use Laminas\Paginator\Paginator;

class Oferta implements DbAdapter\AdapterAwareInterface
{
    use DbAdapter\AdapterAwareTrait;

    /**
     * Pobiera obiekt Paginator dla przekazanych parametrów.
     *
     * @param array $szukaj
     * @return \Laminas\Paginator\Paginator
     */
    public function pobierzWszystko(array $szukaj = []): Paginator
    {
        $dbAdapter = $this->adapter;

        $sql = new Sql($dbAdapter);
        $select = $sql->select('oferty');

        if (!empty($szukaj['typ_oferty'])) {
            $select->where(['typ_oferty' => $szukaj['typ_oferty']]);
        }
        if (!empty($szukaj['typ_nieruchomosci'])) {
            $select->where(['typ_nieruchomosci' => $szukaj['typ_nieruchomosci']]);
        }
        if (!empty($szukaj['numer'])) {
            $select->where(['numer' => $szukaj['numer']]);
        }
        if (!empty($szukaj['powierzchnia_od'])) {
            $select->where->greaterThanOrEqualTo('powierzchnia', $szukaj['powierzchnia_od']);
        }
        if (!empty($szukaj['powierzchnia_do'])) {
            $select->where->lessThanOrEqualTo('powierzchnia', $szukaj['powierzchnia_do']);
        }
        if (!empty($szukaj['cena_od'])) {
            $select->where->greaterThanOrEqualTo('cena', $szukaj['cena_od']);
        }
        if (!empty($szukaj['cena_do'])) {
            $select->where->lessThanOrEqualTo('cena', $szukaj['cena_do']);
        }

        $paginatorAdapter = new DbSelect($select, $dbAdapter);

        return new Paginator($paginatorAdapter);
    }

    /**
     * Pobiera dane jednej oferty.
     *
     * @param int $id
     * @return array
     */
    public function pobierz(int $id): \ArrayObject
    {
        $dbAdapter = $this->adapter;

        $sql = new Sql($dbAdapter);
        $select = $sql->select('oferty');
        $select->where(['id' => $id]);

        $selectString = $sql->buildSqlString($select);
        $wynik = $dbAdapter->query($selectString, $dbAdapter::QUERY_MODE_EXECUTE);

        return $wynik->count() ? $wynik->current() : [];
    }
}
