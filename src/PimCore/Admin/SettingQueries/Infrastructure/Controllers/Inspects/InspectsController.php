<?php

namespace App\PimCore\Admin\SettingQueries\Infrastructure\Controllers\Inspects;

use App\PimCore\Admin\SettingQueries\Application\Services\Interfaces\InspectServiceInterface;
use App\PimCore\Admin\SettingQueries\Infrastructure\Controllers\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin-custom/inspect-queries', name: 'inspect-queries_')]
class InspectsController extends Controller
{
    public function __construct(private readonly InspectServiceInterface $inspectService)
    {
    }

    #[Route('', name: 'check', methods: 'POST')]
    public function index(Request $request)
    {
        try {
            $data = json_decode($request->get('data'), true);

            $id = $data['id'] ?? null;

            return $this->response($this->inspectService->checkQuery($id));
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
    }
}
