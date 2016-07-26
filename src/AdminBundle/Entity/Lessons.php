<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lessons
 *
 * @ORM\Table(name="lessons")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\LessonsRepository")
 */
class Lessons
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=255, nullable=true)
     */
    private $content;

    /**
     * @var \AdminBundle\Entity\Course
     *
     * @ORM\ManyToOne(targetEntity="AdminBundle\Entity\Course")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="courses_id", referencedColumnName="id")
     * })
     */
    private $coursesId;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=true )
     */
    private $isActive;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Lessons
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Lessons
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set coursesId
     *
     * @param \AdminBundle\Entity\Course $coursesId
     * @return Lessons
     */
    public function setCoursesId(\AdminBundle\Entity\Course $coursesId = null)
    {
        $this->coursesId = $coursesId;

        return $this;
    }

    /**
     * Get coursesId
     *
     * @return \AdminBundle\Entity\Course
     */
    public function getCoursesId()
    {
        return $this->coursesId;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Lessons
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }



}
