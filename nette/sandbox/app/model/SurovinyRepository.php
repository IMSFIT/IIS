<?php
namespace Todo;
use Nette;

/**
 * Tabulka suroviny
 */
class SurovinyRepository extends Repository
{
	public function findIncomplete()
{
    return $this->findBy(array('done' => false))->order('created ASC');
}



 public function updateSklad()
      {
                return $this->getTable()->update(array(
                        
                        
                        
                        'mnozstvi_surovin' => 2000,
						'mnozstvi_objednane_suroviny' =>0,
                ));
        }
	public function updateSkladByObjednavka($id_suroviny,$mnozstvo,$objednane)
	{
	  	      return $this->findBy(array('id_suroviny' => $id_suroviny))->update(array(
                        
                        
                        
                        'mnozstvi_surovin' => $mnozstvo,
						'mnozstvi_objednane_suroviny' =>$objednane,
						'datum_objednavky' =>new \DateTime(),
                ));
		
	}
	
		public function updateSkladByJedlo($jedlo,$mnozstvo,$objednane)
	{
	  	      return $this->findBy(array('nazev_suroviny' => $jedlo))->update(array(
                        
                        
                        
                        'mnozstvi_surovin' => $mnozstvo,
						'mnozstvi_objednane_suroviny' =>$objednane,
						'datum_objednavky' =>new \DateTime(),
                ));
		
	}
	
	

}

