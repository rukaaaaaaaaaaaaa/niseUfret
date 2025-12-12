<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Song Entity
 *
 * @property int $id
 * @property string $title
 * @property int $singer_id
 * @property array|null $code
 * @property array|null $stroke
 * @property string|null $lyric
 * @property int|null $bpm
 * @property string|null $album
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Singer $singer
 */
class Song extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'title' => true,
        'singer_id' => true,
        'code' => true,
        'stroke' => true,
        'lyric' => true,
        'bpm' => true,
        'album' => true,
        'created' => true,
        'modified' => true,
        'singer' => true,
    ];
}
