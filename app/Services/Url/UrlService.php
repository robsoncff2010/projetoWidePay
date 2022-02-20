<?php

namespace App\Services\Url;

use App\Models\RegisterUrl;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class UrlService
{
    private $registerUrlModal;

    public function __construct(RegisterUrl $modal)
    {
        $this->registerUrlModal = $modal;
    }

    public function listUrl($data)
    {
        $draw   = isset($data['draw'])   ? $data['draw']   : 1;
        $length = isset($data['length']) ? $data['length'] : 10;
        $start  = isset($data['start'])  ? $data['start']  : 0;

        $order = null;
        $sort  = null;

        if(isset($data['order'])) {
            $sort = $data['order'][0]['dir'];
            $columns = [
                0 => 'id',
                1 => 'user_id',
                2 => 'url',
                3 => 'http_status',
                4 => 'http_body',
            ];

            $order = $columns[$data['order'][0]['column']];
        }

        $queryRegisterUrl = $this->registerUrlModal->query()
                                                   ->where('user_id', 1)
                                                   ->with('user');

        $queryRegisterUrl->orderBy($order, $sort);

        $total = $queryRegisterUrl->count();

        $return = [];

        if ($queryRegisterUrl->count() > 0) {
            $queryRegisterUrl->offset($start)->limit($length);

            foreach ($queryRegisterUrl->get() as $key => $dataRegisterUrl) {
                $buttons    = '';
                $httpBody   = '';
                $httpStatus = '';

                $buttons .= '<a href="#" data-id-url="' . $dataRegisterUrl->id . '" data-id-url-text="' . $dataRegisterUrl->url . '" class="btn btn-sm btn-outline-primary editarUrl" data-skin="dark" data-toggle="tooltip" data-placement="top" title="Editar">
                                <span class="material-icons">
                                    edit_note
                                </span>
                            </a>';

                $buttons .= '<a href="#" data-id-url="' . $dataRegisterUrl->id . '" data-id-url-text="' . $dataRegisterUrl->url . '" class="btn btn-sm btn-outline-danger deleteUrl" data-skin="dark" data-toggle="tooltip" data-placement="top" title="Excluir">
                                <span class="material-icons">
                                    delete
                                </span>
                            </a>';

                if($dataRegisterUrl->http_body != null)
                {
                    $httpBody = '<a href="#" data-id-url="' . $dataRegisterUrl->id . '" class="btn btn-sm btn-outline-warning detailBodyUrl" data-skin="dark" data-toggle="tooltip" data-placement="top" title="Detalhes http">
                                    <span class="material-icons">
                                        search
                                    </span>
                                </a>';
                }

                if($dataRegisterUrl->http_status != null)
                {
                    if(($dataRegisterUrl->http_status >= 200) && ($dataRegisterUrl->http_status <= 299))
                    {
                        $httpStatus = '<span class="fw-bold btn-outline-success">
                                        ' . $dataRegisterUrl->http_status . '
                                       </span>';
                    }else
                    {
                        $httpStatus = '<span class="fw-bold btn-outline-danger">
                                        ' . $dataRegisterUrl->http_status . '
                                       </span>';
                    }
                }

                $return[$key] = array(

                    'id'          => $dataRegisterUrl->id,
                    'user_id'     => $dataRegisterUrl->user->name,
                    'url'         => $dataRegisterUrl->url,
                    'http_status' => $httpStatus,
                    'http_body'   => $httpBody,
                    'action'      => $buttons,
                );
            }
        }

        return array(
            'sEcho'           => $draw,
            'recordsTotal'    => $total,
            'recordsFiltered' => $total,
            'data'            => $return,
        );
    }

    public function saveEditUrl($data)
    {
        if(isset($data['id']))
        {
            $dataUrl = $this->registerUrlModal->find($data['id']);

            $dataUrl->url         = $data['url']         ?? $dataUrl->url;
            $dataUrl->http_status = $data['http_status'] ?? null;
            $dataUrl->http_body   = $data['http_body']   ?? null;
            $dataUrl->save();
        }else
        {
            $arrayUrl['user_id'] = auth()->user()->id;
            $arrayUrl['url']     = $data['url'];

            $this->registerUrlModal->create($arrayUrl);
        }
    }

    public function deleteUrl($idUrl)
    {
        $dataUrl = $this->registerUrlModal->find($idUrl);
        $dataUrl->delete();
    }

    public function detailUrl($idUrl)
    {
        $dataUrl = $this->registerUrlModal->find($idUrl);
        return $dataUrl->http_body;
    }

    public function accessUrls()
    {
        $listUrls = $this->registerUrlModal->all();

        foreach ($listUrls as $key => $url) {
            try {
                try {
                    $client   = new Client();
                    $response = $client->get($url->url);

                    $editUrl['id']          = $url->id;
                    $editUrl['http_status'] = $response->getStatusCode();
                    $editUrl['http_body']   = $response->getBody()->getContents();

                    $this->saveEditUrl($editUrl);

                } catch (ClientException $e) {
                    $errorUrl['id']          = $url->id;
                    $errorUrl['http_status'] = $e->getResponse()->getStatusCode();
                    $errorUrl['http_body']   = $e->getResponse()->getBody()->getContents();

                    $this->saveEditUrl($errorUrl);
                    //log de erro da requisicao
                }
            } catch (\Exception $e) {

                $errorUrl2['id']          = $url->id;
                $errorUrl2['http_status'] = null;
                $errorUrl2['http_body']   = null;

                $this->saveEditUrl($errorUrl2);
                // dd($e->getMessage());
            }
        }
    }
}
