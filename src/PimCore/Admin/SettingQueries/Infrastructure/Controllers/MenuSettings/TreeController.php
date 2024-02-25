<?php

namespace App\PimCore\Admin\SettingQueries\Infrastructure\Controllers\MenuSettings;

use App\PimCore\Admin\SettingQueries\Application\Services\Interfaces\TreeServiceInterface;
use App\PimCore\Admin\SettingQueries\Infrastructure\Controllers\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin-custom/tree-list', name: 'tree')]
class TreeController extends Controller
{
    public function __construct(private readonly TreeServiceInterface $treeService)
    {
    }

    #[Route('', name: '_get_list', methods: 'GET')]
    public function index()
    {

        return $this->response($this->treeService->getTree());
    }

}
