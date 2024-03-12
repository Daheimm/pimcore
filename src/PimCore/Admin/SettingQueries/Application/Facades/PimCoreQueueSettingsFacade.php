<?php

namespace App\PimCore\Admin\SettingQueries\Application\Facades;

use App\PimCore\Admin\SettingQueries\Domain\Entity\GraphQl\GraphqlRequestsPimcore;
use App\PimCore\Admin\SettingQueries\Infrastructure\Repositories\GraphQl\GraphqlRequestsPimcoreRepository;
use Lagdo\Symfony\Facades\AbstractFacade;

/**
 * Фасад PimCoreQueueSettings надає спрощений доступ до налаштувань GraphQL черги PimCore.
 *
 * @method static ?GraphqlRequestsPimcore getGraphQl(string $type) Отримати GraphQL запит за типом.
 * @method static array getAll() Отримати всі налаштування GraphQL.
 * @method static array getTree() Отримати дерево налаштувань GraphQL.
 * @method static array findByTypeIdWithEmptyEndpoint(int $typeId) Отримати всі налаштування GraphQL.
 * @method static array findByTypeIdAndPath(int $typeId, string $path) Отримати дерево налаштувань GraphQL.
 * @method static array getByTypeId(int $id) Отримати GraphQL налаштування за ідентифікатором типу.
 * @method static GraphqlRequestsPimcore save(GraphqlRequestsPimcore $graphqlRequestsPimcore) Зберегти налаштування GraphQL.
 * @method static GraphqlRequestsPimcore update(GraphqlRequestsPimcore $graphqlRequestsPimcore) Оновити налаштування GraphQL.
 * @method static void remove(int $id) Видалити налаштування GraphQL за ідентифікатором.
 */
class PimCoreQueueSettingsFacade extends AbstractFacade
{
    protected static function getServiceIdentifier(): string
    {
        return GraphqlRequestsPimcoreRepository::class;
    }
}
