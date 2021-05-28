<?php

namespace App\Interfaces;

// use App\Http\Requests\AdvertRequest;
use Illuminate\Http\Request;

interface AdvertRepositoryInterface
{
    /**
     * Get all advert
     * 
     * @method  GET api/advert
     * @access  public
     */
    public function getAllAdverts();

    /**
     * Get Advert By ID
     * 
     * @param   integer     $id
     * 
     * @method  GET api/advert/{id}
     * @access  public
     */
    public function getAdvertById($id);

    /**
     * Create | Update Advert
     * 
     * @param   \App\Http\Requests\AdvertRequest    $request
     * @param   integer                           $id
     * 
     * @method  POST    api/advert       For Create
     * @method  PUT     api/advert/{id}  For Update     
     * @access  public
     */
    // public function requestAdvert(Request $request, $id = null);

    /**
     * Delete Advert
     * 
     * @param   integer     $id
     * 
     * @method  DELETE  api/advert/{id}
     * @access  public
     */
    public function deleteAdvert($id);
}