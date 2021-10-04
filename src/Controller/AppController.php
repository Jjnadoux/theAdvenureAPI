<?php

namespace App\Controller;

use App\Entity\Adventure;
use App\Entity\Character;
use App\Entity\Log;
use App\Entity\Monster;
use App\Entity\MonsterType;
use App\Entity\Tile;
use App\Services\AppServices;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /**
     * Start new adventure.
     * 
     * @Route("/adventure/start", name="create_character")
     */
    public function adventureStart(AppServices $service, Request $request): Response
    {
        $nameCharacter = $request->query->get('name');
        $newCharacter = $service->createCharacter($nameCharacter);

        $monster = $service->createMonster();

        $tile = $service->createTile($monster);

        $adventure = $service->createAdventure($newCharacter, $tile);

        return $this->json([
            'Character' => $newCharacter,
            'monster' => $monster,
            'tile' => $tile,
            'adventure' => $adventure
        ]);
    }

    /**
     * details of adventure
     * 
     * @Route("/adventure/{id}", name="details_adventure")
     * 
     * @param int $id adventure's id
     */
    public function detailsAdventure(EntityManagerInterface $em, int $id)
    {

        $adventure = $em->getRepository(Adventure::class)->find($id);
        $logs = $em->getRepository(Log::class)->findBy(["adventure" => $adventure]);
        $logMessage = [];
        foreach ($logs as $log) {
            $logMessage[] = $log->getDateLog()->format('Y-m-d h:m') . ": " . $log->getMessage();
        }
        return $this->json(["adventure" => $adventure, "log" => $logMessage]);
    }

    /**
     * details of character
     * 
     * @Route("/character/{id}", name="details_character")
     * 
     * @param int $id character's id
     */
    public function detailsCharacter(EntityManagerInterface $em, int $id)
    {

        $character = $em->getRepository(Character::class)->find($id);

        return $this->json(["character" => $character]);
    }

    /**
     * action Attack
     * 
     * @Route("/character/{id}/action/attack", name="action_attack")
     * 
     * @param int $id character's id
     */
    public function attack(EntityManagerInterface $em, AppServices $service, int $id)
    {
        //recovery of the data you need
        $character = $em->getRepository(Character::class)->find($id);
        $adventure = $em->getRepository(Adventure::class)->findOneBy(['character' => $character]);

        $tile = $adventure->getTile();
        $monster = $tile->getMonster();

        if ($character->getLife() == 0) {
            return $this->json(["error" => "You are dead you can not do anything!"]);
        } else {
            if ($monster->getLife() > 0) {
                //throwing the dice
                $valueAttack = $this->getValueAttack($character) - $monster->getType()->getArmor();
                $logMessage = [];

                if ($valueAttack >= $monster->getLife()) {
                    $monster->setLife(0);
                    $em->flush();
                    if ($monster->getType()->getName() == "Dragon") {
                        array_push($logMessage, "Congratulation " . $character->getName() . " !!  you knocked down the final Boss! you win the game.");
                        $service->EndAdventure($adventure);
                    } else {
                        array_push($logMessage, "Well done " . $character->getName() . " ! the monster has been defeated !");
                    }
                } else {
                    $monster->setLife($monster->getLife() - $valueAttack);
                    $em->flush();
                    array_push($logMessage, "the monster loses " . $valueAttack . " life points. he has " . $monster->getLife() . " life points left !");
                }

                if ($tile->getType()->getMonsterAffect() == "character") {
                    $character->setLife($character->getLife() - $tile->getType()->getBonus());
                    $em->flush();
                    array_push($logMessage, "You are in the desert, you lose " . $tile->getType()->getBonus() . " life point !");
                };
                $service->addLog($adventure, $logMessage);

                if ($monster->getLife() > 0) {
                    $service->monsterAttack($adventure, $character);
                    if ($character->getLife() <= 0) {
                        $score = $service->EndAdventure($adventure);
                    }
                }
            }
        }
        return $this->json(['character' => $character, 'adventure' => $adventure, 'tile' => $tile, 'monster' => $monster]);
    }

    /**
     * action Attack
     * 
     * @Route("/character/{id}/action/move", name="action_move")
     * 
     * @param int $id character's id
     */
    public function move(EntityManagerInterface $em, AppServices $service, int $id)
    {
        $character = $em->getRepository(Character::class)->find($id);
        $adventure = $em->getRepository(Adventure::class)->findOneBy(['character' => $character]);
        $monster = $adventure->getTile()->getMonster();
        $nbTile = $adventure->getNbTile();

        if ($nbTile < 10) {
            if ($monster->getLife() > 0) {
                $service->monsterAttack($adventure, $character);
                if ($character->getLife() <= 0) {
                    $service->EndAdventure($adventure);
                } else {
                    $newMonster = $service->createMonster();
                    $this->newTile($em, $service, $adventure, $newMonster);
                }
            } else {
                $newMonster = $service->createMonster();
                $this->newTile($em, $service, $adventure, $newMonster);
            }
        } else {
            $boss = $this->createTheBoss($em);
            $this->newTile($em, $service, $adventure, $boss);
        }

        return $this->json([$adventure]);
    }

    public function getValueAttack($character)
    {
        $valueAttack = 0;
        for ($i = 0; $i < $character->getNbDice(); $i++) {
            $valueDice = rand(1, $character->getNbFace());
            $valueAttack += $valueDice;
        }
        return $valueAttack;
    }

    public function newTile(EntityManagerInterface $em, AppServices $service, $adventure, $newMonster)
    {

        $newTile = $service->createTile($newMonster);
        $adventure->setTile($newTile);
        $adventure->setNbTile($adventure->getNbTile() + 1);
        $adventure->setScore($adventure->getScore() + 10);
        $em->flush();
    }
    public function createTheBoss(EntityManagerInterface $em){
        $theBoss = $em->getRepository(MonsterType::class)->findOneBy(['name'=>"Dragon"]);
        $monster = new Monster();
        $monster->setType($theBoss);
        $monster->setLife($theBoss->getLife());
        $em->persist($monster);
        $em->flush();

         return $monster;
    }
}
