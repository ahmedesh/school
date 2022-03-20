<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Repository\Interfaces\StudentPromotionRepositoryInterface;
use Illuminate\Http\Request;

class PromotionController extends Controller
{

    protected $Promotion;

    public function __construct(StudentPromotionRepositoryInterface $Promotion)
    {
        $this->Promotion = $Promotion;
    }

    public function index()
    {
        return $this->Promotion->index();
    }


    public function create()
    {
        return $this->Promotion->create();
    }


    public function store(Request $request)
    {
        return $this->Promotion->store($request);
    }


    public function destroy(Request $request)
    {
        return $this->Promotion->destroy($request);
    }

}
