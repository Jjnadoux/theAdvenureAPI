<?php


namespace App\Services; 

use App\Entity\Tile;
use App\Entity\Monster;
use App\Entity\Adventure;
use App\Entity\Character;
use App\Entity\Log;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;


class AppServices
{
    protected $em;

    /**
     * StatutService constructor.
     * @param $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * 
     */
    public function addLog($adventure, $messages){

        foreach ($messages as $message) {
            $log = new Log();
            $log->setDateLog(new DateTime());
            $log->setMessage($message);
            $log->setAdventure($adventure);
            $this->em->persist($log);
        }

        $this->em->flush();

        return $log;
    }

    public function createCharacter($name){
      
        $newCharacter = new Character();
        $newCharacter->setName($name);
        $newCharacter->setLife(20);
        $newCharacter->setArmor(5);
        $newCharacter->setNbDice(2);
        $newCharacter->setNbFace(6);
        $this->em->persist($newCharacter);
        $this->em->flush();

        return $newCharacter;
    }

    public function createMonster(){

        $query2 =  $this->em->createQuery("SELECT q FROM App\Entity\MonsterType q ORDER BY RAND()")->setMaxResults(1);
        $monsterType = $query2->execute();
        $monster = new Monster();
        $monster->setType($monsterType[0]);
        $monster->setLife($monsterType[0]->getLife());
        $this->em->persist($monster);
        $this->em->flush();

         return $monster;
    }

    

    public function createTile(Monster $monster){

        $tile = new Tile();
        $query =  $this->em->createQuery("SELECT q FROM App\Entity\TileType q ORDER BY RAND()")->setMaxResults(1);
        $tyleType = $query->execute();
    
        $tile->setType($tyleType[0]);
        $tile->setMonster($monster);
        $this->em->persist($tile);
        $this->em->flush();

        return $tile;
    }

    public function createAdventure(Character $character, Tile $tile){

        $adventure = new Adventure();
        $adventure->setTile($tile);
        $adventure->setCharacter($character);
        $adventure->setScore(0);
        $adventure->setNbTile(1);
      
        $this->em->persist($adventure);
        $this->em->flush();

        $this->addLog($adventure,["start adventure ".$character->getName()." !"]);

        return $adventure;
    }

    public function monsterAttack(Adventure $adventure, Character $character){
        
        //recovery of the data you need
        $typeTile = $adventure->getTile()->getType();
        $monster = $adventure->getTile()->getMonster();
        $monsterType = $monster->getType();

        //throwing the dice
        $valueAttack = $this->getValueAttackMonster($monsterType) - $character->getArmor() + $monsterType->getMalus();
        $logMessage = [];

        //consequence of the attack
        if ($typeTile->getMonsterAffect() == $monsterType->getName()){
            $valueAttack += $typeTile->getBonus();
        }
        
        if ($valueAttack > $character->getLife()) {
            $character->setLife(0);
            $this->em->flush();
            array_push($logMessage, "GAME OVER " . $character->getName() . " ! the monster killed you !");

            $this->EndAdventure($adventure);
           
        } else {
            $character->setLife($character->getLife() - $valueAttack);
            $this->em->flush();
            array_push($logMessage, "the monster attacked you, you loose " . $valueAttack . " life points. You have " . $character->getLife() . " life points !");

        }

        if ($typeTile->getMonsterAffect() == "character"){
            $character->setLife($character->getLife() - $typeTile->getBonus());
            $this->em->flush();
            array_push($logMessage,"You are in the desert, you lose " . $typeTile->getBonus() . " life point !");
        };

        $this->addLog($adventure, $logMessage);


    }

    public function getValueAttackMonster($monsterType)
    {
        $valueAttack = 0;
        for ($i = 0; $i < $monsterType->getNbDice(); $i++) {
            $valueDice = rand(1, $monsterType->getNbFace());
            $valueAttack += $valueDice;
        }
        return $valueAttack;
    }

    public function EndAdventure($adventure){

        $score = $adventure->getScore();
        $this->addLog($adventure,['END ADVENTURE']);

    }

}