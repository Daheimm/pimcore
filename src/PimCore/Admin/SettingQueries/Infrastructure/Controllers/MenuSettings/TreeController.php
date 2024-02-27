<?php

namespace App\PimCore\Admin\SettingQueries\Infrastructure\Controllers\MenuSettings;

use App\PimCore\Admin\SettingQueries\Application\Services\Interfaces\TreeServiceInterface;
use App\PimCore\Admin\SettingQueries\Infrastructure\Controllers\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin-custom/tree', name: 'tree')]
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

    #[Route('', name: '_save', methods: 'POST')]
    public function store(Request $request)
    {
        $saved = $this->treeService->save($request->get('nameType'));
        return $this->response($saved);
    }

    #[Route('', name: '_remove', methods: 'DELETE')]
    public function destroy(Request $request)
    {
       $this->treeService->remove($request->get('id'));
        return $this->response([]);
    }

}
