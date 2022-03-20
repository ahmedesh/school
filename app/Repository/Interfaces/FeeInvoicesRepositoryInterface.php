<?php

namespace App\Repository\Interfaces;

interface FeeInvoicesRepositoryInterface
{

    public function index();


    public function show($id);


    public function store($request);


//    public function Get_amount($id);

    public function edit($id);

    public function update($request);

    public function destroy($request);
}
