<?php
/**
 * GalleryController
 * @package api-gallery
 * @version 0.0.1
 */

namespace ApiGallery\Controller;

use LibFormatter\Library\Formatter;

use Gallery\Model\Gallery;

class GalleryController extends \Api\Controller
{

    public function indexAction() {
        if(!$this->app->isAuthorized())
            return $this->resp(401);

        list($page, $rpp) = $this->req->getPager();

        $cond = $this->req->getCond(['q']);

        $galleries = Gallery::get($cond, $rpp, $page, ['id'=>false]) ?? [];
        if($galleries)
            $galleries = Formatter::formatMany('gallery', $galleries, ['user']);

        foreach($galleries as $gallery){
            unset($gallery->meta);
            unset($gallery->images);
            unset($gallery->content);
        }

        $this->resp(0, $galleries, null, [
            'meta' => [
                'total' => Gallery::count($cond),
                'page'  => $page,
                'rpp'   => $rpp
            ]
        ]);
    }

    public function singleAction() {
        if(!$this->app->isAuthorized())
            return $this->resp(401);

        $identity = $this->req->param->identity;
        $gallery = Gallery::getOne(['id'=>$identity]);
        if(!$gallery)
            $gallery = Gallery::getOne(['slug'=>$identity]);
        if(!$gallery)
            return $this->show404();

        $gallery = Formatter::format('gallery', $gallery, ['user']);
        unset($gallery->meta);

        $this->resp(0, $gallery);
    }
}