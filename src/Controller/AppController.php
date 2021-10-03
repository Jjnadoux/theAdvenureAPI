<?php

namespace App\Controller;

use App\Entity\Adventure;
use App\Entity\Character;
use App\Entity\Log;
use App\Entity\Monster;
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
            array_push($logMessage, $log->getMessage());
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

        $character = $em->getRepository(Character::class)->find($id);
        $adventure = $em->getRepository(Adventure::class)->findOneBy(['character' => $character]);

        $tile = $adventure->getTile();
        $monster = $tile->getMonster();

        if ($monster->getLife() > 0) {
            $valueAttack = $this->getValueAttack($character);
            $logMessage = [];
            if ($valueAttack > $monster->getLife()) {
                $monster->setLife(0);
                $em->flush();
                array_push($logMessage, "bravo" . $character->getName() . " ! Le monstre a été vaincu !");
                // $service->addLog($adventure,"bravo".$character->getName()." ! Le monstre a été vaincu !");
            } else {
                $monster->setLife($monster->getLife() - $valueAttack);
                $em->flush();
                array_push($logMessage, "le montre perd " . $valueAttack . " points de vie. Il lui reste " . $monster->getLife() . " !");

                // $service->addLog($adventure,"le montre perd ".$valueAttack." points de vie. Il lui reste ".$monster->getLife()." !");
            }
            $service->addLog($adventure, $logMessage);
        }

        return $this->json(['character' => $character, 'adventure' => $adventure, 'tile' => $tile, 'monster' => $monster]);
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
}
