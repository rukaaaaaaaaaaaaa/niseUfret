<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Songs Model
 *
 * @property \App\Model\Table\SingerTable&\Cake\ORM\Association\BelongsTo $Singers
 *
 * @method \App\Model\Entity\Song newEmptyEntity()
 * @method \App\Model\Entity\Song newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Song> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Song get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Song findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Song patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Song> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Song|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Song saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Song>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Song>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Song>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Song> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Song>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Song>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Song>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Song> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SongsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('songs');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Singers', [
            'foreignKey' => 'singer_id',
            'className' => 'Singer',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->integer('singer_id')
            ->notEmptyString('singer_id');

        $validator
            ->allowEmptyString('code');

        $validator
            ->allowEmptyString('stroke');

        $validator
            ->scalar('lyric')
            ->allowEmptyString('lyric');

        $validator
            ->integer('bpm')
            ->allowEmptyString('bpm');

        $validator
            ->scalar('album')
            ->maxLength('album', 255)
            ->allowEmptyString('album');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['singer_id'], 'Singers'), ['errorField' => 'singer_id']);

        return $rules;
    }
}
