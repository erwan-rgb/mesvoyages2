<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Tests\Repository;

use App\Repository\VisiteRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Description of VisiteRepositoryTest
 *
 * @author erwme
 */
class VisiteRepositoryTest extends KernelTestCase{
    
    public function recupRepository(): VisiteRepository{
        self::bootKernel();
        $repository = self::getContainer()->get(VisiteRepository::class);
        return $repository;
    }
    
    public function testNbVisites(){
        $repository = $this->recupRepository();
        $nbVisites = $repository->count([]);
        $this->assertIsInt($nbVisites);
    }
    
    public function testAddVisite(){
       $repository = $this->recupRepository();
       $nbVisites = $repository->count([]);
       $visite = new \App\Entity\Visite();
       $visite->setVille("Londre");
       $visite->setPays("United-Kingdom");
       $repository->add($visite);
       $this->assertEquals($nbVisites + 1, $repository->count([]), "erreur lors de l'ajout");
   }
   
   public function testRemoveVisite(){
       $repository = $this->recupRepository();
       $visite = $this->newVisite();
       $repository->add($visite, true);
       $nbVisites = $repository->count([]);
       $repository->remove($visite, true);
       $this->assertEquals($nbVisites - 1, $repository->count([]), "erreur lors de la suppression");
   }
   
   public function testFindByEqualValue(){
       $repository = $this->recupRepository();
       $visite = $this->newVisite();
       $repository->add($visite, true);
       $visites = $repository->findByEqualValue("ville", "Londre");
       $nbVisites = count($visites);
       $this->assertEquals(1, $nbVisites);
       $this->assertEquals("Londre", $visites[0]->getVille());
   }
   
   private function newVisite(): \App\Entity\Visite{
       $visite = new \App\Entity\Visite();
       $visite->setVille("Paris"); 
       $visite->setPays("France");
       $visite->setDatecreation(new \DateTime());
       $visite->setNote(15);
       $visite->setAvis("Très belle ville");
       $visite->setTempmin(10);
       $visite->setTempmax(20);
       return $visite;
    }
     
}
