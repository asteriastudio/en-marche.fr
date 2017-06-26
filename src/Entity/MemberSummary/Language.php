<?php

namespace AppBundle\Entity\MemberSummary;

use AppBundle\Entity\Summary;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Intl\Intl;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="member_summary_languages")
 */
class Language
{
    const LEVEL_LOW = 'connaissance limitée';
    const LEVEL_BASIC = 'maîtrise basique';
    const LEVEL_MEDIUM = 'bonne maîtrise';
    const LEVEL_HIGH = 'maîtrise parfaite';
    const LEVEL_FLUENT = 'langue maternelle';

    const LEVELS = [
        self::LEVEL_LOW,
        self::LEVEL_BASIC,
        self::LEVEL_MEDIUM,
        self::LEVEL_HIGH,
        self::LEVEL_FLUENT,
    ];

    const LEVEL_CHOICES = [
        'member_summary.language.level.low' => self::LEVEL_LOW,
        'member_summary.language.level.basic' => self::LEVEL_BASIC,
        'member_summary.language.level.medium' => self::LEVEL_MEDIUM,
        'member_summary.language.level.high' => self::LEVEL_HIGH,
        'member_summary.language.level.fluent' => self::LEVEL_FLUENT,
    ];

    /**
     * @var int|null
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column
     *
     * @Assert\NotBlank
     * @Assert\Language
     */
    private $code = '';

    /**
     * @var string
     *
     * @ORM\Column
     *
     * @Assert\NotBlank
     * @Assert\Choice(strict=true, callback="getLevels")
     */
    private $level = '';

    /**
     * @var Summary|null
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Summary", inversedBy="languages")
     */
    private $summary;

    public function __toString(): string
    {
        return sprintf('%s - %s', ucfirst(Intl::getLanguageBundle()->getLanguageName($this->code)), ucfirst($this->level));
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function getLevel(): string
    {
        return $this->level;
    }

    public function setLevel(string $level): void
    {
        $this->level = $level;
    }

    public function getSummary(): ?Summary
    {
        return $this->summary;
    }

    public function setSummary(?Summary $summary)
    {
        $this->summary = $summary;
    }

    public static function getLevels(): array
    {
        return self::LEVELS;
    }
}
