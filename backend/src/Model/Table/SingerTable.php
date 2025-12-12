<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Singer Model
 *
 * @property \App\Model\Table\SongsTable&\Cake\ORM\Association\HasMany $Songs
 *
 * @method \App\Model\Entity\Singer newEmptyEntity()
 * @method \App\Model\Entity\Singer newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Singer> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Singer get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Singer findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Singer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Singer> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Singer|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Singer saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Singer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Singer>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Singer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Singer> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Singer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Singer>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Singer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Singer> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SingerTable extends Table
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

        $this->setTable('singer');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Songs', [
            'foreignKey' => 'singer_id',
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        return $validator;
    }
}
