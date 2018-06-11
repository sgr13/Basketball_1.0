<?php

namespace BasketballBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlayersList
 *
 * @ORM\Table(name="players_list")
 * @ORM\Entity(repositoryClass="BasketballBundle\Repository\PlayersListRepository")
 */
class PlayersList
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Player")
     */
    private $player1;

    /**
     * @ORM\ManyToOne(targetEntity="Player")
     */
    private $player2;

    /**
     * @ORM\ManyToOne(targetEntity="Player")
     */
    private $player3;

    /**
     * @ORM\ManyToOne(targetEntity="Player")
     */
    private $player4;

    /**
     * @ORM\ManyToOne(targetEntity="Player")
     */
    private $player5;

    /**
     * @ORM\ManyToOne(targetEntity="Player")
     */
    private $player6;

    /**
     * @ORM\ManyToOne(targetEntity="Player")
     */
    private $player7;

    /**
     * @ORM\ManyToOne(targetEntity="Player")
     */
    private $player8;

    /**
     * @ORM\ManyToOne(targetEntity="Player")
     */
    private $player9;

    /**
     * @ORM\ManyToOne(targetEntity="Player")
     */
    private $player10;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getPlayer1()
    {
        return $this->player1;
    }

    /**
     * @param mixed $player1
     */
    public function setPlayer1($player1)
    {
        $this->player1 = $player1;
    }

    /**
     * @return mixed
     */
    public function getPlayer2()
    {
        return $this->player2;
    }

    /**
     * @param mixed $player2
     */
    public function setPlayer2($player2)
    {
        $this->player2 = $player2;
    }

    /**
     * @return mixed
     */
    public function getPlayer3()
    {
        return $this->player3;
    }

    /**
     * @param mixed $player3
     */
    public function setPlayer3($player3)
    {
        $this->player3 = $player3;
    }

    /**
     * @return mixed
     */
    public function getPlayer4()
    {
        return $this->player4;
    }

    /**
     * @param mixed $player4
     */
    public function setPlayer4($player4)
    {
        $this->player4 = $player4;
    }

    /**
     * @return mixed
     */
    public function getPlayer5()
    {
        return $this->player5;
    }

    /**
     * @param mixed $player5
     */
    public function setPlayer5($player5)
    {
        $this->player5 = $player5;
    }

    /**
     * @return mixed
     */
    public function getPlayer6()
    {
        return $this->player6;
    }

    /**
     * @param mixed $player6
     */
    public function setPlayer6($player6)
    {
        $this->player6 = $player6;
    }

    /**
     * @return mixed
     */
    public function getPlayer7()
    {
        return $this->player7;
    }

    /**
     * @param mixed $player7
     */
    public function setPlayer7($player7)
    {
        $this->player7 = $player7;
    }

    /**
     * @return mixed
     */
    public function getPlayer8()
    {
        return $this->player8;
    }

    /**
     * @param mixed $player8
     */
    public function setPlayer8($player8)
    {
        $this->player8 = $player8;
    }

    /**
     * @return mixed
     */
    public function getPlayer9()
    {
        return $this->player9;
    }

    /**
     * @param mixed $player9
     */
    public function setPlayer9($player9)
    {
        $this->player9 = $player9;
    }

    /**
     * @return mixed
     */
    public function getPlayer10()
    {
        return $this->player10;
    }

    /**
     * @param mixed $player10
     */
    public function setPlayer10($player10)
    {
        $this->player10 = $player10;
    }
}

