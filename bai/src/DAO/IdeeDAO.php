<?php

namespace BAI\DAO;

use BAI\Domain\Article;

class IdeeDAO extends DAO
{
    /**
     * Return a list of all idees, sorted by date (most recent first).
     *
     * @return array A list of all idees.
     */
    public function findAll() {
        $sql = "select * from boite_a_idees order by id desc";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $idees = array();
        foreach ($result as $row) {
            $ideeId = $row['id'];
            $idees[$ideeId] = $this->buildDomainObject($row);
        }
        return $idees;
    }

    /**
     * Returns an idee matching the supplied id.
     *
     * @param integer $id The idee id.
     *
     * @return \BAI\Domain\idee|throws an exception if no matching idee is found
     */
    public function find($id) {
        $sql = "select * from t_article where art_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No idee matching id " . $id);
    }

    /**
     * Creates an idee object based on a DB row.
     *
     * @param array $row The DB row containing idee data.
     * @return \BAI\Domain\idee
     */

    protected function buildDomainObject(array $row) {
        $idee = new Idee();
        $idee->setId($row['id']);
        $idee->setTexte($row['texte']);
        $idee->setValide($row['valide']);
        return $idee;
    }
}
