<?php
/**
 * Created by PhpStorm.
 * User: bartosz
 */

namespace BartoszBartniczak\Doctrine\Tests\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="test_datetime")
 */
class TestDatetime
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="test_datetime_id_seq", initialValue=2)
     * @ORM\Column(name="id", type="integer", nullable=false)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="row_date", type="datetime_microseconds", nullable=false)
     */
    private $rowDate;

    /**
     * TestDatetime constructor.
     */
    public function __construct(\DateTime $rowDate)
    {
        $this->rowDate = $rowDate;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getRowDate(): \DateTime
    {
        return $this->rowDate;
    }
}
