<?php

namespace BasketballBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Player
 *
 * @ORM\Table(name="player")
 * @ORM\Entity
 */
class Player
{
    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="player")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Specialization", inversedBy="player")
     */
    private $specialization;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="nickname", type="string", length=255)
     */
    private $nickname;

    /**
     * @var int
     *
     * @ORM\Column(name="height", type="integer")
     */
    private $height;

    /**
     * @var int
     *
     * @ORM\Column(name="games", type="integer")
     */
    private $games;

    /**
     * @var string
     *
     * @ORM\Column(name="photoFront", type="string", length=255)
     */
    private $photoFront;


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
     * Set name
     *
     * @param string $name
     *
     * @return Player
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set nickname
     *
     * @param string $nickname
     *
     * @return Player
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * Get nickname
     *
     * @return string
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Set height
     *
     * @param integer $height
     *
     * @return Player
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set games
     *
     * @param integer $games
     *
     * @return Player
     */
    public function setGames($games)
    {
        $this->games = $games;

        return $this;
    }

    /**
     * Get games
     *
     * @return int
     */
    public function getGames()
    {
        return $this->games;
    }

    /**
     * Set photoFront
     *
     * @param string $photoFront
     *
     * @return Player
     */
    public function setPhotoFront($photoFront)
    {
        $this->photoFront = $photoFront;

        return $this;
    }

    /**
     * Get photoFront
     *
     * @return string
     */
    public function getPhotoFront()
    {
        return $this->photoFront;
    }

    function getSpecialization() {
        return $this->specialization;
    }

    function setSpecialization($specialization)
    {
        $this->specialization = $specialization;
    }

    function getUser()
    {
        return $this->user;
    }

    function setUser($user)
    {
        $this->user = $user;
    }
}