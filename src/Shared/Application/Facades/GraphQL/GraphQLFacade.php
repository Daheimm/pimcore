<?php

namespace App\Shared\Application\Facades\GraphQL;

use App\Shared\Infrastructure\Http\GraphQL\GraphQL;
use Lagdo\Symfony\Facades\AbstractFacade;
/**
 * Class GraphQLFacade
 *
 * Фасад для виконання GraphQL запитів.
 * Дозволяє взаємодіяти з GraphQL API через спрощений інтерфейс.
 * @method static array executeQuery(string $endpoint, string $query, string $xApiKey) Виконує GraphQL запит і повертає відповідь як масив.
 * @package App\Shared\Application\Facades\GraphQL
 */
class GraphQLFacade extends AbstractFacade
{

    protected static function getServiceIdentifier()
    {
        return GraphQL::class;
    }
}
