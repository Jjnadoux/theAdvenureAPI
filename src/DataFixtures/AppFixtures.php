<?php

namespace App\DataFixtures;

use App\Entity\MonsterType;
use App\Entity\TileType;
use PhpParser\Node\Stmt\Foreach_;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
       $monsterTypes = [
          0 => [
              "name" => "ork",
              "life" => 10,
              "nbDice" => 1,
              "nbFace" => 6,
              "malus" => 0,
              "armor"=> 4
          ],
          1 => [
            "name" => "gabelin",
            "life" => 12,
            "nbDice" => 1,
            "nbFace" => 4,
            "malus" => 1,
            "armor"=> 6
          ],
          2 => [
            "name" => "ghost",
            "life" => 8,
            "nbDice" => 1,
            "nbFace" => 4,
            "malus" => 0,
            "armor"=> 6
          ],
          3 => [
            "name" => "troll",
            "life" => 12,
            "nbDice" => 1,
            "nbFace" => 6,
            "malus" => 0,
            "armor" => 6
            ]
        ];
    
        foreach ($monsterTypes as $monster) {
           
            $newMonsterType = new MonsterType;
            $newMonsterType->setName($monster["name"]);
            $newMonsterType->setLife($monster["life"]);
            $newMonsterType->setArmor($monster["armor"]);
            $newMonsterType->setNbDice($monster["nbDice"]);
            $newMonsterType->setNbFace($monster["nbFace"]);
            $newMonsterType->setMalus($monster["malus"]);
            $manager ->persist($newMonsterType);
            $manager->flush();
        }
       
        $tileType = [
            0 => [
                "name" => "grasslands",
                "bonus" => 2,
                "monsterAffect" => "ork"
            ],
            1 => [
                "name" => "hills",
                "bonus" => 2,
                "monsterAffect" => "ghost"
            ],
            2 => [
                "name" => "forest",
                "bonus" => 2,
                "monsterAffect" => "gobelin"
            ],
            3 => [
                "name" => "mountains",
                "bonus" => 2,
                "monsterAffect" => "troll"
            ],
            4 => [
                "name" => "desert",
                "bonus" => 1,
                "monsterAffect" => "character"
            ],
        ];

        foreach ($tileType as $tile) {
           
            $newTileType = new TileType;
            $newTileType->setName($tile["name"]);
            $newTileType->setBonus($tile["bonus"]);
            $newTileType->setMonsterAffect($tile["monsterAffect"]);
            $manager ->persist($newTileType);
            $manager->flush();
        }
    }
}
