<?php

namespace App\Factory;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Users|Proxy createOne(array $attributes = [])
 * @method static Users[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static Users|Proxy find($criteria)
 * @method static Users|Proxy findOrCreate(array $attributes)
 * @method static Users|Proxy first(string $sortedField = 'id')
 * @method static Users|Proxy last(string $sortedField = 'id')
 * @method static Users|Proxy random(array $attributes = [])
 * @method static Users|Proxy randomOrCreate(array $attributes = [])
 * @method static Users[]|Proxy[] all()
 * @method static Users[]|Proxy[] findBy(array $attributes)
 * @method static Users[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Users[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static UsersRepository|RepositoryProxy repository()
 * @method Users|Proxy create($attributes = [])
 */
final class UsersFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://github.com/zenstruck/foundry#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            'pseudo' => 'Player 1',
            'gangName' => 'The Killers of the hive',
            'gangTypeId' => 1
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->afterInstantiate(function(Users $users) {})
        ;
    }

    protected static function getClass(): string
    {
        return Users::class;
    }
}
