<?php

namespace App\Services\Url;

use App\Models\RegisterUrl;
use Illuminate\Support\Facades\Auth;

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
                                                   ->where('user_id', 1);

        $queryRegisterUrl->orderBy($order, $sort);

        $total = $queryRegisterUrl->count();

        $retorno = [];

        if ($queryRegisterUrl->count() > 0) {
            $queryRegisterUrl->offset($start)->limit($length);

            foreach ($queryRegisterUrl->get() as $key => $dataRegisterUrl) {
                $buttons = '';

                $buttons .= '<a href="#" data-id-url="' . $dataRegisterUrl->id . '" data-id-url-text="' . $dataRegisterUrl->url . '" class="btn editarUrl" data-skin="dark" data-toggle="tooltip" data-placement="top" title="Editar">
                                <span class="material-icons">
                                    edit_note
                                </span>
                            </a>';

                $buttons .= '<a href="#" data-id-url="' . $dataRegisterUrl->id . '" data-id-url-text="' . $dataRegisterUrl->url . '" class="btn deleteUrl" data-skin="dark" data-toggle="tooltip" data-placement="top" title="Excluir">
                                <span class="material-icons">
                                    delete
                                </span>
                            </a>';

                $retorno[$key] = array(

                    'id'          => $dataRegisterUrl->id,
                    'user_id'     => $dataRegisterUrl->user_id,
                    'url'         => $dataRegisterUrl->url,
                    'http_status' => $dataRegisterUrl->http_status,
                    'http_body'   => $dataRegisterUrl->http_body,
                    'action'      => $buttons,
                );
            }
        }

        return array(
            'sEcho'           => $draw,
            'recordsTotal'    => $total,
            'recordsFiltered' => $total,
            'data'            => $retorno,
        );
    }

    public function saveEditUrl($data)
    {
        if(isset($data['id']))
        {
            $dataUrl = $this->registerUrlModal->find($data['id']);

            $dataUrl->url = $data['url'];
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
}
