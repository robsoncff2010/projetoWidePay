<?php

namespace App\Http\Controllers\Sistema\Url;

use App\Http\Controllers\Controller;
use App\Models\RegisterUrl;
use App\Services\Url\UrlService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UrlController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('url.index');
    }

    public function getList(Request $request)
    {
        try {
            $data = new UrlService(new RegisterUrl());
            $data = $data->listUrl($request->all());

            return Response()->json($data);
        } catch (\Exception $e) {

            return Response()->json([
                                      'result'  => false,
                                      'message' => $e->getMessage(),
                                    ]);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = new UrlService(new RegisterUrl());
            $data->saveEditUrl($request->all());

            return Response()->json([ 'result'  => true]);
        } catch (\Exception $e) {

            return Response()->json([
                                      'result'  => false,
                                      'message' => $e->getMessage(),
                                    ]);
        }
    }

    public function edit(Request $request)
    {
        try {
            $data = new UrlService(new RegisterUrl());
            $data->saveEditUrl($request->all());

            return Response()->json([ 'result'  => true]);
        } catch (\Exception $e) {

            return Response()->json([
                                      'result'  => false,
                                      'message' => $e->getMessage(),
                                    ]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $data = new UrlService(new RegisterUrl());
            $data->deleteUrl($request->id);

            return Response()->json([ 'result'  => true]);
        } catch (\Exception $e) {

            return Response()->json([
                                      'result'  => false,
                                      'message' => $e->getMessage(),
                                    ]);
        }
    }

    public function getDetail(Request $request)
    {
        try {
            $data = new UrlService(new RegisterUrl());
            $data = $data->detailUrl($request->id);

            return Response()->json([
                                        'result'   => true,
                                        'httpBody' => $data,
                                    ]);
        } catch (\Exception $e) {

            return Response()->json([
                                      'result'  => false,
                                      'message' => $e->getMessage(),
                                    ]);
        }
    }
}
